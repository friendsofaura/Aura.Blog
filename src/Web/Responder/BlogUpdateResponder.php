<?php
namespace Aura\Blog\Web\Responder;

use Aura\Blog\Web\AbstractResponder;

class BlogUpdateResponder extends AbstractBlogResponder
{
    protected $result_method = array(
        'Aura\Blog\Domain\Result\NotFound' => 'notFound',
        'Aura\Blog\Domain\Result\NotValid' => 'notValid',
        'Aura\Blog\Domain\Result\Updated' => 'updated',
        'Aura\Blog\Domain\Result\NotUpdated' => 'notUpdated',
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
