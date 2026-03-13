CREATE TABLE IF NOT EXISTS `eoi` (
	`eoi_number` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	`ref_number` char(5) NOT NULL,
	`status` enum('New','Current','Final') NOT NULL DEFAULT 'New',
	`first_name` varchar(20) NOT NULL,
	`last_name` varchar(20) NOT NULL,
	`birth_date` char(10) NOT NULL,
	`gender` enum('male','female','jesus','toyota','copter','other') NOT NULL,
	`street` varchar(40) NOT NULL,
	`town` varchar(40) NOT NULL,
	`state` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
	`postcode` smallint(4) unsigned zerofill NOT NULL,
	`email` varchar(40) NOT NULL,
	`phone` varchar(16) NOT NULL,
	PRIMARY KEY (`eoi_number`),
	CONSTRAINT `APPLY_POSITION` FOREIGN KEY (`ref_number`) REFERENCES `jobs` (`ref_number`)
) COMMENT='EOI for COS10026 Assignment 2';

CREATE TABLE IF NOT EXISTS `eoi_skills` (
	`eoi_number` mediumint(8) unsigned NOT NULL,
	`skill_1` varchar(512) DEFAULT NULL,
	`skill_2` varchar(512) DEFAULT NULL,
	`skill_3` varchar(512) DEFAULT NULL,
	`skill_4` varchar(512) DEFAULT NULL,
	`skill_others` text NOT NULL,
	PRIMARY KEY (`eoi_number`),
	CONSTRAINT `EOI_LINK` FOREIGN KEY (`eoi_number`) REFERENCES `eoi` (`eoi_number`)
) COMMENT='EOI Skills for COS10026 Assignment 2';
