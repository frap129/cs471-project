<?php

require_once dirname(__FILE__) . "/../../sources/CommonImports.php";

use com\web\PageUtil;
use com\web\SessionUtil;
use com\web\ValidationUtil;
use com\web\face\HtmlDocument;
use com\web\face\HtmlNode;
use com\web\rest\RestTemplate;

function handlePost() {

}

function render(HtmlDocument $page) {
    if (!isset($_GET["id"])) {
        ValidationUtil::validate("No loan selected.");
        ValidationUtil::addMessagesToHtmlNode($page->getBody());
        return;
    }

    $loanId = $_GET["id"];
    $bankId = $_SESSION[SessionUtil::INFO_PROPERTY]["bankId"];

    $request["loanId"] = $loanId;
    $request["bankerId"] = $bankId;

    $restTemplate = new RestTemplate();
    $loanDetail = null;

    try {
        $loanDetail = $restTemplate->makeRequest("/getLoan", $request);
    } catch (\Exception $exception) {
        // Handles technical issue like service outage
        ValidationUtil::validate("Failed to retrieve loan information.");
        ValidationUtil::addMessagesToHtmlNode($page->getBody());
        return;
    }

    // Null JSON payload means server said 403 (use a strict operator here)
    if ($loanDetail === null) {
        ValidationUtil::validate("You do not have permission to view this loan.");
        ValidationUtil::addMessagesToHtmlNode($page->getBody());
        return;
    }

    $name = $loanDetail["name"];
    $address = $loanDetail["address"];
    $school = $loanDetail["school"];
    $tuition = $loanDetail["tuition"];
    $familyIncome = $loanDetail["familyIncome"];
    $creditScore = $loanDetail["creditScore"];
    $loanAmount = $loanDetail["loanAmount"];
    $interest = $loanDetail["interest"];
    $terms = $loanDetail["terms"];
    $renderApprovalButton = strcmp($loanDetail["status"], "PENDING") == 0 &&
        strcmp($_SESSION[SessionUtil::ROLE_PROPERTY], "LOANOFFICER") == 0;

    ValidationUtil::addMessagesToHtmlNode($page->getBody());

    // Do normal page generation stuff
    $mainContent = new HtmlNode($page->getBody(), "center");
    $mainContent->addChild(new HtmlNode(null, "br"));

    $mainContent = new HtmlNode($page->getBody(), "center");
    $contentDiv = new HtmlNode($mainContent, "div");
    $contentDiv->addAttribute("width", "85%");
    $contentHeader = new HtmlNode($contentDiv, "h2");
    $contentHeader->setNestedText("Loan Information");

    // TODO Ian make me beautiful!
    if ($renderApprovalButton) {
        $buttonForm = new HtmlNode($contentDiv, "form");
        $buttonForm->addAttribute("id", "loanapproval");
        $buttonForm->addAttribute("method", "post");
        $buttonForm->addAttribute("name", "loanapproval");

        $approvalInput = new HtmlNode($buttonForm, "input");
        $approvalInput->addAttribute("type", "submit");
        $approvalInput->addAttribute("name", "approval");
        $approvalInput->addAttribute("value", "Approve");
        $approvalInput->addAttribute("class", "btn");

        $denyInput = new HtmlNode($buttonForm, "input");
        $denyInput->addAttribute("type", "submit");
        $denyInput->addAttribute("name", "denial");
        $denyInput->addAttribute("value", "Deny");
        $denyInput->addAttribute("class", "btn");
    }

    $fieldOrganizer = new HtmlNode($contentDiv, "div");

    $studentDetailOrganizer = new HtmlNode($fieldOrganizer, "div");
    $studentDetailOrganizer->addAttribute("style", "float: left; width: 50%;");
    $studentDetailHeader = new HtmlNode($studentDetailOrganizer, "h4");
    $studentDetailHeader->setNestedText("Student Information");

    $nameLabel = new HtmlNode($studentDetailOrganizer, "label");
    $nameLabel->addAttribute("for", "studentName");
    $nameLabel->addAttribute("style", "display: flex;");
    $nameLabel->setNestedText("Name");
    $nameInput = new HtmlNode($studentDetailOrganizer, "input");
    $nameInput->addAttribute("style", "display: flex;");
    $nameInput->addAttribute("readonly", "readonly");
    $nameInput->addAttribute("id", "studentName");
    $nameInput->addAttribute("name", "studentName");
    $nameInput->addAttribute("value", "$name");

    $addressLabel = new HtmlNode($studentDetailOrganizer, "label");
    $addressLabel->addAttribute("for", "studentaddress");
    $addressLabel->addAttribute("style", "display: flex;");
    $addressLabel->setNestedText("Address");
    $addressInput = new HtmlNode($studentDetailOrganizer, "input");
    $addressInput->addAttribute("style", "display: flex;");
    $addressInput->addAttribute("readonly", "readonly");
    $addressInput->addAttribute("id", "studentaddress");
    $addressInput->addAttribute("name", "studentaddress");
    $addressInput->addAttribute("value", "$address");

    $schoolLabel = new HtmlNode($studentDetailOrganizer, "label");
    $schoolLabel->addAttribute("for", "studentSchool");
    $schoolLabel->addAttribute("style", "display: flex;");
    $schoolLabel->setNestedText("School");
    $schoolInput = new HtmlNode($studentDetailOrganizer, "input");
    $schoolInput->addAttribute("style", "display: flex;");
    $schoolInput->addAttribute("readonly", "readonly");
    $schoolInput->addAttribute("id", "studentSchool");
    $schoolInput->addAttribute("name", "studentSchool");
    $schoolInput->addAttribute("value", "$school");

    $tuitionLabel = new HtmlNode($studentDetailOrganizer, "label");
    $tuitionLabel->addAttribute("for", "tuition");
    $tuitionLabel->addAttribute("style", "display: flex;");
    $tuitionLabel->setNestedText("Tuition");
    $tuitionInput = new HtmlNode($studentDetailOrganizer, "input");
    $tuitionInput->addAttribute("style", "display: flex;");
    $tuitionInput->addAttribute("readonly", "readonly");
    $tuitionInput->addAttribute("id", "tuition");
    $tuitionInput->addAttribute("name", "tuition");
    $tuitionInput->addAttribute("value", "$tuition");

    $familyInputLabel = new HtmlNode($studentDetailOrganizer, "label");
    $familyInputLabel->addAttribute("for", "familyIncome");
    $familyInputLabel->addAttribute("style", "display: flex;");
    $familyInputLabel->setNestedText("Family Income");
    $familyIncomeInput = new HtmlNode($studentDetailOrganizer, "input");
    $familyIncomeInput->addAttribute("style", "display: flex;");
    $familyIncomeInput->addAttribute("readonly", "readonly");
    $familyIncomeInput->addAttribute("id", "familyIncome");
    $familyIncomeInput->addAttribute("name", "familyIncome");
    $familyIncomeInput->addAttribute("value", "$familyIncome");

    $creditScoreLabel = new HtmlNode($studentDetailOrganizer, "label");
    $creditScoreLabel->addAttribute("for", "creditScore");
    $creditScoreLabel->addAttribute("style", "display: flex;");
    $creditScoreLabel->setNestedText("Credit Score");
    $creditScoreInput = new HtmlNode($studentDetailOrganizer, "input");
    $creditScoreInput->addAttribute("style", "display: flex;");
    $creditScoreInput->addAttribute("readonly", "readonly");
    $creditScoreInput->addAttribute("id", "creditScore");
    $creditScoreInput->addAttribute("name", "creditScore");
    $creditScoreInput->addAttribute("value", "$creditScore");

    $loanFinancialsOrganizer = new HtmlNode($fieldOrganizer, "div");
    $loanFinancialsOrganizer->addAttribute("style", "float: left; width: 50%");
    $loanFinancesHeader = new HtmlNode($loanFinancialsOrganizer, "h4");
    $loanFinancesHeader->setNestedText("Loan Financials");

    $amountLabel = new HtmlNode($loanFinancialsOrganizer, "label");
    $amountLabel->addAttribute("for", "loanAmount");
    $amountLabel->addAttribute("style", "display: flex;");
    $amountLabel->setNestedText("Amount");
    $amountInput = new HtmlNode($loanFinancialsOrganizer, "input");
    $amountInput->addAttribute("style", "display: flex;");
    $amountInput->addAttribute("readonly", "readonly");
    $amountInput->addAttribute("id", "loanAmount");
    $amountInput->addAttribute("name", "loanAmount");
    $amountInput->addAttribute("value", "$loanAmount");

    $interestExpression = $interest * 100;
    $interestLabel = new HtmlNode($loanFinancialsOrganizer, "label");
    $interestLabel->addAttribute("for", "interest");
    $interestLabel->addAttribute("style", "display: flex;");
    $interestLabel->setNestedText("Interest");
    $interestInput = new HtmlNode($loanFinancialsOrganizer, "input");
    $interestInput->addAttribute("style", "display: flex;");
    $interestInput->addAttribute("readonly", "readonly");
    $interestInput->addAttribute("id", "interest");
    $interestInput->addAttribute("name", "interest");
    $interestInput->addAttribute("value", "$interestExpression%");

    $termsLabel = new HtmlNode($loanFinancialsOrganizer, "label");
    $termsLabel->addAttribute("for", "terms");
    $termsLabel->addAttribute("style", "display: flex;");
    $termsLabel->setNestedText("Terms");
    $termsInput = new HtmlNode($loanFinancialsOrganizer, "input");
    $termsInput->addAttribute("style", "display: flex;");
    $termsInput->addAttribute("readonly", "readonly");
    $termsInput->addAttribute("id", "terms");
    $termsInput->addAttribute("name", "terms");
    $termsInput->addAttribute("value", "$terms");
}

SessionUtil::commonPageLoadSessionStep(array("LOANOFFICER", "BANKOFFICER"));

$page = new HtmlDocument();

PageUtil::addHeaderToHtmlDocument($page);
PageUtil::addBannerAndNavControlsToHtmlDocument($page);

if (isset($_POST["approval"]) && isset($_POST["denial"])) {
    handlePost();
}

render($page);

$page->output();