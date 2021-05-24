<?php

namespace Dtn\Cosmetic\Model;

use Magento\Framework\Model\AbstractModel;

class CosmeticIngredients extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Dtn\Cosmetic\Model\ResourceModel\CosmeticIngredients');
    }
}