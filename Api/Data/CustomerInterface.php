<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Api\Data;

interface CustomerInterface
{
    /**
     * String constants for property names
     */
    public const ID = 'id';
    public const EMAIL = 'email';
    public const IS_NEWSLETTER_SUBSCRIBER_AT_TIME_OF_CHECKOUT = 'is_newsletter_subscriber_at_time_of_checkout';
    public const TAGS = 'tags';

    /**
     * Getter for Id.
     *
     * @return string|null
     */
    public function getId(): ?string;

    /**
     * Setter for Id.
     *
     * @param string|null $id
     *
     * @return void
     */
    public function setId(?string $id): void;

    /**
     * Getter for Email.
     *
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * Setter for Email.
     *
     * @param string|null $email
     *
     * @return void
     */
    public function setEmail(?string $email): void;

    /**
     * Getter for IsNewsletterSubscriberAtTimeOfCheckout.
     *
     * @return bool|null
     */
    public function getIsNewsletterSubscriberAtTimeOfCheckout(): ?bool;

    /**
     * Setter for IsNewsletterSubscriberAtTimeOfCheckout.
     *
     * @param bool|null $isNewsletterSubscriberAtTimeOfCheckout
     *
     * @return void
     */
    public function setIsNewsletterSubscriberAtTimeOfCheckout(?bool $isNewsletterSubscriberAtTimeOfCheckout): void;

    /**
     * Getter for Tags.
     *
     * @return string|null
     */
    public function getTags(): ?string;

    /**
     * Setter for Tags.
     *
     * @param string|null $tags
     *
     * @return void
     */
    public function setTags(?string $tags): void;
}
