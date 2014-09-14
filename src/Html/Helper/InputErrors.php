<?php
namespace Aura\Blog\Html\Helper;

use Aura\Html\Helper\AbstractHelper;
use Aura\Html\Helper\Ul;
use Aura\Input\Form;

class InputErrors extends AbstractHelper
{
    public function setUl(Ul $ul)
    {
        $this->ul = $ul;
    }

    public function __invoke(Form $form, $field, $attr = null)
    {
        $errors = $form->getMessages($field);
        return $this->ul->__invoke($attr)->items($errors)->__toString();
    }
}
