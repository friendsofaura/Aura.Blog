<?php
namespace Aura\Blog\Web\Responder;

use Aura\Web\Response;
use Aura\Blog\Web\Responder\BlogView;
use FOA\Responder_Bundle\AbstractResponder;

abstract class AbstractBlogResponder extends AbstractResponder
{
    protected function init()
    {
        parent::init();

        $view_names = array(
            'browse',
            'browse.json',
            'read',
            'read.json',
            'edit',
            'add',
            'delete-failure',
            'delete-success',
            '_form',
            '_intro',
            'missing'
        );

        $view_registry = $this->getRenderer()->getEngine()->getViewRegistry();
        foreach ($view_names as $name) {
            $view_registry->set(
                $name,
                __DIR__ . "/views/{$name}.php"
            );
        }

        $layout_names = array(
            'blog',
            'default',
            'default.json',
            'page',
            'post',
            // 'sidebar',
            'notfound'
        );

        $layout_registry = $this->getRenderer()->getEngine()->getLayoutRegistry();
        foreach ($layout_names as $name) {
            $layout_registry->set(
                $name,
                __DIR__ . "/layouts/{$name}.php"
            );
        }
    }
}
