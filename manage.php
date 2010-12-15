<?php
include './inc/init.php';

fAuthorization::requireLoggedIn();

$action = fRequest::getValid(
	'action',
	array('list', 'add', 'edit', 'delete')
);

$date       = fRequest::get('date');
$old_date   = fRequest::get('old_date');
$manage_url = URL_ROOT . Meetup::makeURL('list');


// --------------------------------- //
if ('delete' == $action) {
	
	try {
		
		$meetup = new Meetup($date);
		
		if (fRequest::isPost()) {
		
			fRequest::validateCSRFToken(fRequest::get('token'));
			
			$meetup->delete();
			
			fMessaging::create('success', $manage_url, 'The meetup on ' . $meetup->getDate()->format('F j, Y') . ' was successfully deleted');
			fURL::redirect($manage_url);	
		
		}
	
	} catch (fNotFoundException $e) {
		fMessaging::create('error', $manage_url, 'The meetup requested, ' . fHTML::encode($date) . ', could not be found');
		fURL::redirect($manage_url);
	
	} catch (fExpectedException $e) {
		fMessaging::create('error', fURL::get(), $e->getMessage());	
	}

	include './views/delete.php';	
	
}


// --------------------------------- // 
if ('edit' == $action) {
	
	try {
		
		$meetup = new Meetup($old_date ? $old_date : $date);
		
		if (fRequest::isPost()) {
		
			$meetup->populate();
			
			fRequest::validateCSRFToken(fRequest::get('token'));
			
			$meetup->store();
			
			fMessaging::create('affected', $manage_url, $meetup->getDate()->__toString());
			fMessaging::create('success', $manage_url, 'The meetup on ' . $meetup->getDate()->format('F j, Y') . ' was successfully updated');
			fURL::redirect($manage_url);	
		
		}
	
	} catch (fNotFoundException $e) {
		fMessaging::create('error', $manage_url, 'The meetup requested, ' . fHTML::encode($date) . ', could not be found');	
		fURL::redirect($manage_url);
		
	} catch (fExpectedException $e) {
		fMessaging::create('error', fURL::get(), $e->getMessage());	
	}

	include './views/add_edit.php';
	
}


// --------------------------------- //
if ('add' == $action) {
	
	$meetup = new Meetup();
	
	if (fRequest::isPost()) {	
		
		try {
			$meetup->populate();
			
			fRequest::validateCSRFToken(fRequest::get('token'));
			
			$meetup->store();
			
			fMessaging::create('affected', $manage_url, $meetup->getDate()->__toString());
			fMessaging::create('success', $manage_url, 'The meetup on ' . $meetup->getDate()->format('F j, Y') . ' was successfully created');
			fURL::redirect($manage_url);
				
		} catch (fExpectedException $e) {
			fMessaging::create('error', fURL::get(), $e->getMessage());	
		}	
		
	} else {
		
		// Get the third thursday of this month, or next month if this month's has passed
		$date = fDate()->modify('Y-m-01')->adjust('+3 thursdays');
		if ($date->lt()) {
			$date = fDate('next month')->modify('Y-m-01')->adjust('+3 thursdays');
		}
		
		$meetup->setDate($date);
		$meetup->setVenue('The Grog');
		$meetup->setVenueWebsite('http://thegrog.com');	
		$meetup->setCity('Newburyport');
		$meetup->setState('MA');
		$meetup->setStartTime('7:00 pm');
		$meetup->setEndTime('10:30 pm');
		
	}

	include './views/add_edit.php';	
	
}


// --------------------------------- // 
if ('list' == $action) {
	
	$col = fCRUD::getSortColumn('date', 'location');
	$dir = fCRUD::getSortDirection('desc');
	fCRUD::redirectWithLoadedValues();
	
	$meetups = Meetup::findAll($col, $dir);

	include './views/list.php';
	
}