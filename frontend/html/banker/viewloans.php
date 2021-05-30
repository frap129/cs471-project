<?php

require_once dirname(__FILE__) . "/../../sources/CommonImports.php";

use com\web\PageUtil;
use com\web\SessionUtil;
use com\web\ValidationUtil;
use com\web\face\HtmlDocument;
use com\web\face\HtmlNode;
use com\web\rest\RestTemplate;

SessionUtil::commonPageLoadSessionStep(array("LOANOFFICER", "BANKOFFICER"));

$page = new HtmlDocument();

PageUtil::addHeaderToHtmlDocument($page);
PageUtil::addBannerAndNavControlsToHtmlDocument($page);

// Get the actual data from the backend
$filterRequest["bankId"] = $_SESSION[SessionUtil::INFO_PROPERTY]["bankId"];
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
foreach ($loans as $loan) {
    $studentRange[$loan["studentId"]] = $loan["studentName"];
    $schoolRange[$loan["school"]] = 1;
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
$amountHeader = new HtmlNode($headerRow, "th");
$amountHeader->setNestedText("Amount");
$studentHeader = new HtmlNode($headerRow, "th");
$studentHeader->setNestedText("Student");
$schoolHeader = new HtmlNode($headerRow, "th");
$schoolHeader->setNestedText("School");
$interestHeader = new HtmlNode($headerRow, "th");
$interestHeader->setNestedText("Interest");

// Add the table's data
foreach ($loans as $loan) {
    $row = new HtmlNode($table, "tr");
    $amountCell = new HtmlNode($row, "td");
    $loanLink = new HtmlNode($amountCell, "a");
    $loanLink->setNestedText($loan["amount"]);
    $loanLink->addAttribute("href", "loandetail.php?id=" . $loan["loanId"]);

    $studentCell = new HtmlNode($row, "td");
    $studentCell->setNestedText($loan["studentName"]);
    $schoolCell = new HtmlNode($row, "td");
    $schoolCell->setNestedText($loan["school"]);
    $interestCell = new HtmlNode($row, "td");
    $interestCell->setNestedText($loan["interest"]);
}

$page->output();