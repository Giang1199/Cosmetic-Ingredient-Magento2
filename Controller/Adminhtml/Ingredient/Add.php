<?php
declare(strict_types=1);

namespace Dtn\Cosmetic\Controller\Adminhtml\Ingredient;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Add extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPage;

    /**
     * Add constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->resultPage = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->resultPage->create();
    }
}