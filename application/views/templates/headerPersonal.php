
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/ico/favicon.png">
    <script type="text/javascript" src="<?php echo base_url();?>assets/node_modules/vis/dist/vis.js" ></script>
		<link href="<?php echo base_url();?>assets/node_modules/vis/dist/vis.css" rel="stylesheet" type="text/css" />

    <title>Agustin Baretto</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/main.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/hover.zoom.js"></script>
    <script src="<?php echo base_url();?>assets/js/hover.zoom.conf.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-58815408-1', 'auto');
		  ga('send', 'pageview');
		
		</script>
  </head>

  <body>
  

    <!-- Static navbar -->
    <div class="navbar navbar-inverse navbar-static-top navbar-landing">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url('personal') ?>">Agustin Baretto</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('personal') ?>">About Me</a></li>
            <li><a href="<?php echo site_url('personal/research') ?>">Research</a></li>
            <li><a href="<?php echo site_url('personal/byna') ?>">ByNA Project</a></li>
            <li><a target="_blank" href="www.demografies.com">Demografies</a></li>
            <li><a href="<?php echo site_url('personal/gustame') ?>">Gustame</a></li>
            <li><a href="<?php echo site_url('personal/blog') ?>">Blog</a></li>
            <li><a href="<?php echo site_url('personal/contact') ?>">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>