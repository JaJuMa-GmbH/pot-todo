<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types=1);

namespace Jajuma\PotTodo\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TodoRepositoryInterface
{

    /**
     * Save Todo
     * @param \Jajuma\PotTodo\Api\Data\TodoInterface $todo
     * @return \Jajuma\PotTodo\Api\Data\TodoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Jajuma\PotTodo\Api\Data\TodoInterface $todo
    );

    /**
     * Retrieve Todo
     * @param string $todoId
     * @return \Jajuma\PotTodo\Api\Data\TodoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($todoId);

    /**
     * Retrieve Todo matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Jajuma\PotTodo\Api\Data\TodoSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Todo
     * @param \Jajuma\PotTodo\Api\Data\TodoInterface $todo
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Jajuma\PotTodo\Api\Data\TodoInterface $todo
    );

    /**
     * Delete Todo by ID
     * @param string $todoId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($todoId);
}
