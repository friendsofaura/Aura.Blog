<?php
namespace Aura\Blog\Web\Responder;

use FOA\Responder_Bundle\AbstractResponder;

class BlogAddResponder extends AbstractBlogResponder
{
    protected $result_method = array(
        'FOA\DomainPayload\NewEntity' => 'display',
    );

    protected function display()
    {
        $this->renderView('add', 'default');
    }
}
