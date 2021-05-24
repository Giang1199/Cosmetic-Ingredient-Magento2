<?php
declare(strict_types=1);

namespace Dtn\Cosmetic\Model\Config\Product;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Dtn\Cosmetic\Model\ResourceModel\CosmeticIngredients\CollectionFactory;
use Dtn\Cosmetic\Model\CosmeticIngredientsFactory;
use Magento\Framework\App\Request\Http;

class IngredientOption extends AbstractSource
{
    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
     * @var CosmeticIngredientsFactory
     */
    protected $cosmeticIngredientsModel;

    /**
     * @var Http
     */
    protected $request;

    /**
     * ExtensionOption constructor.
     * @param CollectionFactory $collectionFactory
     * @param CosmeticIngredientsFactory $cosmeticIngredientsFactory
     * @param Http $request
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        CosmeticIngredientsFactory $cosmeticIngredientsFactory,
        Http $request
    )
    {
        $this->cosmeticIngredientsModel = $cosmeticIngredientsFactory;
        $this->collection = $collectionFactory;
        $this->request = $request;
    }

    /**
     * @return array
     * get Collection to set value and label for attribute
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $collection = $this->collection->create();

            $this->options = [];
            foreach ($collection as $item) {
                $this->options[] = [
                    'value' => $item->getData('entity_id'),
                    'label' => $item->getData('name')
                ];
            }
        }

        return $this->options;
    }
}
