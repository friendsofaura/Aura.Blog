<?php
namespace Aura\Blog\Web\Action;

use Aura\Web\Request;
use Aura\Blog\Domain\BlogService;
use Aura\Blog\Web\Responder\BlogReadResponder;

class BlogReadAction
{
    protected $request;
    protected $domain;
    protected $responder;

    public function __construct(
        Request $request,
        BlogService $domain,
        BlogReadResponder $responder
    ) {
        $this->request = $request;
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function __invoke($id)
    {
        $result = $this->domain->fetchPost($id);
        $this->responder->setResult($result);
        $this->responder->setAccept($this->request->accept);
        return $this->responder->__invoke();
    }
}
