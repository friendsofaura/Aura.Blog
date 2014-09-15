<?php
namespace Aura\Blog\Web\Action;
use Aura\Project_Kernel\Factory;
use Aura\Blog\Domain\BlogService;
use Aura\Blog\Domain\BlogGateway;
use Aura\Blog\Domain\BlogFactory;
use Aura\Blog\Domain\Result\ResultFactory;

class BlogBrowseActionTest extends \PHPUnit_Framework_TestCase
{
    protected $action;

    protected $pdo;

    public function setUp()
    {
        $path = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
        $di = (new Factory)->newContainer(
            $path,
            '',
            "$path/composer.json",
            "$path/vendor/composer/installed.json"
        );
        $responder = $di->get('aura/blog:web_responder_blog_browse');
        $this->pdo = $this->getMock(
            'Aura\Sql\ExtendedPdo',
            array('fetchAll'),
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

        $request = $di->get('aura/web-kernel:request');

        $this->action = new BlogBrowseAction(
            $request,
            $domain,
            $responder
        );
    }

    public function test__Invoke()
    {
        $result = array(
            array(
                'id' => 1,
                'title' => 'Hello World',
                'body' => 'Hello World Body',
                'intro' => 'Hello World intro',
                'author' => 'Hari KT'
            ),
            array(
                'id' => 2,
                'title' => 'Hello second world',
                'body' => 'Hello second world Body',
                'intro' => 'Hello second world intro',
                'author' => 'Paul M Jones'
            )
        );
        $this->pdo->expects($this->once())
                ->method('fetchAll')
                ->will($this->returnValue($result));

        $responder = $this->action->__invoke();
        $this->assertInstanceOf('Aura\Blog\Web\Responder\BlogBrowseResponder', $responder);
    }
}
