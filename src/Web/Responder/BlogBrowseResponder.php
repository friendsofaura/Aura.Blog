<?php
namespace Aura\Blog\Web\Responder;

use Aura\Blog\Web\AbstractResponder;

class BlogBrowseResponder extends AbstractBlogResponder
{
    protected $available = array(
        'text/html' => '',
        'application/json' => '.json'
    );

    protected $result_method = array(
        'Aura\Blog\Domain\Result\Found' => 'found',
        'Aura\Blog\Domain\Result\NotFound' => 'notFound',
    );

    protected function found()
    {
        if ($this->negotiateMediaType()) {
            $this->renderView('browse', 'default');
        }
    }
}
