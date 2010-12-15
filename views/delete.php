<?php
$tmpl->set('title', 'Delete Meetup');
$tmpl->place('header');
?>

<h1><?php echo $tmpl->prepare('title') ?></h1>

<p class="nav">
	<a href="<?php echo Meetup::makeURL('list') ?>">List all meetups</a> |
	<a class="related" href="<?php echo Meetup::makeURL('edit', $meetup) ?>">Edit this meetup</a>
</p>

<?php
fMessaging::show('error', fURL::get());
?>

<form action="<?php echo fURL::get() ?>" method="post">
	
	<p class="warning">
		Are you sure you want to delete the meetup on
		<strong><?php echo $meetup->prepareDate('F j, Y') ?></strong> at
		<strong><?php echo $meetup->prepareVenue() ?></strong>
		in <strong><?php echo $meetup->prepareCity() ?>, <?php echo $meetup->prepareState() ?></strong>?
	</p>
	
	<p>
		<input class="delete" type="submit" value="Yes, delete this meetup" />
		<a href="<?php echo Meetup::makeURL('list') ?>">No, please keep it</a>
		<input type="hidden" name="token" value="<?php echo fRequest::generateCSRFToken() ?>" />
	</p>
	
</form>

<?php
$tmpl->place('footer');