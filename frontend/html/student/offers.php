<?php

require_once dirname(__FILE__) . "/../../sources/CommonImports.php";

use com\web\PageUtil;
use com\web\SessionUtil;
use com\web\face\HtmlDocument;
use com\web\face\HtmlNode;

SessionUtil::commonPageLoadSessionStep(array("STUDENT"));

$page = new HtmlDocument();

PageUtil::addHeaderToHtmlDocument($page);
PageUtil::addBannerAndNavControlsToHtmlDocument($page);

$mainContent = new HtmlNode($page->getBody(), "center");
$mainContent->addChild(new HtmlNode(null, "br"));

$mainContent = new HtmlNode($page->getBody(), "center");
$contentDiv = new HtmlNode($mainContent, "div");
$contentDiv->addAttribute("width", "85%");
$contentHeader = new HtmlNode($contentDiv, "h2");
$contentHeader->setNestedText("Loan Offers");

// TODO Ian make me beautiful!
$tableContainer = new HtmlNode($contentDiv, "div");
$tableContainer->addAttribute("class", "valueTableContainer");
$table = new HtmlNode($tableContainer, "table");

$headerRow = new HtmlNode($table, "tr");
$bankNameHeader = new HtmlNode($headerRow, "th");
$bankNameHeader->setNestedText("Bank");
$bankNameHeader = new HtmlNode($headerRow, "th");
$bankNameHeader->setNestedText("Interest");
$bankNameHeader = new HtmlNode($headerRow, "th");
$bankNameHeader->setNestedText("Offer Name");
$bankNameHeader = new HtmlNode($headerRow, "th");
$bankNameHeader->setNestedText("Terms");

$offerOptions = parse_ini_file(dirname(__FILE__) . "/../../config/loan-offers.ini", true);
$optionIds = array_keys($offerOptions);
foreach ($optionIds as $optionId) {
    $row = new HtmlNode($table, "tr");
    $bankNameCell = new HtmlNode($row, "td");
    $bankNameCell->setNestedText($offerOptions[$optionId]["bank"]);
    $bankNameCell = new HtmlNode($row, "td");
    $bankNameCell->setNestedText($offerOptions[$optionId]["interest"]);
    $bankNameCell = new HtmlNode($row, "td");
    $bankNameCell->setNestedText($offerOptions[$optionId]["name"]);
    $bankNameCell = new HtmlNode($row, "td");
    $bankNameCell->setNestedText($offerOptions[$optionId]["terms"]);
}

$page->output();