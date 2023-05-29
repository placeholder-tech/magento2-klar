<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Helper;

use Magento\Config\Model\Config\Backend\Encrypted;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    public const WEIGHT_UNIT_LBS = 'lbs';
    public const WEIGHT_UNIT_KGS = 'kgs';
    private const CONFIG_PATH_ENABLED = 'klar/integration/enabled';
    private const CONFIG_PATH_API_URL = 'klar/integration/api_url';
    private const CONFIG_PATH_API_VERSION = 'klar/integration/api_version';
    private const CONFIG_PATH_API_TOKEN = 'klar/integration/api_token';
    private const CONFIG_PATH_WEIGHT_UNIT = 'general/locale/weight_unit';

    private Encrypted $encrypted;

    /**
     * Config constructor.
     *
     * @param Context $context
     * @param Encrypted $encrypted
     */
    public function __construct(
        Context $context,
        Encrypted $encrypted
    ) {
        parent::__construct($context);
        $this->encrypted = $encrypted;
    }

    /**
     * Get "Klar > Integration > Enabled" config value.
     *
     * @return bool
     */
    public function getIsEnabled(): bool
    {
        return (bool)$this->scopeConfig->getValue(self::CONFIG_PATH_ENABLED);
    }

    /**
     * Get "Klar > Integration > API URL" config value.
     *
     * @return string|null
     */
    public function getApiUrl(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_API_URL);
    }

    /**
     * Get "Klar > Integration > API Token" config value.
     *
     * @return string|null
     */
    public function getApiToken(): ?string
    {
        $tokenEncrypted = $this->scopeConfig->getValue(self::CONFIG_PATH_API_TOKEN);

        return $this->encrypted->processValue($tokenEncrypted);
    }

    /**
     * Get "Klar > Integration > API Version" config value.
     *
     * @return string|null
     */
    public function getApiVersion(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_API_VERSION);
    }

    /**
     * Get weight unit.
     *
     * @return mixed
     */
    public function getWeightUnit()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_WEIGHT_UNIT, ScopeInterface::SCOPE_STORE);
    }
}
