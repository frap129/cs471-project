<?php

namespace com\web\face;

/**
 * Node on an HTML document.
 * @author Andy Gabler
 * @since 2019/10/25
 */
class HtmlNode {

    private $parent = null;
    private $children = array();

    private $name = "";

    private $attributeNames = array();
    private $attributeValues = array();

    private $attributeLength = 0;

    private $nestedText = "";

    /**
     * Create HTML node.
     * @param HtmlNode|null $parent Parent node
     * @param string $name Tag of the node
     */
    function __construct(?HtmlNode $parent, string $name) {
        $this->parent = $parent;
        $this->name = $name;
        if ($parent != null) {
            array_push($parent->children, $this);
        }
    }

    /**
     * Add an attribute to the node.
     * @param string $name The name of the attribute
     * @param string $value The property value of the attribute
     */
    public function addAttribute(string $name, string $value) {
        //Not going to bother encoding the name
        $this->attributeNames[$this->attributeLength] = $name;
        $this->attributeValues[$this->attributeLength] = htmlentities($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $this->attributeLength = $this->attributeLength + 1;
    }

    /**
     * Set the nested text on the node.
     * @param string $text The text
     */
    public function setNestedText(string $text) {
        $this->nestedText = htmlentities($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Serialize the node as it would appear on an html document.
     * @return string The value of the node
     */
    public function stringify() : string {
        $output = "<$this->name";

        $counter = 0;
        while ($counter < $this->attributeLength) {
            $name = $this->attributeNames[$counter];
            $value = $this->attributeValues[$counter];

            $output = $output . " $name=\"$value\"";

            $counter = $counter + 1;
        }

        
        $output .= ">$this->nestedText";
        foreach ($this->children as $child) {
            $output .= "\n" . $child->stringify();
        }
        
        $output .= "</$this->name>\n";
        return $output;
    }

    /**
     * Add a child to the node.
     * @param HtmlNode $child The child to add
     */
    public function addChild(HtmlNode $child) {
        array_push($this->children, $child);
        $child->parent = $this;
    }

}