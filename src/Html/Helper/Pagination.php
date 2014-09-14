<?php
namespace Aura\Blog\Html\Helper;

use Aura\Html\Helper\AbstractHelper;
use Aura\Html\Helper\Ul;
use Kilte\Pagination\Pagination as KiltePagination;

class Pagination extends AbstractHelper
{
    protected $ul;

    protected $anchor;

    protected $router;

    public function setUl(Ul $ul)
    {
        $this->ul = $ul;
    }

    public function setAnchor($anchor)
    {
        $this->anchor = $anchor;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }

    public function __invoke($route_name, $arguments, $total_items, $current_page, $items_per_page = 10, $neighbours = 1, $attr = null)
    {
        $pagination = new KiltePagination($total_items, $current_page, $items_per_page, $neighbours);
        $pages = $pagination->build();
        if (empty($pages)) {
            return '';
        }
        $ul = $this->ul->__invoke($attr);
        $items = array();
        foreach ($pages as $page => $value) {
            $arguments = array_merge($arguments, array('page' => $page));
            $extra = array();
            if ($page == $current_page) {
                $items[$this->anchor->__invoke($this->router->generate($route_name, $arguments), $value)] = array('class' => "active");
            } else {
                $items[] = $this->anchor->__invoke($this->router->generate($route_name, $arguments), $value);
            }
        }
        return $ul->rawItems($items)->__toString();
    }
}
