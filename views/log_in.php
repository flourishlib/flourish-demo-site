<?php
$tmpl->set('title', 'Log In');
$tmpl->place('header');
?>

<h1>Log In</h1>

<?php
fMessaging::show('error', fURL::get());
fMessaging::show('success', fURL::get());
?>

<form action="<?php echo fURL::get() ?>" method="post">

	<fieldset>
		<p>
			<label for="username">Username</label>
			<input id="username" type="text" name="username" value="<?php echo fRequest::get('username') ?>" />
		</p>
		<p>
			<label for="password">Password</label>
			<input id="password" type="password" name="password" value="" />
		</p>
	</fieldset>

	<p>
		<input type="submit" value="Log In" />
	</p>

</form>

<?php $tmpl->place('footer') ?>