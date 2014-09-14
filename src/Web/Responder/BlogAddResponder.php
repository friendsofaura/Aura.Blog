<?php
namespace Aura\Blog\Web\Responder;

use Aura\Blog\Web\AbstractResponder;

class BlogAddResponder extends AbstractBlogResponder
{
    protected $result_method = array(
        'Aura\Blog\Domain\Result\NewEntity' => 'display',
    );

    protected function display()
    {
        $this->renderView('add', 'default');
    }
}
