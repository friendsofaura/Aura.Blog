<?php
namespace Aura\Blog\Web\Responder;

use FOA\Responder_Bundle\AbstractResponder;

class BlogUpdateResponder extends AbstractBlogResponder
{
    protected $payload_method = array(
        'FOA\DomainPayload\NotFound' => 'notFound',
        'FOA\DomainPayload\NotValid' => 'notValid',
        'FOA\DomainPayload\Updated' => 'updated',
        'FOA\DomainPayload\NotUpdated' => 'notUpdated',
    );

    protected function notValid()
    {
        $this->response->status->set('422');
        return $this->renderView('edit', 'default');
    }

    protected function updated()
    {
        return $this->renderView('edit', 'default');
    }

    protected function notUpdated()
    {
        $this->response->status->set('500');
        return $this->renderView('edit', 'default');
    }
}
