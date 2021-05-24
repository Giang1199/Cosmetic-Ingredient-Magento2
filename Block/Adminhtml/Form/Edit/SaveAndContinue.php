<?php
declare(strict_types=1);

namespace Dtn\Cosmetic\Block\Adminhtml\Form\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveAndContinue
 * @package Dtn\Cosmetic\Block\Adminhtml\Form\Edit
 */
class SaveAndContinue extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save And Continue'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 80
        ];
    }
}