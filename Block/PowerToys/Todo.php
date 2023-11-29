<?php
declare(strict_types=1);

namespace Jajuma\PotTodo\Block\PowerToys;

use Jajuma\PowerToys\Block\PowerToys\QuickAction;

class Todo extends QuickAction
{
    const XML_PATH_ENABLE = 'power_toys/pot_todo/is_enabled';

    public function isEnable(): bool
    {
        return $this->_scopeConfig->isSetFlag(self::XML_PATH_ENABLE);
    }
}