<?php
namespace App\Controller;

use App\Model\Entity\Message;
use Cake\Chronos\Chronos;
use Zend\Diactoros\Stream;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 */
class MessagesController extends AppController
{

    const MESSAGECOUNT_MAX = 3;

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Voices']
        ];
        $messages = $this->paginate($this->Messages);

        $this->set(compact('messages'));
        $this->set('_serialize', ['messages']);
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => ['Voices']
        ]);

        $this->set('message', $message);
        $this->set('_serialize', ['message']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            if (!empty($this->request->getData('upload.name'))) {
                $filename = ROOT . '/uploads/' . date('Ymd_His') . $this->request->getData('upload.name');
                if (!file_exists(dirname($filename))) {
                    mkdir(dirname($filename), 0777, true);
                }
                move_uploaded_file($this->request->getData('upload.tmp_name'), $filename);

                $this->request = $this->request->withData('path', $filename);
            }

            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $voices = $this->Messages->Voices->find('list', ['limit' => 200]);
        $this->set(compact('message', 'voices'));
        $this->set('_serialize', ['message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!empty($this->request->getData('upload.name'))) {
                $filename = ROOT . '/uploads/' . date('Ymd_His') . $this->request->getData('upload.name');
                if (!file_exists(dirname($filename))) {
                    mkdir(dirname($filename), 0777, true);
                }
                move_uploaded_file($this->request->getData('upload.tmp_name'), $filename);

                $this->request = $this->request->withData('path', $filename);
            }

            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $voices = $this->Messages->Voices->find('list', ['limit' => 200]);
        $this->set(compact('message', 'voices'));
        $this->set('_serialize', ['message']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param $messages Message[]
     */
    private function pickRandomWeighted($messages)
    {
        if (count($messages) === 0) {
            return false;
        }

        $times = array_map(function (Message $message) {
            if ($message->last_played == null) {
                return null;
            }

            return $message->last_played->timestamp;
        }, $messages);

        // Remove `null`
        $times = array_filter($times);

        // Remove duplicate times
        $times = array_unique($times);

        // Sort highest to lowest (most-recent to last-recent)
        rsort($times);

        // Add null element aat the end so unplayed items have more weight
        $times[] = null;

        $weighted = [];
        foreach ($messages as $message) {
            $time = ($message->last_played == null) ? null : $message->last_played->timestamp;

            // Gets 0-based array index
            $weight = array_search($time, $times);
            $weight += 1;

            for ($i = 0; $i < $weight; $i++) {
                $weighted[] = $message;
            }
        }

        $randomIndex = array_rand($weighted);

        return $weighted[$randomIndex];
    }

    public function playlist()
    {
        // TODO limit by voice
        $query = $this->Messages->find();
        $dayFields = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        $data = $query->where(['active' => true])
            ->andWhere(['start_date <=' => $query->func()->now('date')])
            ->andWhere(['end_date >=' => $query->func()->now('date')])
            ->andWhere([$dayFields[date('N') - 1] => true])
            ->orderAsc('last_played');

        $all = $data->toList();

        $messages = [];
        for ($i = 0; $i < self::MESSAGECOUNT_MAX; $i++) {
            $pickedMeesage = $this->pickRandomWeighted($all);
            if ($pickedMeesage === false) {
                break;
            }

            $index = array_search($pickedMeesage, $all);
            unset($all[$index]);

            $messages[] = $pickedMeesage;
        }

        /** @var Message $message */
        foreach ($messages as $message) {
            $message->last_played = Chronos::now();
            $message->times_planned += 1;
        }
        $this->Messages->saveMany($messages);

        $line = '';
        foreach ($messages as $message) {
            $line .= $message->name . ';' . $message->path . PHP_EOL;
        }

        $stream = fopen('php://temp', 'r+');
        fwrite($stream, $line);
        fseek($stream, 0);

        return $this->response
            ->withBody(new Stream($stream))
            ->withAddedHeader('Content-Type', 'text/plain; charset=utf-8');
    }
}
