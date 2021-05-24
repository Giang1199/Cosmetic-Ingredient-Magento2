<?php

declare(strict_types=1);

namespace Dtn\Cosmetic\Model\ResourceModel\CosmeticIngredients;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Dtn\Cosmetic\Model\CosmeticIngredients', 'Dtn\Cosmetic\Model\ResourceModel\CosmeticIngredients');
    }
}