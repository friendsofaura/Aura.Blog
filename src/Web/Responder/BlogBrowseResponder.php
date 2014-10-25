<?php
namespace Aura\Blog\Web\Responder;

use FOA\Responder_Bundle\AbstractResponder;

class BlogBrowseResponder extends AbstractBlogResponder
{
    protected $available = array(
        'text/html' => '',
        'application/json' => '.json'
    );

    protected $payload_method = array(
        'FOA\DomainPayload\Found' => 'found',
        'FOA\DomainPayload\NotFound' => 'notFound',
    );

    protected function found()
    {
        if ($this->negotiateMediaType()) {
            $this->renderView('browse', 'default');
        }
    }
}
