<?php
namespace Aura\Blog\Input;

use Aura\Input\Form;

class BlogForm extends Form
{
    public function init()
    {
        $this->setField('author')
            ->setAttribs([
                'id' => 'name',
                'size' => 40,
                'maxlength' => 40,
                'name' => 'blog[author]',
            ]);
        $this->setField('title')
            ->setAttribs([
                'size' => 50,
                'maxlength' => 50,
                'name' => 'blog[title]',
            ]);

        $this->setField('intro', 'textarea')
            ->setAttribs([
                'cols' => 85,
                'rows' => 20,
                'name' => 'blog[intro]',
            ]);

        $this->setField('body', 'textarea')
            ->setAttribs([
                'cols' => 85,
                'rows' => 20,
                'name' => 'blog[body]',
            ]);

        $filter = $this->getFilter();

        $filter->addSoftRule('author', $filter::IS, 'string');
        $filter->addSoftRule('author', $filter::IS, 'strlenMin', 4);
        $filter->addSoftRule('title', $filter::IS, 'strlenMin', 6);
        $filter->addSoftRule('intro', $filter::IS, 'string');
        $filter->addSoftRule('intro', $filter::IS, 'strlenMin', 6);
        $filter->addSoftRule('body', $filter::IS, 'string');
        $filter->addSoftRule('body', $filter::IS, 'strlenMin', 6);
    }
}
