<?php
namespace App\Controller;

/**
 * Voices Controller
 *
 * @property \App\Model\Table\VoicesTable $Voices
 */
class VoicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $voices = $this->paginate($this->Voices);

        $this->set(compact('voices'));
        $this->set('_serialize', ['voices']);
    }

    /**
     * View method
     *
     * @param string|null $id Voice id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $voice = $this->Voices->get($id, [
            'contain' => ['Messages']
        ]);

        $this->set('voice', $voice);
        $this->set('_serialize', ['voice']);
    }


    private function processUpload()
    {
        if (!empty($this->request->getData('upload.name'))) {
            $filename = ROOT . '/uploads/' . date('Ymd_His') . $this->request->getData('upload.name');
            if (!file_exists(dirname($filename))) {
                mkdir(dirname($filename), 0777, true);
            }
            move_uploaded_file($this->request->getData('upload.tmp_name'), $filename);
            $this->request = $this->request->withData('namejingle', $filename);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $voice = $this->Voices->newEntity();
        if ($this->request->is('post')) {
            $this->processUpload();
            $voice = $this->Voices->patchEntity($voice, $this->request->getData());
            if ($this->Voices->save($voice)) {
                $this->Flash->success(__('The voice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The voice could not be saved. Please, try again.'));
        }
        $this->set(compact('voice'));
        $this->set('_serialize', ['voice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Voice id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $voice = $this->Voices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->processUpload();
            $voice = $this->Voices->patchEntity($voice, $this->request->getData());
            if ($this->Voices->save($voice)) {
                $this->Flash->success(__('The voice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The voice could not be saved. Please, try again.'));
        }
        $this->set(compact('voice'));
        $this->set('_serialize', ['voice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Voice id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $voice = $this->Voices->get($id);
        if ($this->Voices->delete($voice)) {
            $this->Flash->success(__('The voice has been deleted.'));
        } else {
            $this->Flash->error(__('The voice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
