<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types=1);

namespace Jajuma\PotTodo\Model;

use Jajuma\PotTodo\Api\Data\TodoInterface;
use Magento\Framework\Model\AbstractModel;

class Todo extends AbstractModel implements TodoInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Jajuma\PotTodo\Model\ResourceModel\Todo::class);
    }

    /**
     * @inheritDoc
     */
    public function getTodoId()
    {
        return $this->getData(self::TODO_ID);
    }

    /**
     * @inheritDoc
     */
    public function setTodoId($todoId)
    {
        return $this->setData(self::TODO_ID, $todoId);
    }

    /**
     * @inheritDoc
     */
    public function getTask()
    {
        return $this->getData(self::TASK);
    }

    /**
     * @inheritDoc
     */
    public function setTask($task)
    {
        return $this->setData(self::TASK, $task);
    }
}
