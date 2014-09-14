<?php
namespace Aura\Blog\Web\Action;

use Aura\Web\Request;
use Aura\Blog\Domain\BlogService;
use Aura\Blog\Web\Responder\BlogAddResponder;

class BlogAddAction
{
    protected $request;
    protected $domain;
    protected $responder;

    public function __construct(
        Request $request,
        BlogService $domain,
        BlogAddResponder $responder
    ) {
        $this->request = $request;
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $this->responder->setResult($this->domain->newPost(array()));
        return $this->responder->__invoke();
    }
}
