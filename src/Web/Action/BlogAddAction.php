<?php
namespace Aura\Blog\Web\Action;

use Aura\Blog\Domain\BlogService;
use Aura\Blog\Web\Responder\BlogAddResponder;

class BlogAddAction
{
    protected $domain;
    protected $responder;

    public function __construct(
        BlogService $domain,
        BlogAddResponder $responder
    ) {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $this->responder->setResult($this->domain->newPost(array()));
        return $this->responder;
    }
}
