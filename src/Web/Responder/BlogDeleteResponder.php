<?php
namespace Aura\Blog\Web\Responder;

use FOA\Responder_Bundle\AbstractResponder;

class BlogDeleteResponder extends AbstractBlogResponder
{
    protected $result_method = array(
        'FOA\DomainPayload\NotFound' => 'notFound',
        'FOA\DomainPayload\Deleted' => 'deleted',
        'FOA\DomainPayload\NotDeleted' => 'notDeleted',
    );

    protected function deleted()
    {
        $this->renderView('delete-success', 'default');
    }

    protected function notDeleted()
    {
        $this->response->setStatus(500);
        $this->renderView('delete-failure', 'default');
    }
}
