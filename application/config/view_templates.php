<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['view_templates'] = array(
	'default' => array(
		'header' => 'templates/header',
		'footer' => 'templates/footer'
	),
	'admin' => array(
		'header' => 'templates/header_cms',
		'footer' => 'templates/footer_cms'
	),
         'ws' => array(
		'header' => 'templates/header_ws',
		'footer' => 'templates/footer_ws'
	),
	"none" => array()
);