<?php
$this->title()->set('Browse post');
foreach ($this->collection as $blog) {
    echo $this->render('_intro', array('blog' => $blog));
} ?>
<?php echo $this->pagination('aura.blog.browse', array(), $this->total, $this->page, 10, 1, array('class' => 'pagination')); ?>
