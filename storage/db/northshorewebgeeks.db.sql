CREATE TABLE meetups (
	date DATE PRIMARY KEY,
	venue VARCHAR(255) NOT NULL,
	venue_website VARCHAR(255) NOT NULL DEFAULT '',
	city VARCHAR(255) NOT NULL,
	state CHAR(2) NOT NULL,
	start_time TIME NOT NULL,
	end_time TIME NOT NULL,
	description TEXT NOT NULL DEFAULT '',
	yahoo_upcoming_url VARCHAR(255) NOT NULL DEFAULT '',
	google_maps_html TEXT NOT NULL DEFAULT '',
	date_posted TIMESTAMP NOT NULL
);