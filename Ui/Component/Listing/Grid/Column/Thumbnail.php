<?php
declare(strict_types=1);

namespace Dtn\Cosmetic\Ui\Component\Listing\Grid\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Store\Model\StoreManagerInterface;

//use Magento\Ui\Component\Listing\Columns\Column;


/**
 * Class Thumbnail
 */
class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    const URL_PATH_EDIT = 'cosmetic/ingredient/add/';

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var UrlInterface
     */
    protected $url;

    /**
     * Image constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StoreManagerInterface $storeManager
     * @param UrlInterface $url
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        UrlInterface $url,
        array $components = [],
        array $data = []
    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager = $storeManager;
        $this->url = $url;
    }

    /**
     * get src img
     * @param array $dataSource
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function prepareDataSource(array $dataSource)
    {
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

        if (isset($dataSource['data']['items'])) {
            $fieldName = 'img';
            foreach ($dataSource['data']['items'] as & $item) {
                if (!empty($item['img'])) {
                    $imgData = json_decode($item['img']);
                    $item[$fieldName . '_src'] = $mediaUrl . 'ingredientImg/' . $imgData[0]->name;
                    $item[$fieldName . '_alt'] = '';
                    $item[$fieldName . '_link'] = $this->url->getUrl(static::URL_PATH_EDIT, [
                        'entity_id' => $item['entity_id']
                    ]);
                    $item[$fieldName . '_orig_src'] = $mediaUrl . 'ingredientImg/' . $imgData[0]->name;
                }
            }
        }
        return $dataSource;
    }
}
