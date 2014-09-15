<?php
namespace Aura\Blog\Web\Action;

use Aura\Web\Request;
use Aura\Blog\Domain\BlogService;
use Aura\Blog\Web\Responder\BlogCreateResponder;

class BlogCreateAction
{
    protected $request;
    protected $domain;
    protected $responder;

    public function __construct(
        Request $request,
        BlogService $domain,
        BlogCreateResponder $responder
    ) {
        $this->request = $request;
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $data = $this->request->post->get('blog');
        $result = $this->domain->create($data);
        $this->responder->setResult($result);
        return $this->responder;
    }
}
