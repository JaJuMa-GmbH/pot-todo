<?php declare(strict_types=1);
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023 JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\PotTodo\Magewire;

use Magewirephp\Magewire\Component;
use Magewirephp\Magewire\Model\Element\FlashMessage;
use Jajuma\PotTodo\Model\TodoFactory;
use Rakit\Validation\Validator;
use Magento\Framework\App\ResourceConnection;
use Jajuma\PotTodo\Model\ResourceModel\Todo\CollectionFactory as TodoCollectionFactory;

class Todo extends \Magewirephp\Magewire\Component\Form
{
    public $task = '';

    public $tasks = [];

    public $messageTodo = '';

    public $rules = [
        'task' => 'required'
    ];

    protected $messages = [
        'task:required' => 'The "Task" property can\'t be empty',
    ];

    protected $todoFactory;

    protected $resourceConnection;

    private $todoCollectionFactory;

    public function __construct(
        TodoFactory $todoFactory,
        ResourceConnection $resourceConnection,
        TodoCollectionFactory $todoCollectionFactory,
        Validator $validator
    ) {
        $this->todoFactory = $todoFactory;
        $this->todoCollectionFactory = $todoCollectionFactory;
        $this->resourceConnection = $resourceConnection;
        parent::__construct($validator);
    }

    public function mount(): void
    {
        $this->fetchTasks();
        parent::mount();
    }

    private function fetchTasks()
    {
        $todoCollection = $this->getTaskCollection()->getItems();
        $this->tasks = [];
        foreach ($todoCollection as $item) {
            $this->tasks[] = $item->getData();
        }
    }

    public function saveTask(string $title = null)
    {
        //validate data
        try {
            $this->validate();
        } catch (\Magewirephp\Magewire\Exception\ValidationException $exception) {
            foreach ($this->getErrors() as $error) {
                $this->dispatchErrorMessage($error);
            }
        }
        $todoModel = $this->todoFactory->create();
        $data = [
            'task' => $this->task
        ];
        $todoModel->setData($data);
        $todoModel->save();
        $this->messageTodo = 'Task has been saved successfully.';
        // Always empty it's current input title.
        $this->task = '';
        $this->fetchTasks();
    }

    public function removeTask($taskId)
    {
        $todoModel = $this->todoFactory->create();
        $todoModel = $todoModel->load($taskId);
        $todoModel->delete();
        $this->messageTodo = 'Task has been removed successfully.';
        $this->fetchTasks();
    }

    public function removeAllTask()
    {
        $connection = $this->resourceConnection->getConnection();
        $table = $connection->getTableName('jajuma_powertoys_todo');
        $query = "DELETE FROM " . $table;
        $connection->query($query);
        $this->messageTodo = 'All task has been removed successfully.';
        $this->tasks = [];
    }

    private function getTaskCollection()
    {
        $todoCollectionFactory =  $this->todoCollectionFactory->create();
        return $todoCollectionFactory;
    }
}
