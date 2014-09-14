<?php
namespace Aura\Blog\Web\Responder;

use Aura\Blog\Web\AbstractResponder;

class BlogEditResponder extends AbstractBlogResponder
{
    protected $result_method = array(
        'Aura\Blog\Domain\Result\Found' => 'found',
        'Aura\Blog\Domain\Result\NotFound' => 'notFound',
    );

    public function found()
    {
        return $this->renderView('edit', 'default');
    }
}
