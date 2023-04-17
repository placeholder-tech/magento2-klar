<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Api\Data;

interface OptionalIdentifiersInterface
{
    /**
     * String constants for property names
     */
    public const GOOGLE_ANALYTICS_TRANSACTION_ID = 'google_analytics_transaction_id';
    public const ORDER_SOURCE_NAME = 'order_source_name';
    public const ORDER_CHANNEL_NAME = 'order_channel_name';
    public const ORDER_PLATFORM_NAME = 'order_platform_name';
    public const UTM_SOURCE = 'utm_source';
    public const UTM_MEDIUM = 'utm_medium';
    public const UTM_CAMPAIGN = 'utm_campaign';
    public const UTM_TERM = 'utm_term';
    public const UTM_CONTENT = 'utm_content';
    public const LANDING_PAGE = 'landing_page';
    public const IS_SUBSCRIPTION_ORDER = 'is_subscription_order';
    public const IS_FIRST_SUBSCRIPTION_ORDER = 'is_first_subscription_order';

    /**
     * Getter for GoogleAnalyticsTransactionId.
     *
     * @return string|null
     */
    public function getGoogleAnalyticsTransactionId(): ?string;

    /**
     * Setter for GoogleAnalyticsTransactionId.
     *
     * @param string|null $googleAnalyticsTransactionId
     *
     * @return void
     */
    public function setGoogleAnalyticsTransactionId(?string $googleAnalyticsTransactionId): void;

    /**
     * Getter for OrderSourceName.
     *
     * @return string|null
     */
    public function getOrderSourceName(): ?string;

    /**
     * Setter for OrderSourceName.
     *
     * @param string|null $orderSourceName
     *
     * @return void
     */
    public function setOrderSourceName(?string $orderSourceName): void;

    /**
     * Getter for OrderChannelName.
     *
     * @return string|null
     */
    public function getOrderChannelName(): ?string;

    /**
     * Setter for OrderChannelName.
     *
     * @param string|null $orderChannelName
     *
     * @return void
     */
    public function setOrderChannelName(?string $orderChannelName): void;

    /**
     * Getter for OrderPlatformName.
     *
     * @return string|null
     */
    public function getOrderPlatformName(): ?string;

    /**
     * Setter for OrderPlatformName.
     *
     * @param string|null $orderPlatformName
     *
     * @return void
     */
    public function setOrderPlatformName(?string $orderPlatformName): void;

    /**
     * Getter for UtmSource.
     *
     * @return string|null
     */
    public function getUtmSource(): ?string;

    /**
     * Setter for UtmSource.
     *
     * @param string|null $utmSource
     *
     * @return void
     */
    public function setUtmSource(?string $utmSource): void;

    /**
     * Getter for UtmMedium.
     *
     * @return string|null
     */
    public function getUtmMedium(): ?string;

    /**
     * Setter for UtmMedium.
     *
     * @param string|null $utmMedium
     *
     * @return void
     */
    public function setUtmMedium(?string $utmMedium): void;

    /**
     * Getter for UtmCampaign.
     *
     * @return string|null
     */
    public function getUtmCampaign(): ?string;

    /**
     * Setter for UtmCampaign.
     *
     * @param string|null $utmCampaign
     *
     * @return void
     */
    public function setUtmCampaign(?string $utmCampaign): void;

    /**
     * Getter for UtmTerm.
     *
     * @return string|null
     */
    public function getUtmTerm(): ?string;

    /**
     * Setter for UtmTerm.
     *
     * @param string|null $utmTerm
     *
     * @return void
     */
    public function setUtmTerm(?string $utmTerm): void;

    /**
     * Getter for UtmContent.
     *
     * @return string|null
     */
    public function getUtmContent(): ?string;

    /**
     * Setter for UtmContent.
     *
     * @param string|null $utmContent
     *
     * @return void
     */
    public function setUtmContent(?string $utmContent): void;

    /**
     * Getter for LandingPage.
     *
     * @return string|null
     */
    public function getLandingPage(): ?string;

    /**
     * Setter for LandingPage.
     *
     * @param string|null $landingPage
     *
     * @return void
     */
    public function setLandingPage(?string $landingPage): void;

    /**
     * Getter for IsSubscriptionOrder.
     *
     * @return bool|null
     */
    public function getIsSubscriptionOrder(): ?bool;

    /**
     * Setter for IsSubscriptionOrder.
     *
     * @param bool|null $isSubscriptionOrder
     *
     * @return void
     */
    public function setIsSubscriptionOrder(?bool $isSubscriptionOrder): void;

    /**
     * Getter for IsFirstSubscriptionOrder.
     *
     * @return bool|null
     */
    public function getIsFirstSubscriptionOrder(): ?bool;

    /**
     * Setter for IsFirstSubscriptionOrder.
     *
     * @param bool|null $isFirstSubscriptionOrder
     *
     * @return void
     */
    public function setIsFirstSubscriptionOrder(?bool $isFirstSubscriptionOrder): void;
}
