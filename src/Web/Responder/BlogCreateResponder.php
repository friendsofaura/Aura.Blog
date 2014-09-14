<?php
namespace Aura\Blog\Web\Responder;

use Aura\Blog\Web\AbstractResponder;

class BlogCreateResponder extends AbstractBlogResponder
{
    protected $result_method = array(
        'Aura\Blog\Domain\Result\Created' => 'created',
        'Aura\Blog\Domain\Result\NotCreated' => 'notCreated',
        'Aura\Blog\Domain\Result\NotValid' => 'notValid',
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
