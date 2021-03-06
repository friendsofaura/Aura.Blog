<?php
namespace Aura\Blog\_Config;

use Aura\Di\Config;
use Aura\Di\Container;

class Common extends Config
{
    public function define(Container $di)
    {
        $di->params['Aura\Asset_Bundle\AssetService']['map']['aura/blog'] = dirname(__DIR__) . '/web';

        $di->params['Aura\Blog\Web\AbstractResponder']['response'] = $di->lazyGet('aura/web-kernel:response');

        $di->params['Aura\Blog\Web\Action\BlogBrowseAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogBrowseAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogBrowseAction']['responder'] = $di->lazyGet('aura/blog:web_responder_blog_browse');

        $di->params['Aura\Blog\Web\Action\BlogReadAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogReadAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogReadAction']['responder'] = $di->lazyGet('aura/blog:web_responder_blog_read');

        $di->params['Aura\Blog\Web\Action\BlogAddAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogAddAction']['responder'] = $di->lazyGet('aura/blog:web_responder_blog_add');

        $di->params['Aura\Blog\Web\Action\BlogCreateAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogCreateAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogCreateAction']['responder'] = $di->lazyGet('aura/blog:web_responder_blog_create');

        $di->params['Aura\Blog\Web\Action\BlogEditAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogEditAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogEditAction']['responder'] = $di->lazyGet('aura/blog:web_responder_blog_edit');

        $di->params['Aura\Blog\Web\Action\BlogUpdateAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogUpdateAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogUpdateAction']['responder'] = $di->lazyGet('aura/blog:web_responder_blog_update');

        $di->params['Aura\Blog\Web\Action\BlogDeleteAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogDeleteAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogDeleteAction']['responder'] = $di->lazyGet('aura/blog:web_responder_blog_delete');

        $di->params['Aura\Blog\Domain\BlogGateway']['pdo'] = $di->lazyNew('Aura\Sql\ExtendedPdo');
        $di->params['Aura\Blog\Domain\BlogGateway']['factory'] = $di->lazyNew('Aura\Blog\Domain\BlogFactory');

        $di->params['Aura\Blog\Domain\BlogService']['gateway'] = $di->lazyNew('Aura\Blog\Domain\BlogGateway');
        $di->params['Aura\Blog\Domain\BlogService']['factory'] = $di->lazyNew('Aura\Blog\Domain\BlogFactory');
        $di->params['Aura\Blog\Domain\BlogService']['payload_factory'] = $di->lazyNew('FOA\DomainPayload\PayloadFactory');
        $di->params['Aura\Blog\Domain\BlogService']['form'] = $di->lazyGet('aura/blog:input_blog_form');

        $di->setter['Aura\Blog\Html\Helper\Pagination']['setUl'] = $di->lazyNew('Aura\Html\Helper\Ul');
        $di->setter['Aura\Blog\Html\Helper\Pagination']['setAnchor'] = $di->lazyNew('Aura\Html\Helper\Anchor');
        $di->setter['Aura\Blog\Html\Helper\Pagination']['setRouter'] = $di->lazyGet('aura/web-kernel:router');
        $di->params['Aura\Html\HelperLocator']['map']['pagination'] = $di->lazyNew('Aura\Blog\Html\Helper\Pagination');

        $di->params['Aura\Blog\Html\Helper\Router']['router'] = $di->lazyGet('aura/web-kernel:router');
        $di->params['Aura\Html\HelperLocator']['map']['router'] = $di->lazyNew('Aura\Blog\Html\Helper\Router');

        $di->params['Aura\Html\HelperLocator']['map']['inputErrors'] = $di->lazyNew('Aura\Blog\Html\Helper\InputErrors');
        $di->setter['Aura\Blog\Html\Helper\InputErrors']['setUl'] = $di->lazyNew('Aura\Html\Helper\Ul');
        $di->set('aura/blog:web_responder_blog_add', $di->lazyNew('Aura\Blog\Web\Responder\BlogAddResponder'));
        $di->set('aura/blog:web_responder_blog_browse', $di->lazyNew('Aura\Blog\Web\Responder\BlogBrowseResponder'));
        $di->set('aura/blog:web_responder_blog_create', $di->lazyNew('Aura\Blog\Web\Responder\BlogCreateResponder'));
        $di->set('aura/blog:web_responder_blog_delete', $di->lazyNew('Aura\Blog\Web\Responder\BlogDeleteResponder'));
        $di->set('aura/blog:web_responder_blog_edit', $di->lazyNew('Aura\Blog\Web\Responder\BlogEditResponder'));
        $di->set('aura/blog:web_responder_blog_read', $di->lazyNew('Aura\Blog\Web\Responder\BlogReadResponder'));
        $di->set('aura/blog:web_responder_blog_update', $di->lazyNew('Aura\Blog\Web\Responder\BlogUpdateResponder'));
        $di->set('aura/blog:input_blog_form', $di->lazyNew('Aura\Blog\Input\BlogForm'));

        $di->params['Aura\View\TemplateRegistry']['map']['sidebar'] = dirname(__DIR__) . '/src/Web/Responder/layouts/sidebar.php';

        $di->params['FOA\Responder_Bundle\Renderer\AuraView']['engine'] = $di->lazyNew('Aura\View\View');
        // responder
        $di->params['FOA\Responder_Bundle\AbstractResponder']['response'] = $di->lazyGet('aura/web-kernel:response');
        $di->params['FOA\Responder_Bundle\AbstractResponder']['renderer'] = $di->lazyNew('FOA\Responder_Bundle\Renderer\AuraView');
        $di->params['FOA\Responder_Bundle\AbstractResponder']['accept'] = $di->lazyNew('Aura\Accept\Accept');
    }

    public function modify(Container $di)
    {
        $this->modifyRouter($di);
        $this->modifyDispatcher($di);
    }

    public function modifyRouter(Container $di)
    {
        $router = $di->get('aura/web-kernel:router');

        $router->add('aura.blog.browse', '/blog{/page}')
            ->setValues(array(
                'action' => 'aura.blog.browse',
                'page' => 1
            ))
            ->addTokens(array(
                'page'  => '\d+',
            ));

        $router->add('aura.blog.read', '/blog/read/{id}')
            ->addTokens(array(
                'id' => '\d+',
            ))
            ->addServer(array(
                'REQUEST_METHOD' => 'GET',
            ))
            ->setValues(array('action' => 'aura.blog.read'));

        $router->add('aura.blog.add', '/blog/add')
            ->addServer(array(
                'REQUEST_METHOD' => 'GET',
            ))
            ->setValues(array('action' => 'aura.blog.add'));

        $router->add('aura.blog.create', '/blog/add')
            ->addServer(array(
                'REQUEST_METHOD' => 'POST',
            ))
            ->setValues(array('action' => 'aura.blog.create'));

        $router->add('aura.blog.delete', '/blog/delete/{id}')
            ->addTokens(array(
                'id' => '\d+',
            ))
            ->addServer(array(
                'REQUEST_METHOD' => 'GET',
            ))
            ->setValues(array('action' => 'aura.blog.delete'));

        $router->add('aura.blog.edit', '/blog/edit/{id}')
            ->addTokens(array(
                'id' => '\d+',
            ))
            ->addServer(array(
                'REQUEST_METHOD' => 'GET',
            ))
            ->setValues(array('action' => 'aura.blog.edit'));

        $router->add('aura.blog.update', '/blog/edit/{id}')
            ->addTokens(array(
                'id' => '\d+',
            ))
            ->addServer(array(
                'REQUEST_METHOD' => 'POST',
            ))
            ->setValues(array('action' => 'aura.blog.update'));
    }

    public function modifyDispatcher(Container $di)
    {
        $dispatcher = $di->get('aura/web-kernel:dispatcher');

        $dispatcher->setObject(
            'aura.blog.browse',
            $di->lazyNew('Aura\Blog\Web\Action\BlogBrowseAction')
        );

        $dispatcher->setObject(
            'aura.blog.read',
            $di->lazyNew('Aura\Blog\Web\Action\BlogReadAction')
        );

        $dispatcher->setObject(
            'aura.blog.add',
            $di->lazyNew('Aura\Blog\Web\Action\BlogAddAction')
        );

        $dispatcher->setObject(
            'aura.blog.create',
            $di->lazyNew('Aura\Blog\Web\Action\BlogCreateAction')
        );

        $dispatcher->setObject(
            'aura.blog.delete',
            $di->lazyNew('Aura\Blog\Web\Action\BlogDeleteAction')
        );

        $dispatcher->setObject(
            'aura.blog.edit',
            $di->lazyNew('Aura\Blog\Web\Action\BlogEditAction')
        );

        $dispatcher->setObject(
            'aura.blog.update',
            $di->lazyNew('Aura\Blog\Web\Action\BlogUpdateAction')
        );
    }
}
