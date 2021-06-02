<?php

require_once dirname(__FILE__) . "/../../sources/CommonImports.php";

use com\web\PageUtil;
use com\web\SessionUtil;
use com\web\ValidationUtil;
use com\web\face\HtmlDocument;
use com\web\face\HtmlNode;
use com\web\rest\RestTemplate;

SessionUtil::commonPageLoadSessionStep(array("REGISTRAR"));

$page = new HtmlDocument();

PageUtil::addHeaderToHtmlDocument($page);
PageUtil::addBannerAndNavControlsToHtmlDocument($page);

// Get the actual data from the backend
$filterRequest["bankId"] = null;
if (isset($_POST["filter"]) && isset($_POST["bankOpt"]) && $_POST["bankOpt"] != 0) {
    $filterRequest["bankId"] = $_POST["bankOpt"];
}

if (isset($_POST["filter"]) && isset($_POST["studentOpt"]) && $_POST["studentOpt"] != 0) {
    $filterRequest["studentId"] = $_POST["studentOpt"];
}

if (isset($_POST["filter"]) && isset($_POST["schoolOpt"]) && $_POST["schoolOpt"] != '0') {
    $filterRequest["schoolName"] = $_POST["schoolOpt"];
}

$loans = array();
$restTemplate = new RestTemplate();
$loansRsp = $restTemplate->makeRequest("/loan-list", $filterRequest);
if (isset($loansRsp["loanList"])) {
    $loans = $loansRsp["loanList"];
} else {
    ValidationUtil::validate("Error occurred while fetching loans.");
}

ValidationUtil::addMessagesToHtmlNode($page->getBody());

// Do normal page generation stuff
$mainContent = new HtmlNode($page->getBody(), "center");
$mainContent->addChild(new HtmlNode(null, "br"));

$mainContent = new HtmlNode($page->getBody(), "center");
$contentDiv = new HtmlNode($mainContent, "div");
$contentDiv->addAttribute("width", "85%");
$contentHeader = new HtmlNode($contentDiv, "h2");
$contentHeader->setNestedText("Student Loans");

// TODO Ian make me beautiful!

// Create filter bar
$filterOrganizer = new HtmlNode($contentDiv, "form");
$filterOrganizer->addAttribute("id", "filterForm");
$filterOrganizer->addAttribute("method", "post");
$filterOrganizer->addAttribute("name", "filterForm");
$filterOrganizer->addAttribute("class", "filterbar");

// Use loan list to get unique ranges
$studentRange = array();
$schoolRange = array();
$bankRange = array();
foreach ($loans as $loan) {
    $studentRange[$loan["studentId"]] = $loan["studentName"];
    $schoolRange[$loan["school"]] = 1;
    $bankRange[$loan["bankId"]] = $loan["bank"];
}
$studentFilterFieldLabel = new HtmlNode($filterOrganizer, "label");
$studentFilterFieldLabel->addAttribute("for", "studentOpt");
$studentFilterFieldLabel->addAttribute("id", "studentOpt");
$studentFilterFieldLabel->setNestedText("Student:");
$studentField = new HtmlNode($filterOrganizer, "select");
$studentField->addAttribute("id", "studentOpt");
$studentField->addAttribute("name", "studentOpt");

// Create student options
if (!(isset($_POST["studentOpt"]) && $_POST["studentOpt"] != 0) || isset($_POST["reset"])) {
    $noneSelectedOption = new HtmlNode($studentField, "option");
    $noneSelectedOption->addAttribute("value", "0");
    $noneSelectedOption->addAttribute("selected", "selected");
    $noneSelectedOption->setNestedText(" - None Selected - ");
}

$studentOptionIds = array_keys($studentRange);
foreach ($studentOptionIds as $studentOptionId) {
    $studentName = $studentRange[$studentOptionId];

    $studentOption = new HtmlNode($studentField, "option");
    $studentOption->addAttribute("value", $studentOptionId);
    $studentOption->setNestedText($studentName);
}

$schoolFilterFieldLabel = new HtmlNode($filterOrganizer, "label");
$schoolFilterFieldLabel->addAttribute("for", "schoolOpt");
$schoolFilterFieldLabel->addAttribute("id", "schoolOpt");
$schoolFilterFieldLabel->setNestedText("School:");
$schoolField = new HtmlNode($filterOrganizer, "select");
$schoolField->addAttribute("id", "schoolOpt");
$schoolField->addAttribute("name", "schoolOpt");

// Create school options
if (!(isset($_POST["schoolOpt"]) && $_POST["schoolOpt"] != '0') || isset($_POST["reset"])) {
    $noneSelectedOption = new HtmlNode($schoolField, "option");
    $noneSelectedOption->addAttribute("value", "0");
    $noneSelectedOption->addAttribute("selected", "selected");
    $noneSelectedOption->setNestedText(" - None Selected - ");
}

$schoolNames = array_keys($schoolRange);
foreach ($schoolNames as $schoolName) {
    $schoolOption = new HtmlNode($schoolField, "option");
    $schoolOption->addAttribute("value", $schoolName);
    $schoolOption->setNestedText($schoolName);
}

$bankFilterFieldLabel = new HtmlNode($filterOrganizer, "label");
$bankFilterFieldLabel->addAttribute("for", "bankOpt");
$bankFilterFieldLabel->addAttribute("id", "bankOpt");
$bankFilterFieldLabel->setNestedText("Bank:");
$bankField = new HtmlNode($filterOrganizer, "select");
$bankField->addAttribute("id", "bankOpt");
$bankField->addAttribute("name", "bankOpt");

// Create bank options
if (!(isset($_POST["bankOpt"]) && $_POST["bankOpt"] != 0) || isset($_POST["reset"])) {
    $noneSelectedOption = new HtmlNode($bankField, "option");
    $noneSelectedOption->addAttribute("value", "0");
    $noneSelectedOption->addAttribute("selected", "selected");
    $noneSelectedOption->setNestedText(" - None Selected - ");
}

$bankOptionIds = array_keys($bankRange);
foreach ($bankOptionIds as $bankOptionId) {
    $bankName = $bankRange[$bankOptionId];

    $bankOption = new HtmlNode($bankField, "option");
    $bankOption->addAttribute("value", $bankOptionId);
    $bankOption->setNestedText($bankName);
}

// Create a reset button
$resetInput = new HtmlNode($filterOrganizer, "input");
$resetInput->addAttribute("type", "submit");
$resetInput->addAttribute("name", "reset");
$resetInput->addAttribute("value", "Reset");
$resetInput->addAttribute("class", "btn");

// Create a submit button
$resetInput = new HtmlNode($filterOrganizer, "input");
$resetInput->addAttribute("type", "submit");
$resetInput->addAttribute("name", "filter");
$resetInput->addAttribute("value", "Filter");
$resetInput->addAttribute("class", "btn");

// The actual table content
$tableContainer = new HtmlNode($contentDiv, "div");
$tableContainer->addAttribute("class", "valueTableContainer");
$table = new HtmlNode($tableContainer, "table");

// Add a header row
$headerRow = new HtmlNode($table, "tr");
$studentHeader = new HtmlNode($headerRow, "th");
$studentHeader->setNestedText("Student");
$schoolHeader = new HtmlNode($headerRow, "th");
$schoolHeader->setNestedText("School");
$amountHeader = new HtmlNode($headerRow, "th");
$amountHeader->setNestedText("Bank");
$amountHeader = new HtmlNode($headerRow, "th");
$amountHeader->setNestedText("Amount");
$interestHeader = new HtmlNode($headerRow, "th");
$interestHeader->setNestedText("Tuition");

// Add the table's data
foreach ($loans as $loan) {
    $row = new HtmlNode($table, "tr");

    $studentCell = new HtmlNode($row, "td");
    $studentCell->setNestedText($loan["studentName"]);
    $schoolCell = new HtmlNode($row, "td");
    $schoolCell->setNestedText($loan["school"]);
    $bankCell = new HtmlNode($row, "td");
    $bankCell->setNestedText($loan["bank"]);
    $amountCell = new HtmlNode($row, "td");
    $amountCell->setNestedText($loan["amount"]);
    $tuitionCell = new HtmlNode($row, "td");
    $tuitionCell->setNestedText($loan["tuition"]);
}

$page->output();
