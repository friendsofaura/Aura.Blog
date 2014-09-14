<?php // = $this->ul()->items($this->blog->getMessages()) ?>

<?= $this->form(array(
    'method' => $method,
    'action' => $action,
)); ?>
    <table>
        <tr>
            <td>Title</td>
            <td><?=
                $this->input($blog_form->get('title'));
                echo $this->inputErrors($blog_form, 'title');
            ?></td>
        </tr>
        <tr>
            <td>Intro</td>
            <td><?=
                $this->input($blog_form->get('intro'));
                echo $this->inputErrors($blog_form, 'intro');
            ?></td>
        </tr>
        <tr>
            <td>Body</td>
            <td><?=
                $this->input($blog_form->get('body'));
                echo $this->inputErrors($blog_form, 'body');
            ?></td>
        </tr>
        <tr>
            <td>Author</td>
            <td><?=
                $this->input($blog_form->get('author'));
                echo $this->inputErrors($blog_form, 'author');
            ?></td>
        </tr>
        <tr>
            <td colspan="2"><?=
                $this->input(array(
                    'type' => 'submit',
                    'name' => 'submit',
                    'value' => $submit,
                ));
            ?></td>
        </tr>
    </table>
<?= $this->tag('/form') ?>
<p><?= $this->a("/blog", 'Back'); ?></p>
