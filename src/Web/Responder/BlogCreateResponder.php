<?php
namespace Aura\Blog\Web\Responder;

use FOA\Responder_Bundle\AbstractResponder;

class BlogCreateResponder extends AbstractBlogResponder
{
    protected $result_method = array(
        'FOA\DomainPayload\Created' => 'created',
        'FOA\DomainPayload\NotCreated' => 'notCreated',
        'FOA\DomainPayload\NotValid' => 'notValid',
    );

    protected function created()
    {
        $blog = $this->result->get('blog');
        $this->response->redirect->afterPost("/blog/read/{$blog->id}");
    }

    protected function notValid()
    {
        $this->response->status->set('422');
        $this->renderView('add', 'default');
    }

    protected function notCreated()
    {
        $this->response->status->set('500');
        $this->renderView('add', 'default');
    }
}
