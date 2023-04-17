<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Data;

use ICT\Klar\Api\Data\OptionalIdentifiersInterface;
use Magento\Framework\DataObject;

class OptionalIdentifiers extends DataObject implements OptionalIdentifiersInterface
{
    /**
     * Getter for GoogleAnalyticsTransactionId.
     *
     * @return string|null
     */
    public function getGoogleAnalyticsTransactionId(): ?string
    {
        return $this->getData(self::GOOGLE_ANALYTICS_TRANSACTION_ID);
    }

    /**
     * Setter for GoogleAnalyticsTransactionId.
     *
     * @param string|null $googleAnalyticsTransactionId
     *
     * @return void
     */
    public function setGoogleAnalyticsTransactionId(?string $googleAnalyticsTransactionId): void
    {
        $this->setData(self::GOOGLE_ANALYTICS_TRANSACTION_ID, $googleAnalyticsTransactionId);
    }

    /**
     * Getter for OrderSourceName.
     *
     * @return string|null
     */
    public function getOrderSourceName(): ?string
    {
        return $this->getData(self::ORDER_SOURCE_NAME);
    }

    /**
     * Setter for OrderSourceName.
     *
     * @param string|null $orderSourceName
     *
     * @return void
     */
    public function setOrderSourceName(?string $orderSourceName): void
    {
        $this->setData(self::ORDER_SOURCE_NAME, $orderSourceName);
    }

    /**
     * Getter for OrderChannelName.
     *
     * @return string|null
     */
    public function getOrderChannelName(): ?string
    {
        return $this->getData(self::ORDER_CHANNEL_NAME);
    }

    /**
     * Setter for OrderChannelName.
     *
     * @param string|null $orderChannelName
     *
     * @return void
     */
    public function setOrderChannelName(?string $orderChannelName): void
    {
        $this->setData(self::ORDER_CHANNEL_NAME, $orderChannelName);
    }

    /**
     * Getter for OrderPlatformName.
     *
     * @return string|null
     */
    public function getOrderPlatformName(): ?string
    {
        return $this->getData(self::ORDER_PLATFORM_NAME);
    }

    /**
     * Setter for OrderPlatformName.
     *
     * @param string|null $orderPlatformName
     *
     * @return void
     */
    public function setOrderPlatformName(?string $orderPlatformName): void
    {
        $this->setData(self::ORDER_PLATFORM_NAME, $orderPlatformName);
    }

    /**
     * Getter for UtmSource.
     *
     * @return string|null
     */
    public function getUtmSource(): ?string
    {
        return $this->getData(self::UTM_SOURCE);
    }

    /**
     * Setter for UtmSource.
     *
     * @param string|null $utmSource
     *
     * @return void
     */
    public function setUtmSource(?string $utmSource): void
    {
        $this->setData(self::UTM_SOURCE, $utmSource);
    }

    /**
     * Getter for UtmMedium.
     *
     * @return string|null
     */
    public function getUtmMedium(): ?string
    {
        return $this->getData(self::UTM_MEDIUM);
    }

    /**
     * Setter for UtmMedium.
     *
     * @param string|null $utmMedium
     *
     * @return void
     */
    public function setUtmMedium(?string $utmMedium): void
    {
        $this->setData(self::UTM_MEDIUM, $utmMedium);
    }

    /**
     * Getter for UtmCampaign.
     *
     * @return string|null
     */
    public function getUtmCampaign(): ?string
    {
        return $this->getData(self::UTM_CAMPAIGN);
    }

    /**
     * Setter for UtmCampaign.
     *
     * @param string|null $utmCampaign
     *
     * @return void
     */
    public function setUtmCampaign(?string $utmCampaign): void
    {
        $this->setData(self::UTM_CAMPAIGN, $utmCampaign);
    }

    /**
     * Getter for UtmTerm.
     *
     * @return string|null
     */
    public function getUtmTerm(): ?string
    {
        return $this->getData(self::UTM_TERM);
    }

    /**
     * Setter for UtmTerm.
     *
     * @param string|null $utmTerm
     *
     * @return void
     */
    public function setUtmTerm(?string $utmTerm): void
    {
        $this->setData(self::UTM_TERM, $utmTerm);
    }

    /**
     * Getter for UtmContent.
     *
     * @return string|null
     */
    public function getUtmContent(): ?string
    {
        return $this->getData(self::UTM_CONTENT);
    }

    /**
     * Setter for UtmContent.
     *
     * @param string|null $utmContent
     *
     * @return void
     */
    public function setUtmContent(?string $utmContent): void
    {
        $this->setData(self::UTM_CONTENT, $utmContent);
    }

    /**
     * Getter for LandingPage.
     *
     * @return string|null
     */
    public function getLandingPage(): ?string
    {
        return $this->getData(self::LANDING_PAGE);
    }

    /**
     * Setter for LandingPage.
     *
     * @param string|null $landingPage
     *
     * @return void
     */
    public function setLandingPage(?string $landingPage): void
    {
        $this->setData(self::LANDING_PAGE, $landingPage);
    }

    /**
     * Getter for IsSubscriptionOrder.
     *
     * @return bool|null
     */
    public function getIsSubscriptionOrder(): ?bool
    {
        return $this->getData(self::IS_SUBSCRIPTION_ORDER) === null ? null
            : (bool)$this->getData(self::IS_SUBSCRIPTION_ORDER);
    }

    /**
     * Setter for IsSubscriptionOrder.
     *
     * @param bool|null $isSubscriptionOrder
     *
     * @return void
     */
    public function setIsSubscriptionOrder(?bool $isSubscriptionOrder): void
    {
        $this->setData(self::IS_SUBSCRIPTION_ORDER, $isSubscriptionOrder);
    }

    /**
     * Getter for IsFirstSubscriptionOrder.
     *
     * @return bool|null
     */
    public function getIsFirstSubscriptionOrder(): ?bool
    {
        return $this->getData(self::IS_FIRST_SUBSCRIPTION_ORDER) === null ? null
            : (bool)$this->getData(self::IS_FIRST_SUBSCRIPTION_ORDER);
    }

    /**
     * Setter for IsFirstSubscriptionOrder.
     *
     * @param bool|null $isFirstSubscriptionOrder
     *
     * @return void
     */
    public function setIsFirstSubscriptionOrder(?bool $isFirstSubscriptionOrder): void
    {
        $this->setData(self::IS_FIRST_SUBSCRIPTION_ORDER, $isFirstSubscriptionOrder);
    }
}
