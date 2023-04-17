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

class Config extends AbstractHelper
{
    private const CONFIG_PATH_ENABLED = 'klar/integration/enabled';
    private const CONFIG_PATH_API_URL = 'klar/integration/api_url';
    private const CONFIG_PATH_API_VERSION = 'klar/integration/api_version';
    private const CONFIG_PATH_API_TOKEN = 'klar/integration/api_token';

    /**
     * @var Encrypted
     */
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
}
