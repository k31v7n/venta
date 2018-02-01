<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="<?= base_url('public/bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/bootstrap/css/bootstrap.min.css') ?>">
	<!--<link rel="stylesheet" href="<?php //echo base_url('public/confirm/css/jquery-confirm.css')?>">-->
	<link rel="stylesheet" href="<?= base_url('public/confirm/jquery-confirm.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('public/css/estilo.css') ?>">

	<script src="<?= base_url('public/js/jquery.js') ?>"></script>
	<script src="<?= base_url('public/js/jquery-ui.js') ?>"></script>
	<script src="<?= base_url('public/bootstrap/js/bootstrap.min.js') ?>"></script>
	<!--<script src="<?php //echo base_url('public/confirm/js/jquery-confirm.js')?>"></script>-->
	<script src="<?= base_url('public/confirm/jquery-confirm.min.js')?>"></script>
	<script src="<?= base_url('public/js/notify.js')?>"></script>
	<script src="<?= base_url('public/js/conf.js')?>"></script>

	<?php
	  if (isset($scripts)) {
	    foreach ($scripts as $src) {
	      if ( is_object($src) ) {
	        echo link_script($src->ruta, $src->print);
	      } else {
	        echo link_script($src);
	      }
	    }
	  }
	?>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta charset="UTF-8">
	<title>Ventas Arnol</title>
</head>
<body id="ver">
	<?php if (isset($menu)): ?>
		<?php $this->load->view($menu); ?>
	<?php endif ?>

	<?php if (isset($vista)): ?>
		<?php $this->load->view($vista); ?>
	<?php endif ?>
</body>
</html>