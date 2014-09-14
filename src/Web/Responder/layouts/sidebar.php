<div class="sidebar">
  <div class="container sidebar-sticky">
    <div class="sidebar-about">
      <h2>
        Aura.Blog
      </h2>
      <p class="lead">Aura blog example using ADR.</p>
    </div>

    <nav class="sidebar-nav">
      <a class="sidebar-nav-item" href="<?php echo $this->router()->generate('aura.blog.browse'); ?>">Blog</a>
      <a class="sidebar-nav-item" href="<?php echo $this->router()->generate('aura.blog.add'); ?>">Add Post</a>
      <a class="sidebar-nav-item" href="https://github.com/auraphp">GitHub project</a>
      <span class="sidebar-nav-item">Currently 2.0.x-dev</span>
    </nav>

    <p>&copy; <?php echo date('Y'); ?>. All rights reserved.</p>
  </div>
</div>
