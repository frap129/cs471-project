<?php

namespace com\employu\web\face;

require_once dirname(__FILE__) . "/HtmlNode.php";

/**
 * HTML document.
 * @author Andy Gabler
 * @since 2019/10/25
 */
class HtmlDocument {

    private $outputComplete = false;

    private $htmlParent = null;
    private $head = null;
    private $body = null;

    /**
     * HtmlDocument constructor.
     */
    function __construct() {
        $this->htmlParent = new HtmlNode(null, "html");
        $this->head = new HtmlNode($this->htmlParent, "head");
        $this->body = new HtmlNode($this->htmlParent, "body");
    }

    /**
     * Output the document to the web page.
     */
    public function output() {
        if ($this->outputComplete) {
            throw new \BadMethodCallException("Output on HtmlDocument may only be done once.");
        }


        /*
         * Hi! Are you getting weird bugs? Why not uncomment below lines and see what your HTML output looks like!
         */
        //echo htmlentities($this->head->stringify(), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        //echo htmlentities($this->body->stringify(), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        echo $this->htmlParent->stringify();

        $this->outputComplete = true;
    }

    /**
     * Get the head node.
     * @return HtmlNode Node that has header information
     */
    public function getHead() : HtmlNode {
        return $this->head;
    }

    /**
     * Get the body node.
     * @return HtmlNode Node that has body information
     */
    public function getBody() : HtmlNode {
        return $this->body;
    }

}