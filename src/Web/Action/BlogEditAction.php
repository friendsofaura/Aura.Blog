<?php
namespace Aura\Blog\Web\Action;

use Aura\Web\Request;
use Aura\Blog\Domain\BlogService;
use Aura\Blog\Web\Responder\BlogEditResponder;

class BlogEditAction
{
    protected $request;
    protected $domain;
    protected $responder;

    public function __construct(
        Request $request,
        BlogService $domain,
        BlogEditResponder $responder
    ) {
        $this->request = $request;
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function __invoke($id)
    {
        $result = $this->domain->fetchPost($id);
        $this->responder->setResult($result);
        return $this->responder->__invoke();
    }
}
