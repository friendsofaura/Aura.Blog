<?php
namespace Aura\Blog\Web\Action;

use Aura\Web\Request;
use Aura\Blog\Domain\BlogService;
use Aura\Blog\Web\Responder\BlogDeleteResponder;

class BlogDeleteAction
{
    protected $request;
    protected $domain;
    protected $responder;

    public function __construct(
        Request $request,
        BlogService $domain,
        BlogDeleteResponder $responder
    ) {
        $this->request = $request;
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function __invoke($id)
    {
        $result = $this->domain->delete($id);
        $this->responder->setPayload($result);
        return $this->responder;
    }
}
