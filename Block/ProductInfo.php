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
     * @return attribute set id
     */
    public function getAttributeSet()
    {
        $productInfo = $this->_registry->registry('current_product');
        return $productInfo->getData('attribute_set_id');
    }

    /**
     * @return array data
     */
    public function getCurrentProduct()
    {
        $productInfo = $this->_registry->registry('current_product');
        $currentAttributeValue = $productInfo->getData('ingredient_cosmetic_attribute');
        $convertedAttributeValue = explode(',', $currentAttributeValue);
        return $convertedAttributeValue;
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

    /**
     * @return array data img
     */
    public function getImg()
    {
        $currentProduct = $this->getCurrentProduct();
        foreach ($currentProduct as $value) {
            $value = json_decode($value);
            $ingredientModel = $this->ingredientModel->create();
            $this->getResourceModel()->load($ingredientModel, $value);
            $modelData = $ingredientModel->getData();
            $img[] = json_decode($modelData['img'])[0]->name;
        }
        return $img;
    }
}
