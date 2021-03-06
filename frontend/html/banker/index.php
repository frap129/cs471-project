<?php

require_once dirname(__FILE__) . "/../../sources/CommonImports.php";

use com\web\PageUtil;
use com\web\SessionUtil;
use com\web\face\HtmlDocument;
use com\web\face\HtmlNode;

SessionUtil::commonPageLoadSessionStep(array("LOANOFFICER", "BANKOFFICER"));

$page = new HtmlDocument();
PageUtil::addHeaderToHtmlDocument($page);
PageUtil::addBannerAndNavControlsToHtmlDocument($page);

// TODO Ian Make me beautiful!
$center = new HtmlNode($page->getBody(), "center");
$portalDiv = new HtmlNode($center, "div");
$portalDiv->addAttribute("width", "85%");
$portalHeader = new HtmlNode($portalDiv, "h2");
$portalHeader->setNestedText("Officer Portal");
$linkList = new HtmlNode($portalDiv, "ul");

$viewLoansOption = new HtmlNode($linkList, "li");
$viewLoanReference = new HtmlNode($viewLoansOption, "a");
$viewLoanReference->addAttribute("href", "viewloans.php");
$viewLoanReference->setNestedText("View Loans");

$page->output();
