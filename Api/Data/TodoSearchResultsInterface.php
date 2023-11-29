<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types=1);

namespace Jajuma\PotTodo\Api\Data;

interface TodoSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Todo list.
     * @return \Jajuma\PotTodo\Api\Data\TodoInterface[]
     */
    public function getItems();

    /**
     * Set task list.
     * @param \Jajuma\PotTodo\Api\Data\TodoInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}