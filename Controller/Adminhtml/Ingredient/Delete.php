<?php
declare(strict_types=1);

namespace Dtn\Cosmetic\Controller\Adminhtml\Ingredient;

use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Dtn\Cosmetic\Model\ResourceModel\CosmeticIngredients\CollectionFactory;
use Dtn\Cosmetic\Model\ResourceModel\CosmeticIngredients;
use Dtn\Cosmetic\Model\CosmeticIngredientsFactory;

class Delete extends Action
{
    /**
     * @var CosmeticIngredients
     */
    protected $cosmeticIngredientsResource;

    /**
     * @var CosmeticIngredientsFactory
     */
    protected $cosmeticIngredientsModel;

    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * Delete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param CosmeticIngredientsFactory $cosmeticIngredientsModel
     * @param CosmeticIngredients $cosmeticIngredientsResource
     */
    public function __construct
    (
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        CosmeticIngredientsFactory $cosmeticIngredientsModel,
        CosmeticIngredients $cosmeticIngredientsResource
    )
    {
        $this->cosmeticIngredientsModel = $cosmeticIngredientsModel;
        $this->cosmeticIngredientsResource = $cosmeticIngredientsResource;
        $this->collection = $collectionFactory;
        $this->filter = $filter;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $cosmeticIngredientsModel = $this->cosmeticIngredientsModel->create();
        $data = $this->filter->getCollection($this->collection->create());
        $total = 0;
        $err = 0;
        foreach ($data->getItems() as $item) {
            try {
                $selectedId = $item->getData('entity_id');
                $this->cosmeticIngredientsResource->delete($cosmeticIngredientsModel->load($selectedId));
                $total++;
            } catch (\Exception $exception) {
                $err++;
            }
        }
        if ($total) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $total));
        } elseif ($err) {
            $this->messageManager->addErrorMessage(
                __(
                    'A total of %1 record(s) haven\'t been deleted. Please see server logs for more details.',
                    $err
                )
            );
        }
        return $this->_redirect('cosmetic/ingredient/index');
    }
}