<!DOCTYPE html>
<?php

require_once dirname(__FILE__) . "\\..\\sources\\CommonImports.php";

// TODO validation message

use com\web\PageUtil;
use com\web\SessionUtil;

use com\web\face\HtmlDocument;
use com\web\face\HtmlNode;

use com\web\rest\RestTemplate;

function doRender() {
    $page = new HtmlDocument();

    PageUtil::addHeaderToHtmlDocument($page);
    PageUtil::addBannerAndNavControlsToHtmlDocument($page);

    $mainContent = new HtmlNode($page->getBody(), "center");
    $mainContent->addChild(new HtmlNode(null, "br"));
    $loginContainer = new HtmlNode($mainContent, "div");
    $loginContainer->addAttribute("style", "width:238px");
    $loginForm = new HtmlNode($loginContainer, "form");

    $loginForm->addAttribute("id", "loginform");
    $loginForm->addAttribute("method", "post");
    $loginForm->addAttribute("name", "loginForm");
    $loginFields = new HtmlNode($loginForm, "fieldset");
    $legend = new HtmlNode($loginFields, "legend");
    $legend->setNestedText("Login");

    $userName = "";
    if (isset($_POST["uname"])) {
        $userName = $_POST["uname"];
    }

    $usernameInput = new HtmlNode($loginFields, "p");
    $usernameLabel = new HtmlNode($usernameInput, "label");
    $usernameLabel->addAttribute("for", "uname");
    $usernameLabel->addAttribute("id", "unameLabel");
    $usernameLabel->setNestedText("User Name:");
    $usernameInput->addChild(new HtmlNode(null, "br"));
    $usernameField = new HtmlNode($usernameInput, "input");
    $usernameField->addAttribute("style", "font-family: FreeMono");
    $usernameField->addAttribute("type", "text");
    $usernameField->addAttribute("id", "uname");
    $usernameField->addAttribute("name", "uname");
    $usernameField->addAttribute("value", $userName);

    $passwordInput = new HtmlNode($loginFields, "p");
    $passwordLabel = new HtmlNode($passwordInput, "label");
    $passwordLabel->addAttribute("for", "pass");
    $passwordLabel->addAttribute("id", "passLabel");
    $passwordLabel->setNestedText("Password:");
    $passwordInput->addChild(new HtmlNode(null, "br"));
    $passwordField = new HtmlNode($passwordInput, "input");
    $passwordField->addAttribute("style", "font-family: FreeMono");
    $passwordField->addAttribute("type", "password");
    $passwordField->addAttribute("id", "pass");
    $passwordField->addAttribute("name", "pass");

    $submissionButton = new HtmlNode($loginFields, "div");
    $submissionButton->addAttribute("class", "rectangle centered");
    $submissionInput = new HtmlNode($submissionButton, "input");
    $submissionInput->addAttribute("type", "submit");
    $submissionInput->addAttribute("name", "signIn");
    $submissionInput->addAttribute("value", "Sign In");
    $submissionInput->addAttribute("class", "btn");

    $page->output();
}

function handlePost() {
    if (!isset($_POST["pass"]) || !isset($_POST["uname"])) {
        // TODO save validation message in session
        return;
    }

    $loginRequest["username"] = $_POST["uname"];
    $loginRequest["password"] = $_POST["pass"];

    $restTemplate = new RestTemplate();
    $response = $restTemplate->makeRequest("/login", $loginRequest);

    $_SESSION[SessionUtil::AUTHENTICATED_PROPERTY] = $response["authenticated"];

    if (!$_SESSION[SessionUtil::AUTHENTICATED_PROPERTY]) {
        // TODO validation
        return;
    }

    $_SESSION[SessionUtil::ROLE_PROPERTY] = $response["role"];
    $_SESSION[SessionUtil::NAME_PROPERTY] = $response["name"];

    if (($response["role"] == "BANKOFFICER" || $response["role"] == "LOANOFFICER") && isset($response["bankInfo"])) {
        $_SESSION[SessionUtil::INFO_PROPERTY] = $response["bankInfo"];
    } else if ($response["role"] == "STUDENT" && isset($response["studentInfo"])) {
        $_SESSION[SessionUtil::INFO_PROPERTY] = $response["studentInfo"];
    }
    SessionUtil::forwardAuthenticatedSession();
}

SessionUtil::commonPageLoadSessionStep(null);

if (isset($_POST["signIn"])) {
    handlePost();
}

doRender();
