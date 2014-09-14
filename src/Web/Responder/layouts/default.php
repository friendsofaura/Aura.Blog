<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-us">
  <head>
    <link href="http://gmpg.org/xfn/11" rel="profile">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <!-- Enable responsiveness on mobile devices-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

    <?php echo $this->title(); ?>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo $this->router()
      ->generateRaw('aura.asset',
          array(
              'vendor' => 'aura',
              'package' => 'blog',
              'file' => '/css/poole.css'
          )
      ); ?>">
    <link rel="stylesheet" href="<?php echo $this->router()
      ->generateRaw('aura.asset',
          array(
              'vendor' => 'aura',
              'package' => 'blog',
              'file' => '/css/syntax.css'
          )
      ); ?>">
    <link rel="stylesheet" href="<?php echo $this->router()
      ->generateRaw('aura.asset',
          array(
              'vendor' => 'aura',
              'package' => 'blog',
              'file' => '/css/hyde.css'
          )
      ); ?>">
    <link rel="stylesheet" href="<?php echo $this->router()
      ->generateRaw('aura.asset',
          array(
              'vendor' => 'aura',
              'package' => 'blog',
              'file' => '/css/bootstrap.css'
          )
      ); ?>">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700|Abril+Fatface">

    <!-- Icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->router()
      ->generateRaw('aura.asset',
          array(
              'vendor' => 'aura',
              'package' => 'blog',
              'file' => '/apple-touch-icon-144-precomposed.png'
          )
      ); ?>">
    <link rel="shortcut icon" href="<?php echo $this->router()
      ->generateRaw('aura.asset',
          array(
              'vendor' => 'aura',
              'package' => 'blog',
              'file' => '/favicon.ico'
          )
      ); ?>">
  </head>
  <body>

    <?php
    if ($this->hasSection('sidebar')) {
        echo $this->getSection('sidebar');
    } else {
        echo $this->render('sidebar');
    }
    ?>
    <div class="content container">
       <?php echo $this->getContent(); ?>
    </div>

  </body>
</html>
