<?php

require_once dirname(__FILE__) . "/../../sources/CommonImports.php";

use com\web\PageUtil;
use com\web\rest\RestTemplate;
use com\web\SessionUtil;
use com\web\face\HtmlDocument;
use com\web\face\HtmlNode;
use com\web\ValidationUtil;

/**
 * Handle a post.
 */
function handlePost() {
    if ($_POST["offer"] == 0) {
        ValidationUtil::validate("Please select a loan offer.");
        return;
    }

    if (!isset($_POST["amount"]) || $_POST["amount"] == null || $_POST["amount"] < 0) {
        ValidationUtil::validate("Please select an amount.");
        return;
    }

    $request["templateId"] = $_POST["offer"];
    $request["studentId"] = $_SESSION[SessionUtil::INFO_PROPERTY]["studentId"];

    $restTemplate = new RestTemplate();
    // TODO Make sure this is actually on the path
    $loanResponse = $restTemplate->makeRequest("/loan-application", $request);

    if (isset($loanResponse["result"]) && $loanResponse["result"] == "SUCCESS") {
        ValidationUtil::messageUser("Loan application submitted!");
    } else {
        if (isset($loanResponse["errorDescription"])) {
            ValidationUtil::validate($loanResponse["errorDescription"]);
        } else {
            ValidationUtil::validate("System error occurred. Please try again later.");
        }
    }
}

/**
 * Render the page.
 */
function doRender() {
    $page = new HtmlDocument();
    PageUtil::addHeaderToHtmlDocument($page);
    PageUtil::addBannerAndNavControlsToHtmlDocument($page);
    ValidationUtil::addMessagesToHtmlNode($page->getBody());

    $mainContent = new HtmlNode($page->getBody(), "center");
    $mainContent->addChild(new HtmlNode(null, "br"));
    $applicationContainer = new HtmlNode($mainContent, "div");
    $applicationContainer->addAttribute("style", "width:238px");
    $applicationForm = new HtmlNode($applicationContainer, "form");

    $applicationForm->addAttribute("id", "loanapplication");
    $applicationForm->addAttribute("method", "post");
    $applicationForm->addAttribute("name", "loanapplication");
    $applicationFields = new HtmlNode($applicationForm, "fieldset");
    $legend = new HtmlNode($applicationFields, "legend");
    $legend->addAttribute("style", "width: 65%");
    $legend->setNestedText("Loan Application");

    $offerInput = new HtmlNode($applicationFields, "p");
    $offerLabel = new HtmlNode($offerInput, "label");
    $offerLabel->addAttribute("for", "offer");
    $offerLabel->addAttribute("id", "offerLabel");
    $offerLabel->setNestedText("Offer:");
    $offerInput->addChild(new HtmlNode(null, "br"));
    $offerField = new HtmlNode($offerInput, "select");
    $offerField->addAttribute("style", "font-family: FreeMono; width:95%");
    $offerField->addAttribute("id", "offer");
    $offerField->addAttribute("name", "offer");

    $noneSelectedOption = new HtmlNode($offerField, "option");
    $noneSelectedOption->addAttribute("value", "0");
    $noneSelectedOption->addAttribute("selected", "selected");
    $noneSelectedOption->setNestedText(" - None Selected - ");

    $offerOptions = parse_ini_file(dirname(__FILE__) . "/../../config/loan-offers.ini", true);
    $optionIds = array_keys($offerOptions);
    foreach ($optionIds as $optionId) {
        $offerOption = new HtmlNode($offerField, "option");
        $offerOption->addAttribute("value", $optionId);

        $bankName = $offerOptions[$optionId]["bank"];
        $interest = $offerOptions[$optionId]["interest"];
        $loanName = $offerOptions[$optionId]["name"];
        $offerOption->setNestedText("$loanName ($interest interest, $bankName)");
    }

    $amountInput = new HtmlNode($applicationFields, "p");
    $amountLabel = new HtmlNode($amountInput, "label");
    $amountLabel->addAttribute("for", "amount");
    $amountLabel->addAttribute("id", "amountLabel");
    $amountLabel->setNestedText("Amount:");
    $amountInput->addChild(new HtmlNode(null, "br"));
    $amountField = new HtmlNode($amountInput, "input");
    $amountField->addAttribute("style", "font-family: FreeMono");
    $amountField->addAttribute("type", "number");
    $amountField->addAttribute("id", "amount");
    $amountField->addAttribute("name", "amount");

    $submissionButton = new HtmlNode($applicationFields, "div");
    $submissionButton->addAttribute("class", "rectangle centered");
    $submissionInput = new HtmlNode($submissionButton, "input");
    $submissionInput->addAttribute("type", "submit");
    $submissionInput->addAttribute("name", "apply");
    $submissionInput->addAttribute("value", "Apply");
    $submissionInput->addAttribute("class", "btn");

    $page->output();
}

SessionUtil::commonPageLoadSessionStep(array("STUDENT"));

if (isset($_POST["apply"])) {
    handlePost();
}

doRender();