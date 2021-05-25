<?php
declare(strict_types=1);

namespace Dtn\Cosmetic\Controller\Adminhtml\Ingredient;

use Magento\Framework\Serialize\Serializer\Json;
use Dtn\Cosmetic\Model\CosmeticIngredientsFactory;
use Dtn\Cosmetic\Model\ResourceModel\CosmeticIngredients;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Save extends Action
{
    /**
     * @var Json
     */
    protected $serialize;

    /**
     * @var CosmeticIngredientsFactory
     */
    protected $cosmeticIngredientsFactory;

    /**
     * @var CosmeticIngredients
     */
    protected $cosmeticIngredientsResource;

    /**
     * Save constructor.
     * @param Context $context
     * @param CosmeticIngredientsFactory $cosmeticIngredientsFactory
     * @param CosmeticIngredients $cosmeticIngredients
     * @param Json $json
     */
    public function __construct
    (
        Context $context,
        CosmeticIngredientsFactory $cosmeticIngredientsFactory,
        CosmeticIngredients $cosmeticIngredients,
        Json $json
    )
    {
        $this->serialize = $json;
        $this->cosmeticIngredientsResource = $cosmeticIngredients;
        $this->cosmeticIngredientsFactory = $cosmeticIngredientsFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $cosmeticIngredientsFactory = $this->cosmeticIngredientsFactory->create();
        $ingredient = $this->getRequest()->getPost();

        // Get id from url
        $id = $this->getRequest()->getParam('entity_id');

        // convert $ingredient['img'] data array to string
        $ingredient['img'] = $this->serialize->serialize($ingredient['img']);

        $saveData = [
            'name' => $ingredient['name'],
            'describe' => $ingredient['describe'],
            'img' => $ingredient['img']
        ];
        try {
            if ($id) {
                $this->cosmeticIngredientsResource->load($cosmeticIngredientsFactory, $id);
            }
            if ($this->getRequest()->getParam('back')) {
                $this->messageManager->addSuccess(__('Insert Record Successfully !'));
                $this->cosmeticIngredientsResource->save($cosmeticIngredientsFactory->addData($saveData));
                return $this->_redirect('cosmetic/ingredient/add/entity_id' . $id);
            }
            $this->cosmeticIngredientsResource->save($cosmeticIngredientsFactory->addData($saveData));
            return $this->_redirect('cosmetic/ingredient/index');
        } catch (\Exception $exception) {
        }
    }
}