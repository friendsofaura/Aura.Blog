<?php
namespace Aura\Blog\Web\Responder;

use FOA\Responder_Bundle\AbstractResponder;

class BlogReadResponder extends AbstractBlogResponder
{
    protected $available = array(
        'text/html' => '',
        'application/json' => '.json'
    );

    protected $result_method = array(
        'FOA\DomainPayload\Found' => 'found',
        'FOA\DomainPayload\NotFound' => 'notFound',
    );

    protected function found()
    {
        if ($this->negotiateMediaType()) {
            $this->renderView('read', 'default');
        }
    }

    protected function notFound()
    {
        $this->renderView('missing', 'notfound');
    }
}
