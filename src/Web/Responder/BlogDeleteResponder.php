<?php
namespace Aura\Blog\Web\Responder;

use Aura\Blog\Web\AbstractResponder;

class BlogDeleteResponder extends AbstractBlogResponder
{
    protected $result_method = array(
        'Aura\Blog\Domain\Result\NotFound' => 'notFound',
        'Aura\Blog\Domain\Result\Deleted' => 'deleted',
        'Aura\Blog\Domain\Result\NotDeleted' => 'notDeleted',
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
