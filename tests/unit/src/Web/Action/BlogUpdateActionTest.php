<?php
namespace Aura\Blog\Web\Action;
use Aura\Project_Kernel\Factory;
use Aura\Blog\Domain\BlogService;
use Aura\Blog\Domain\BlogGateway;
use Aura\Blog\Domain\BlogFactory;
use Aura\Blog\Domain\Result\ResultFactory;

class BlogUpdateActionTest extends \PHPUnit_Framework_TestCase
{
    protected $action;

    protected $pdo;

    public function setUp()
    {
        $_POST['blog'] = array(
            'id' => 1,
            'title' => 'Hello World',
            'body' => 'Hello World Body',
            'intro' => 'Hello World intro',
            'author' => 'Hari KT'
        );
        $path = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
        $di = (new Factory)->newContainer(
            $path,
            '',
            "$path/composer.json",
            "$path/vendor/composer/installed.json"
        );
        $responder = $di->get('aura/blog:web_responder_blog_update');
        $request = $di->get('aura/web-kernel:request');
        $this->pdo = $this->getMock(
            'Aura\Sql\ExtendedPdo',
            array('perform', 'fetchOne'),
            array(
                'dsn',
            )
        );

        $blog_gateway = new BlogGateway($this->pdo);
        $blog_factory = new BlogFactory();
        $blog_form = $di->get('aura/blog:input_blog_form');
        $result_factory = new ResultFactory();
        $domain = new BlogService(
            $blog_gateway,
            $blog_factory,
            $blog_form,
            $result_factory
        );

        $this->action = new BlogUpdateAction(
            $request,
            $domain,
            $responder
        );
    }

    public function test__Invoke()
    {
        $row = array(
            'id' => 1,
            'title' => 'Hello World',
            'body' => 'Hello World Body',
            'intro' => 'Hello World intro',
            'author' => 'Hari KT'
        );

        $this->pdo->expects($this->once())
                ->method('fetchOne')
                ->will($this->returnValue($row));

        $this->pdo->expects($this->once())
                ->method('perform')
                ->will($this->returnValue(true));

        $actual = $this->action->__invoke(1);
        $this->assertInstanceOf('Aura\Blog\Web\Responder\BlogUpdateResponder', $actual);
    }
}
