<?php
fXML::sendHeader();
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss version="2.0">
	<channel>
		<title>North Shore Web Geeks Events</title>
		<description>Upcoming events for the North Shore Web Geeks group</description>
		<language>en-us</language>
		<copyright>Copyright <?php echo date('Y') ?>, North Shore Web Geeks</copyright>
		<link><?php echo fURL::getDomain() . URL_ROOT ?></link>
		<?php
		foreach ($meetups as $meetup) {
			?>
			<item>
				<title><?php echo fXML::encode($meetup->prepareDate('l, F jS, Y') . ' at ' . $meetup->getVenue() . ' in ' . $meetup->getCity() . ', ' . $meetup->getState()) ?></title>
				<?php
				if ($meetup->getVenueWebsite()) {
					$venue_line = '<a href="' . $meetup->prepareVenueWebsite() . '">' . $meetup->prepareVenue() . '</a>';
				} else {
					$venue_line = $meetup->prepareVenue();	
				}

				$yahoo_link = '';
				if ($meetup->getYahooUpcomingUrl()) {
					$yahoo_link = '<li><a href="' . $meetup->prepareYahooUpcomingUrl() . '">Yahoo Upcoming — ' . $meetup->prepareDate('F Y') . '</a></li>';
				}
								
				$description = "<h2>{$meetup->prepareDate('l, F j<\s\u\p>S</\s\u\p>, Y')}</h2>
					<div class=\"location\">
						at <strong>{$meetup->prepareVenue()}</strong>
						in <strong>{$meetup->prepareCity()}, {$meetup->prepareState()}</strong>
					</div>

					{$meetup->prepareDescription(TRUE)}

					<h3>Meetup Details</h3>

					<ul>
						<li><strong>Date:</strong> {$meetup->prepareDate('l, F j<\s\u\p>S</\s\u\p>')}</li>
						<li><strong>Start:</strong> {$meetup->prepareStartTime('g:i a')}</li>
						<li><strong>End:</strong> {$meetup->prepareEndTime('g:i a')}</li>
						<li>
							<strong>Location:</strong>
							{$venue_line}
						</li>
					</ul>

					<h3>On Other Sites</h3>
					<ul>
						<li><a href=\"http://www.facebook.com/group.php?gid=13809661338\">NSWG Facebook Group</a></li>
						{$yahoo_link}
					</ul>";
				?>
				<description><?php echo fXML::encode($description) ?></description>
				<pubDate><?php echo fXML::encode($meetup->prepareDatePosted('D, j M Y H:i:s T')) ?></pubDate>
				<link><?php echo fURL::getDomain() . URL_ROOT ?></link>
			</item>
			<?php
		}
		?>
	</channel>
</rss>