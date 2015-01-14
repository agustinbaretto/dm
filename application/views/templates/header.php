
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

    <title>Gustame - The Facebook & Freebase based Collaborative Filter</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
		<style type="text/css">
	    #mynetwork {
	      width: 100%;
	      height: 500px;
	      border: 1px solid lightgray;
	    }
	  </style>

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
  </head>

  <body>

    <!-- Static navbar -->
    <div class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url('matcher/friends') ?>">Gustame</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('matcher/friends') ?>">Friends</a></li>
            <li><a href="<?php echo site_url('matcher/graph/books') ?>">Graph</a></li>
            <li><a href="<?php echo site_url('main/contact') ?>">Contact</a></li>
            <li><a href="<?php echo site_url('main/logout') ?>">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>