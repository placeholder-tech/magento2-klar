<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Block\Adminhtml\System\Config;

use ICT\Klar\Api\Data\ApiInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field as ConfigFormField;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

class OrdersStatus extends ConfigFormField
{
    private ApiInterface $api;

    /**
     * OrderStatus constructor.
     *
     * @param Context $context
     * @param ApiInterface $api
     * @param array $data
     * @param SecureHtmlRenderer|null $secureRenderer
     */
    public function __construct(
        Context $context,
        ApiInterface $api,
        array $data = [],
        ?SecureHtmlRenderer $secureRenderer = null
    ) {
        parent::__construct($context, $data, $secureRenderer);
        $this->api = $api;
    }

    /**
     * Render orders status.
     *
     * @param AbstractElement $element
     *
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        $html = '<div>';

        $status = $this->api->getStatus();

        if (!empty($status)) {
            foreach ($status as $label => $value) {
                $value = $value ?: 'n/a';

                if ($label !== 0) {
                    $html .= "<div><b>{$label}</b>: {$value}</div>";
                } else {
                    $html .= "<div>{$value}</div>";
                }
            }
        }

        $html .= '</div>';

        return $html;
    }
}
