<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types=1);

namespace Jajuma\PotTodo\Model;

use Jajuma\PotTodo\Api\Data\TodoInterface;
use Jajuma\PotTodo\Api\Data\TodoInterfaceFactory;
use Jajuma\PotTodo\Api\Data\TodoSearchResultsInterfaceFactory;
use Jajuma\PotTodo\Api\TodoRepositoryInterface;
use Jajuma\PotTodo\Model\ResourceModel\Todo as ResourceTodo;
use Jajuma\PotTodo\Model\ResourceModel\Todo\CollectionFactory as TodoCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class TodoRepository implements TodoRepositoryInterface
{

    /**
     * @var ResourceTodo
     */
    protected $resource;

    /**
     * @var TodoInterfaceFactory
     */
    protected $todoFactory;

    /**
     * @var TodoCollectionFactory
     */
    protected $todoCollectionFactory;

    /**
     * @var Todo
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceTodo $resource
     * @param TodoInterfaceFactory $todoFactory
     * @param TodoCollectionFactory $todoCollectionFactory
     * @param TodoSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceTodo $resource,
        TodoInterfaceFactory $todoFactory,
        TodoCollectionFactory $todoCollectionFactory,
        TodoSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->todoFactory = $todoFactory;
        $this->todoCollectionFactory = $todoCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(TodoInterface $todo)
    {
        try {
            $this->resource->save($todo);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the todo: %1',
                $exception->getMessage()
            ));
        }
        return $todo;
    }

    /**
     * @inheritDoc
     */
    public function get($todoId)
    {
        $todo = $this->todoFactory->create();
        $this->resource->load($todo, $todoId);
        if (!$todo->getId()) {
            throw new NoSuchEntityException(__('Todo with id "%1" does not exist.', $todoId));
        }
        return $todo;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->todoCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(TodoInterface $todo)
    {
        try {
            $todoModel = $this->todoFactory->create();
            $this->resource->load($todoModel, $todo->getTodoId());
            $this->resource->delete($todoModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Todo: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($todoId)
    {
        return $this->delete($this->get($todoId));
    }
}
