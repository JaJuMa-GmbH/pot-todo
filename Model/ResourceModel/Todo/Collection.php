<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types=1);

namespace Jajuma\PotTodo\Model\ResourceModel\Todo;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'todo_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Jajuma\PotTodo\Model\Todo::class,
            \Jajuma\PotTodo\Model\ResourceModel\Todo::class
        );
    }
}
