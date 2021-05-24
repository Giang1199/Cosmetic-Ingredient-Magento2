<?php
declare(strict_types=1);

namespace Dtn\Cosmetic\Model;

use Magento\Framework\Serialize\Serializer\Json;
use Dtn\Cosmetic\Model\ResourceModel\CosmeticIngredients\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var Json
     */
    protected $serialize;

    /**
     * @var $_loadedData
     */
    protected $_loadedData;

    /**
     * @var Dtn\Cosmetic\Model\ResourceModel\CosmeticIngredients\CollectionFactory
     */
    protected $collection;

    /**
     * DataProvider constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param Json $json
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        Json $json,
        array $meta = [],
        array $data = []
    )
    {
        $this->serialize = $json;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            if (isset($item->getData()['img'])) {
                try {
                    $item->setData('img', $this->serialize->unserialize($item->getData('img')));
                } catch (\Exception $e) {
                    $item->setData('img', '');
                }
            }
            $this->_loadedData[$item->getId()] = $item->getData();
        }
        return $this->_loadedData;
    }
}
