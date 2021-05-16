<?php

namespace com\web;

use com\employu\web\face\HtmlDocument;
use com\employu\web\face\HtmlNode;

class PageUtil {

    public static function addHeaderToHtmlDocument(HtmlDocument $page) {
        (new HtmlNode($page->getHead(), "title"))->setNestedText("Loan Dashboard");
        $iconNode = new HtmlNode($page->getHead(), "link");
        $iconNode->addAttribute("rel", "icon");
        $iconNode->addAttribute("type", "image/png");
        $iconNode->addAttribute("href", "/css/images/favicon.png");

        $styleNode = new HtmlNode($page->getHead(), "link");
        $styleNode->addAttribute("rel", "stylesheet");
        $styleNode->addAttribute("href", "/css/styles.css?v=" . time());
    }

    public static function addBannerAndNavControlsToHtmlDocument(HtmlDocument $page) {
        $authenticated = $_SESSION[SessionUtil::AUTHENTICATED_PROPERTY];

        $buttonSet = new HtmlNode($page->getBody(), "div");
        $buttonList = new HtmlNode($buttonSet, "ul");

        $homeButton = new HtmlNode($buttonList, "li");
        $homeLink = new HtmlNode($homeButton, "a");
        $homeLink->addAttribute("href", "/");
        $homeLink->addAttribute("class", "active");
        $homeLink->setNestedText("Home");

        $sessionControlScript = "/login.php";
        $sessionControlClass = "login";
        $sessionControlTag = "Login";
        if ($authenticated) {
            $sessionControlScript = "/logout.php";
            $sessionControlClass = "logout";
            $sessionControlTag = "Logout";
        }

        $sessionControlButton = new HtmlNode($buttonList, "li");
        $sessionControlButton->addAttribute("class", "float:right");
        $sessionControlButton->addAttribute("style", "float:right");
        $sessionControlLink = new HtmlNode($sessionControlButton, "a");
        $sessionControlLink->addAttribute("href", $sessionControlScript);
        $sessionControlLink->addAttribute("class", $sessionControlClass);
        $sessionControlLink->setNestedText($sessionControlTag);

        if ($authenticated) {
            $currentUserLabel = new HtmlNode($buttonList, "li");
            $currentUserLabel->addAttribute("style", "float:right; color:#F0FFFF");
            $currentUserLabel->setNestedText("Welcome, " . $_SESSION[SessionUtil::NAME_PROPERTY] . ".");
        }

        $bannerNode = new HtmlNode($page->getBody(), "div");
        $bannerNode->addAttribute("class", "side-crop");
        $imageNode = new HtmlNode($bannerNode, "img");
        $imageNode->addAttribute("src", "/css/images/banner.jpg");
        $imageNode->addAttribute("class", "responsive");
    }
}