<?php use Aura\Html\Escaper as e; ?>

<div class="blog-intro">
    <h2><?= e::h($blog->title) ?></h2>
    <p class="byline"><?= e::h($blog->author) ?></p>
    <?= e::h($blog->intro) ?>
    <p><?= $this->a("/blog/read/{$blog->id}", 'Read More ...'); ?> | <?= $this->a("/blog/edit/{$blog->id}", 'Edit'); ?> | <?= $this->a("/blog/delete/{$blog->id}", 'Delete'); ?></p>
</div>
