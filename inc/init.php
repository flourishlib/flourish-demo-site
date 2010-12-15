<?php
include dirname(__FILE__) . '/config.php';

$tmpl = new fTemplating(DOC_ROOT . '/views/');
$tmpl->set('header', 'header.php');
$tmpl->set('footer', 'footer.php');

$db = new fDatabase('sqlite', DOC_ROOT . '/storage/db/northshorewebgeeks.db');
fORMDatabase::attach($db);

fSession::open();