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
(new HtmlNode($page->getHead(), "title"))->setNestedText("\$Post-Ya-Loan - Student Dashboard");

// TODO Ian Make me beautiful!
$center = new HtmlNode($page->getBody(), "center");
$portalDiv = new HtmlNode($center, "div");
$portalDiv->addAttribute("width", "85%");
$portalDiv->addAttribute("style","font-family: FreeMono");
$portalHeader = new HtmlNode($portalDiv, "h2");
$portalHeader->setNestedText("Student Portal");

$containerDiv = new HtmlNode($center,"div");
$containerDiv->addAttribute("class","container");
	$rowsDiv=new HtmlNode($containerDiv,"div");
	$rowsDiv->addAttribute("class","row");
		$col1Div =new HtmlNode($rowsDiv,"div");
		$col1Div->addAttribute("class","col");
			$loanAppImg= new HtmlNode($col1Div, "div");
				$loanAppImg->addAttribute("class","photo-container");
				$loanAppImg->addAttribute("style", "background-image:url(/css/images/applyLoan.jpg);");
			$img1Title = new HtmlNode($col1Div,"h2");
				$img1Title->setNestedText("Loan Application");
			$img1TextCon= new HtmlNode($col1Div,"div");
				$img1TextCon->addAttribute("class","slide");
			$img1Text = new HtmlNode($img1TextCon,"p");	
			$img1Text->setNestedText("Apply for any one of our loans:\n\t• Presidential Loan\n\t•Honors Loan\n\t• Scholars Loan\n\t• Honey Loan\n\t• Sweet Honey Loan\n\t• Larvae Loan");
		
	$col2Div =new HtmlNode($rowsDiv,"div");
	$col2Div->addAttribute("class","col");
$linkList = new HtmlNode($containerDiv, "ul");

$applyForLoanOption = new HtmlNode($linkList, "li");
$applyReference = new HtmlNode($applyForLoanOption, "a");
$applyReference->addAttribute("href", "apply.php");
$applyReference->setNestedText("Apply For Loan");

$viewOffersOption = new HtmlNode($linkList, "li");
$viewOfferReference = new HtmlNode($viewOffersOption, "a");
$viewOfferReference->addAttribute("href", "offers.php");
$viewOfferReference->setNestedText("Loan Offers");

$page->output();
