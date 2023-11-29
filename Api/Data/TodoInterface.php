<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types=1);

namespace Jajuma\PotTodo\Api\Data;

interface TodoInterface
{

    const TASK = 'task';
    const TODO_ID = 'todo_id';

    /**
     * Get todo_id
     * @return string|null
     */
    public function getTodoId();

    /**
     * Set todo_id
     * @param string $todoId
     * @return \Jajuma\PotTodo\Todo\Api\Data\TodoInterface
     */
    public function setTodoId($todoId);

    /**
     * Get task
     * @return string|null
     */
    public function getTask();

    /**
     * Set task
     * @param string $task
     * @return \Jajuma\PotTodo\Todo\Api\Data\TodoInterface
     */
    public function setTask($task);
}
