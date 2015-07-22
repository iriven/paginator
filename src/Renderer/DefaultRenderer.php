<?php

namespace Studiow\Paginator\Renderer;

use Studiow\Paginator\RendererInterface;
use Studiow\Paginator\Paginator;
use Studiow\HTML\Element;

class DefaultRenderer implements RendererInterface
{

    public function paginator(Paginator $paginator)
    {
        $links = $this->getLinks($paginator);


        $inner = new Element('ul', implode('', $links), ['class' => 'paginator-inner']);
        $wrapper = new Element('div', $inner, (array) $paginator->getAttributes());
        $wrapper->addClass('paginator');
        return $wrapper;
    }

    protected function getLinks(Paginator $paginator)
    {
        $links = [];
        $current = $paginator->getCurrentPage();
        $paramName = $paginator->getPageParamName();
        $total = $paginator->getNumPages();
        for ($a = 0; $a < $paginator->getNumPages(); $a++) {
            $links[] = $this->wrapLink($this->linkElement($a, $a + 1, $paramName), $a == $current);
        }

        return $this->addExtraLinks($links, $current, $total, $paramName);
    }

    protected function addExtraLinks($links, $current, $total, $paramName)
    {

        if ($current > 0) {
            array_unshift($links, $this->wrapLink($this->linkElement($current - 1, '&lt;', $paramName))->addClass('paginator-prev'));
            array_unshift($links, $this->wrapLink($this->linkElement(0, '&laquo;', $paramName))->addClass('paginator-first'));
        }

        if ($current < $total - 1) {
            array_push($links, $this->wrapLink($this->linkElement($current + 1, '&gt;', $paramName))->addClass('paginator-next'));
            array_push($links, $this->wrapLink($this->linkElement($total - 1, '&raquo;', $paramName))->addClass('paginator-last'));
        }
        return $links;
    }

    protected function link($index, $paramName)
    {
        return "?" . http_build_query(array_merge($_GET, [$paramName => $index]));
    }

    protected function linkElement($index, $label, $paramName)
    {
        $link = $this->link($index, $paramName);
        return new Element('a', $label, ['href' => $this->link($index, $paramName)]);
    }

    protected function wrapLink($link_element, $isCurrent = false)
    {
        $element = new Element('li', $link_element);
        if ($isCurrent) {
            $element->addClass("current");
        }
        return $element;
    }

}
