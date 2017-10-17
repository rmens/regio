<?php
namespace App\Shell;

use App\Model\Entity\Message;
use App\Model\Table\MessagesTable;
use Cake\Console\Shell;

/**
 * @property MessagesTable Messages
 */
class PruneShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Messages');
    }

    public function main()
    {
        $query = $this->Messages->find('all');

        /** @var Message[] $messages */
        $messages = $query->all();

        if ($query->isEmpty()) {
            $this->out('No outdated messages found.');
            return true;
        }

        $success = true;
        $this->out('Deleting files...');
        foreach ($messages as $message) {
            if ($message->status !== 'verlopen') {
                continue;
            }

            $this->out(sprintf("Deleting ‘%s’ (%s)", $message->name, $message->end_date));
            if (!$this->Messages->delete($message)) {
                $success = false;
                $this->err(sprintf('Error deleting ‘%s’ (%s)', $message->name, $message->path));
            }
        }

        return $success;
    }
}
