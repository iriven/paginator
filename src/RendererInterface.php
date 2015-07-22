<?php

namespace Studiow\Paginator;

use Studiow\Paginator\Paginator;

interface RendererInterface
{

    /**
     * Render the paginator
     *  
     * @param \Studiow\Paginator\Paginator $paginator
     * @return \Studiow\HTML\Element
     */
    public function paginator(Paginator $paginator);
}
