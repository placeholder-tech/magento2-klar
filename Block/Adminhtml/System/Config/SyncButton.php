<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Widget\Button;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class SyncButton extends Field
{
    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'ICT_Klar::system/config/sync_button.phtml';

    /**
     * {@inheritDoc}
     */
    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * {@inheritDoc}
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }

    /**
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('klar/sync/ajax');
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()
            ->createBlock(Button::class)
            ->setData(['id' => 'sync_now', 'label' => __('Sync Now'),]);

        return $button->toHtml();
    }
}
