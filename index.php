<?php
include './inc/init.php';

$type    = fRequest::get('type');
$meetups = Meetup::findCurrent();

if ('html' == $type) {
	include './views/index.php';
}
if ('rss' == $type) {
	include './views/rss.php';	
}