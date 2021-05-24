<?php

namespace Dtn\Cosmetic\Model\ResourceModel;

class CosmeticIngredients extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('dtn_cosmetic_ingredients', 'entity_id');
    }
}