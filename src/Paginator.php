<?php

namespace Studiow\Paginator;

use Studiow\HTML\Attributes;
use Studiow\Paginator\RendererInterface;
use Studiow\Paginator\Renderer\DefaultRenderer;

class Paginator
{

    use \Studiow\HTML\HasAttributesTrait;

    private $numPages;
    private $pageParamName;
    private $renderer;

    public function __construct($numPages, $pageParamName = 'p', $attributes = [], RendererInterface $renderer = null)
    {
        $this->setNumPages($numPages);
        $this->setPageParamName($pageParamName);
        $this->setAttributes(new Attributes((array) $attributes));
        $this->setRenderer(($renderer instanceof RendererInterface) ? $renderer : new DefaultRenderer());
    }

    public function setRenderer(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    public function getRenderer()
    {
        return $this->renderer;
    }

    public function setNumPages($num)
    {
        $this->numPages = intval($num);
        return $this;
    }

    public function getNumPages()
    {
        return $this->numPages;
    }

    public function setPageParamName($pageParamName)
    {
        $this->pageParamName = $pageParamName;
        return $this;
    }

    public function getPageParamName()
    {
        return $this->pageParamName;
    }

    public function getCurrentPage()
    {
        $num = filter_input(INPUT_GET, $this->getPageParamName(), FILTER_SANITIZE_NUMBER_INT);
        return intval($num);
    }

    public function __toString()
    {
        if ($this->getNumPages() == 0) {
            return '';
        }
        return (string) $this->getRenderer()->paginator($this);
    }

}
