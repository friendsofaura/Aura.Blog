<?php
namespace Aura\Blog\Web\Action;

use Aura\Web\Request;
use Aura\Blog\Domain\BlogService;
use Aura\Blog\Web\Responder\BlogBrowseResponder;

class BlogBrowseAction
{
    protected $request;
    protected $domain;
    protected $responder;

    public function __construct(
        Request $request,
        BlogService $domain,
        BlogBrowseResponder $responder
    ) {
        $this->request = $request;
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $page = $this->request->params->get('page', 1);
        $paging = $this->request->query->get('paging', 10);
        $result = $this->domain->fetchPage($page, $paging);
        $this->responder->setResult($result);
        $this->responder->setAccept($this->request->accept);
        return $this->responder;
    }
}
