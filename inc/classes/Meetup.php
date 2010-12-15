<?php
/**
 * Handles storing and retrieving a single meetup
 *        
 * @copyright  Copyright (c) 2009 Will Bond
 * @author     Will Bond [wb] <will@flourishlib.com>
 */
class Meetup extends fActiveRecord
{
	/**
	 * Returns all meetups on the system
	 * 
	 * @param  string  $sort_column  The column to sort by
	 * @param  string  $sort_dir     The direction to sort the column
	 * @return fRecordSet  An object containing all meetups
	 */
	static function findAll($sort_column, $sort_dir)
	{
		if (!in_array($sort_column, array('date', 'location'))) {
			$sort_column = 'date';
		} 
		
		if (!in_array($sort_dir, array('asc', 'desc'))) {
			$sort_dir = 'desc';
		}
		
		if ($sort_column == 'location') {
			$sort_column = "venue || ' ' || city || ' ' || state";	
		}
		
		return fRecordSet::build(
			__CLASS__,
			array(),
			array($sort_column => $sort_dir)
		);	
	}
	
	
	/**
	 * Returns all meetups on the system through next month
	 * 
	 * @return fRecordSet  An object containing all meetups
	 */
	static function findCurrent()
	{
		return fRecordSet::build(
			__CLASS__,
			array('date<=' => fDate('+4 weeks')),
			array('date' => 'desc')
		);	
	}
	
	
	/**
	 * Creates all Meetup related URLs for the site
	 * 
	 * @param  string $type  The type of URL to make: 'list', 'add', 'edit', 'delete'
	 * @param  Meetup $obj   The Meetup object for the edit and delete URL types
	 * @return string  The URL requested
	 */
	static public function makeURL($type, $obj=NULL)
	{
		switch ($type)
		{
			case 'list':
				return 'manage';
			case 'add':
				return 'manage/add';
			case 'edit':
				return 'manage/' . $obj->prepareDate('Y-m-d') . '/edit';
			case 'delete':
				return 'manage/' . $obj->prepareDate('Y-m-d') . '/delete';
		}	
	}
	
	
	/**
	 * Allows the programmer to set features for the class. Only called once per page load for each class.
	 * 
	 * @return void
	 */
	protected function configure()
	{
		fORMColumn::configureLinkColumn($this, 'venue_website');
		fORMColumn::configureLinkColumn($this, 'yahoo_upcoming_url');
		
		fORMDate::configureDateCreatedColumn($this, 'date_posted');
	}	
	
	
	/**	
	 * Sets the Google Maps HTML, removing some unwanted HTML attributes
	 * 
	 * @param  string $google_maps_html  The HTML for the embedded google map
	 * @return void
	 */
	public function setGoogleMapsHtml($google_maps_html)
	{
		$google_maps_html = preg_replace('#<iframe.*?src=#', '<iframe src=', $google_maps_html);
		$google_maps_html = preg_replace('#\s+style=".*?"#', '', $google_maps_html);
		$this->set('google_maps_html', $google_maps_html);
	}	
}