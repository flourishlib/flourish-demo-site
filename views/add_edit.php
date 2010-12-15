<?php
$tmpl->set('title', $action == 'add' ? 'Add a Meetup' : 'Edit Meetup');
$tmpl->place('header');
?>

<h1><?php echo $tmpl->prepare('title') ?></h1>

<p class="nav">
	<a href="<?php echo Meetup::makeURL('list') ?>">List all meetups</a>
	<?php
	if ($action == 'edit') {
		?>
		| <a class="related" href="<?php echo Meetup::makeURL('delete', $meetup) ?>">Delete this meetup</a>	
		<?php
	}
	?>
</p>

<?php
fMessaging::show('error', fURL::get());
fMessaging::show('success', fURL::get());
?>

<form action="<?php echo fURL::get() ?>" method="post">
	
	<fieldset>
		
		<p class="combo first">
			<label for="meetup-date">Date<em>*</em></label>
			<input id="meetup-date" class="date" type="text" name="date" value="<?php echo $meetup->encodeDate('Y-m-d') ?>" />
			<input type="hidden" name="old_date" value="<?php echo fHTML::encode(fRequest::get('old_date', 'string', $meetup->encodeDate('Y-m-d'))) ?>" />
		</p>
		<p class="combo">
			<label for="meetup-start_time">Start Time<em>*</em></label>
			<input id="meetup-start_time" class="time" type="text" name="start_time" value="<?php echo $meetup->encodeStartTime('g:i a') ?>" />
		</p>
		<p class="combo">
			<label for="meetup-end_time">End Time<em>*</em></label>
			<input id="meetup-end_time" class="time" type="text" name="end_time" value="<?php echo $meetup->encodeEndTime('g:i a') ?>" />
		</p>
		
		<p class="combo first">
			<label for="meetup-venue">Venue<em>*</em></label>
			<input id="meetup-venue" class="name" type="text" name="venue" value="<?php echo $meetup->encodeVenue() ?>" maxlength="<?php echo $meetup->inspectVenue('max_length') ?>" />
		</p>
		<p class="combo">
			<label for="meetup-venue_website">Venue Website</label>
			<input id="meetup-venue_website" class="website" type="text" name="venue_website" value="<?php echo $meetup->encodeVenueWebsite() ?>" maxlength="<?php echo $meetup->inspectVenueWebsite('max_length') ?>" />
		</p>
		
		<p class="combo first">
			<label for="meetup-city">City<em>*</em></label>
			<input id="meetup-city" class="city" type="text" name="city" value="<?php echo $meetup->encodeCity() ?>" maxlength="<?php echo $meetup->inspectCity('max_length') ?>" />
		</p>
		<p class="combo">
			<label for="meetup-state">State<em>*</em></label>
			<input id="meetup-state" class="state" type="text" name="state" value="<?php echo $meetup->encodeState() ?>" maxlength="<?php echo $meetup->inspectState('max_length') ?>" />
		</p>
		
		<p>
			<label for="meetup-description">Description</label>
			<textarea id="meetup-description" class="description" name="description" rows="5" cols="40"><?php echo $meetup->encodeDescription() ?></textarea>
		</p>
		
		<p>
			<label for="meetup-yahoo_upcoming_url">Yahoo Upcoming URL</label>
			<input id="meetup-yahoo_upcoming_url" class="website" type="text" name="yahoo_upcoming_url" value="<?php echo $meetup->encodeYahooUpcomingUrl() ?>" maxlength="<?php echo $meetup->inspectYahooUpcomingUrl('max_length') ?>" />
		</p>
		<p>
			<label for="meetup-google_maps_html">Google Maps HTML</label>
			<textarea id="meetup-google_maps_html" class="html" name="google_maps_html" rows="5" cols="40"><?php echo $meetup->encodeGoogleMapsHtml() ?></textarea>
		</p>
	</fieldset>
	
	<p>
		<input type="submit" value="Save Meetup" />
		<span class="required"><em>*</em> Required field</span>
		<input type="hidden" name="token" value="<?php echo fRequest::generateCSRFToken() ?>" />
	</p>
	
</form>

<?php
$tmpl->place('footer');