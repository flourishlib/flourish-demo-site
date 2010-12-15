<?php
include '../inc/init.php';
header('HTTP/1.0 404 Not Found');
$tmpl->set('title', 'Not Found');
$tmpl->place('header');
?>

<h1>Not Found</h1>

<p>
	We’re sorry, but the page you requested could not be found. You are probably
	looking for the <a href="">home page</a>.
</p>

<?php $tmpl->place('footer') ?>