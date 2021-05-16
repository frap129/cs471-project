<?php

require_once dirname(__FILE__) . "\\..\\..\\sources\\CommonImports.php";

use com\web\PageUtil;
use com\web\SessionUtil;
use com\employu\web\face\HtmlDocument;
use com\employu\web\face\HtmlNode;

SessionUtil::commonPageLoadSessionStep(array("LOANOFFICER", "BANKOFFICER"));

$page = new HtmlDocument();
PageUtil::addHeaderToHtmlDocument($page);
PageUtil::addBannerAndNavControlsToHtmlDocument($page);

$page->output();