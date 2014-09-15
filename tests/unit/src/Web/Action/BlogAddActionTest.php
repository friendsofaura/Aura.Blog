<?php
namespace Aura\Blog\Web\Action;
use Aura\Project_Kernel\Factory;
use Aura\Blog\Domain\BlogService;
use Aura\Blog\Domain\BlogGateway;
use Aura\Blog\Domain\BlogFactory;
use Aura\Blog\Domain\Result\ResultFactory;
use Aura\Blog\Responder\BlogAddResponder;

class BlogAddActionTest extends \PHPUnit_Framework_TestCase
{
    protected $action;

    public function setUp()
    {
        $path = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
        $di = (new Factory)->newContainer(
            $path,
            '',
            "$path/composer.json",
            "$path/vendor/composer/installed.json"
        );
        $responder = $di->get('aura/blog:web_responder_blog_add');
        $mock_pdo = $this->getMock(
            'Aura\Sql\ExtendedPdo',
            null,
            array(
                'dsn',
            )
        );

        $blog_gateway = new BlogGateway($mock_pdo);
        $blog_factory = new BlogFactory();
        $blog_form = $di->get('aura/blog:input_blog_form');
        $result_factory = new ResultFactory();
        $domain = new BlogService(
            $blog_gateway,
            $blog_factory,
            $blog_form,
            $result_factory
        );

        $this->action = new BlogAddAction(
            $domain,
            $responder
        );
    }

    public function test__Invoke()
    {
        $actual = $this->action->__invoke();
        $this->assertInstanceOf('Aura\Blog\Web\Responder\BlogAddResponder', $actual);
    }
}
