<?php $this->title()->set('Edit Blog Post'); ?>
<h3>Edit Blog Post</h3>

<?= $this->render(
    '_form',
    array(
        'method' => 'POST',
        'action' => '/blog/edit/' . $this->blog->id,
        'submit' => 'Update',
        'blog' => $this->blog,
        'blog_form' => $this->blog_form,
    )
); ?>
