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
        $di->params['Aura\Blog\Web\Action\BlogBrowseAction']['responder'] = $di->lazyNew('Aura\Blog\Web\Responder\BlogBrowseResponder');

        $di->params['Aura\Blog\Web\Action\BlogReadAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogReadAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogReadAction']['responder'] = $di->lazyNew('Aura\Blog\Web\Responder\BlogReadResponder');

        $di->params['Aura\Blog\Web\Action\BlogAddAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogAddAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogAddAction']['responder'] = $di->lazyNew('Aura\Blog\Web\Responder\BlogAddResponder');

        $di->params['Aura\Blog\Web\Action\BlogCreateAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogCreateAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogCreateAction']['responder'] = $di->lazyNew('Aura\Blog\Web\Responder\BlogCreateResponder');

        $di->params['Aura\Blog\Web\Action\BlogEditAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogEditAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogEditAction']['responder'] = $di->lazyNew('Aura\Blog\Web\Responder\BlogEditResponder');

        $di->params['Aura\Blog\Web\Action\BlogUpdateAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogUpdateAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogUpdateAction']['responder'] = $di->lazyNew('Aura\Blog\Web\Responder\BlogUpdateResponder');

        $di->params['Aura\Blog\Web\Action\BlogDeleteAction']['request'] = $di->lazyGet('aura/web-kernel:request');
        $di->params['Aura\Blog\Web\Action\BlogDeleteAction']['domain'] = $di->lazyNew('Aura\Blog\Domain\BlogService');
        $di->params['Aura\Blog\Web\Action\BlogDeleteAction']['responder'] = $di->lazyNew('Aura\Blog\Web\Responder\BlogDeleteResponder');

        $di->params['Aura\Blog\Domain\BlogGateway']['pdo'] = $di->lazyNew('Aura\Sql\ExtendedPdo');
        $di->params['Aura\Blog\Domain\BlogGateway']['factory'] = $di->lazyNew('Aura\Blog\Domain\BlogFactory');

        $di->params['Aura\Blog\Domain\BlogService']['gateway'] = $di->lazyNew('Aura\Blog\Domain\BlogGateway');
        $di->params['Aura\Blog\Domain\BlogService']['factory'] = $di->lazyNew('Aura\Blog\Domain\BlogFactory');
        $di->params['Aura\Blog\Domain\BlogService']['result'] = $di->lazyNew('Aura\Blog\Domain\Result\ResultFactory');
        $di->params['Aura\Blog\Domain\BlogService']['form'] = $di->lazyNew('Aura\Blog\Input\BlogForm');

        $di->setter['Aura\Blog\Html\Helper\Pagination']['setUl'] = $di->lazyNew('Aura\Html\Helper\Ul');
        $di->setter['Aura\Blog\Html\Helper\Pagination']['setAnchor'] = $di->lazyNew('Aura\Html\Helper\Anchor');
        $di->setter['Aura\Blog\Html\Helper\Pagination']['setRouter'] = $di->lazyGet('aura/web-kernel:router');
        $di->params['Aura\Html\HelperLocator']['map']['pagination'] = $di->lazyNew('Aura\Blog\Html\Helper\Pagination');

        $di->params['Aura\Blog\Html\Helper\Router']['router'] = $di->lazyGet('aura/web-kernel:router');
        $di->params['Aura\Html\HelperLocator']['map']['router'] = $di->lazyNew('Aura\Blog\Html\Helper\Router');

        $di->params['Aura\Html\HelperLocator']['map']['inputErrors'] = $di->lazyNew('Aura\Blog\Html\Helper\InputErrors');
        $di->setter['Aura\Blog\Html\Helper\InputErrors']['setUl'] = $di->lazyNew('Aura\Html\Helper\Ul');
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

        $router->add('aura.login', '/login')
            ->setValues([
                'action' => 'aura.login.get',
            ])
            ->addServer(array(
                'REQUEST_METHOD' => 'GET',
            ));
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

/*
    public function defineConnection(Container $di)
    {
        $di->params['Aura\Sql\ExtendedPdo'] = array(
            'dsn' => 'mysql:dbname=auraauth;host=127.0.0.1',
            'username' => 'root',
            'password' => 'mysqlroot'
        );
        $di->set('connection', $di->lazyNew('Aura\Sql\ExtendedPdo'));
    }
*/
}
