CREATE TABLE tx_nscourses_domain_model_course (
	title varchar(255) NOT NULL DEFAULT '',
	description varchar(255) NOT NULL DEFAULT '',
	file int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_nscourses_domain_model_students (
	name varchar(255) NOT NULL DEFAULT '',
	email varchar(255) NOT NULL DEFAULT '',
	course int(11) unsigned DEFAULT '0'
);
