<?php

namespace com\web;

use com\web\face\HtmlNode;

/**
 * Utility for putting validation messages on a page.
 *
 * @author Andy Gabler
 */
class ValidationUtil {

    private const VALIDATION_PROPERTY = "validationError";
    private const USER_MESSAGE_PROPERTY = "userMessage";

    /**
     * User failed validation or some other error message.
     *
     * @param string $message The message
     */
    public static function validate(string $message) {
        $_SESSION[self::VALIDATION_PROPERTY] = $message;
    }

    /**
     * Show user a message.
     *
     * @param string $message The message
     */
    public static function messageUser(string $message) {
        $_SESSION[self::USER_MESSAGE_PROPERTY] = $message;
    }

    /**
     * Put outstanding messages on an HTML node and then clear the messages.
     *
     * @param HtmlNode $node The node to put it on
     */
    public static function addMessagesToHtmlNode(HtmlNode $node) {
        if (isset($_SESSION[self::VALIDATION_PROPERTY])) {
            $validationContainer = new HtmlNode($node, "div");
            $validationContainer->addAttribute("class", "validation");
            $messageLabel = new HtmlNode($validationContainer, "label");
            $messageLabel->setNestedText($_SESSION[self::VALIDATION_PROPERTY]);
            unset($_SESSION[self::VALIDATION_PROPERTY]);
        }
        if (isset($_SESSION[self::USER_MESSAGE_PROPERTY])) {
            $messageContainer = new HtmlNode($node, "div");
            $messageContainer->addAttribute("class", "userMessage");
            $messageLabel = new HtmlNode($messageContainer, "label");
            $messageLabel->setNestedText($_SESSION[self::USER_MESSAGE_PROPERTY]);
            unset($_SESSION[self::USER_MESSAGE_PROPERTY]);
        }
    }
}