<?php

require_once dirname(__FILE__) . "\\..\\..\\sources\\CommonImports.php";

use com\web\PageUtil;
use com\web\SessionUtil;
use com\web\face\HtmlDocument;
use com\web\face\HtmlNode;

SessionUtil::commonPageLoadSessionStep(array("REGISTRAR"));

$page = new HtmlDocument();
PageUtil::addHeaderToHtmlDocument($page);
PageUtil::addBannerAndNavControlsToHtmlDocument($page);

$page->output();