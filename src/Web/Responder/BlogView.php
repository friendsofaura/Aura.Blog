<?php
namespace Aura\Blog\Web\Responder;

use Aura\Renderer\AuraView;

class BlogView extends AuraView
{
    public function getLayoutPath()
    {
        return dirname(dirname(dirname(__DIR__))) . '/layouts';
    }

    public function getLayoutVars()
    {
        $layout_vars = array(
            'default' => array(),
            'sidebar' => array(),
            'blog' => array(),
            'page' => array(),
            'post' => array(),
        );
        return $layout_vars;
    }

    public function getViewVars()
    {
        $name_vars = array(
            'browse' => array(),
            'browse.json' => array(),
            'read' => array(),
            'read.json' => array(),
            'edit' => array(),
            'add' => array(),
            'delete-failure' => array(),
            'delete-success' => array(),
            '_form' => array('method', 'action', 'submit', 'blog'),
            '_intro' => array('blog'),
        );
        return $name_vars;
    }

    public function getViewPath()
    {
        return __DIR__ . '/views';
    }
}
