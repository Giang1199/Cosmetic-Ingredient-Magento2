<?php

declare(strict_types=1);

namespace Dtn\Cosmetic\Block;

use Dtn\Cosmetic\Model\ResourceModel\CosmeticIngredients;
use Dtn\Cosmetic\Model\CosmeticIngredientsFactory as IngredientModel;

class ProductInfo extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CosmeticIngredients
     */
    protected $ingredientModel;

    /**
     * @var CosmeticIngredients
     */
    protected $ingredientResourse;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * ProductInfo constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param IngredientModel $ingredientModel
     * @param CosmeticIngredients $cosmeticIngredients
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        IngredientModel $ingredientModel,
        CosmeticIngredients $cosmeticIngredients,
        array $data = []
    )
    {
        $this->ingredientModel = $ingredientModel;
        $this->ingredientResourse = $cosmeticIngredients;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return ProductInfo
     */
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
     * @return current category infomation
     */
    public function getCurrentCategory()
    {
        return $this->_registry->registry('current_category');
    }

    /**
     * @return current product infomation
     */
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    /**
     * @return IngredientModel|CosmeticIngredients
     */
    public function getModel()
    {
        return $this->ingredientModel->create();
    }

    /**
     * @return CosmeticIngredients
     */
    public function getResourceModel()
    {
        return $this->ingredientResourse;
    }
}
