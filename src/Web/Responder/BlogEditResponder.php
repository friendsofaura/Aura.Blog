<?php
namespace Aura\Blog\Web\Responder;

use FOA\Responder_Bundle\AbstractResponder;

class BlogEditResponder extends AbstractBlogResponder
{
    protected $result_method = array(
        'FOA\DomainPayload\Found' => 'found',
        'FOA\DomainPayload\NotFound' => 'notFound',
    );

    public function found()
    {
        return $this->renderView('edit', 'default');
    }
}
