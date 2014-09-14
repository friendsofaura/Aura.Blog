<?php $this->title()->set('Add post'); ?>
<h3>Add New Blog Post</h3>

<?= $this->render(
    '_form',
    array(
        'method' => 'POST',
        'action' => '/blog/add',
        'submit' => 'Create',
        'blog' => $this->blog,
        'blog_form' => $this->blog_form,
    )
); ?>
