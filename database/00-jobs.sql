CREATE TABLE IF NOT EXISTS jobs (
	`ref_number` CHAR(5) NOT NULL,
	`title` VARCHAR(30) NOT NULL,
	`description` TEXT NOT NULL,
	`salary_min` MEDIUMINT UNSIGNED NOT NULL,
	`salary_max` MEDIUMINT UNSIGNED NOT NULL,
	`report_to` VARCHAR(30) NOT NULL,
	`responsibilities` TEXT NOT NULL,
	`requirements_essentials` TEXT NOT NULL,
	`requirements_preferable` TEXT NULL,
	PRIMARY KEY (`ref_number`)
);

INSERT INTO `jobs`(
	`ref_number`,
	`title`,
	`description`,
	`salary_min`,
	`salary_max`,
	`report_to`,
	`responsibilities`,
	`requirements_essentials`,
	`requirements_preferable`
) VALUES (
	'DAT01',
	'Data Scientist',
	'Collecting and storing data. Analyzing and modeling data. Extracting, transforming, and loading unstructured data (audio, video, social media posts, and customer feedback) into a usable format',
	'80000',
	'160000',
	'HR department',
	'Interrogate and extract data to supply tailored reports to colleagues, customers and wider organisation|Maintain clear and coherent communication, both verbal and written, to understand data needs and report results|Create clear reports that tell compelling stories about how customers or clients work with the business',
	'Data science degree|Required programming language: Python, R, SQL, SAS|Office tool: Tableau, PowerBI, Excel|Skill: communication, machine learning, machine data',
	'Skill: teamwork, strong communication skill, critical thinking skills, good intuition for data and data architecture'
), (
	'ENG01',
	'Engineer',
	'Design reliable and robust smart devices. Work with other IT professionals, troubleshooting software, planning, designing, updating and repairing all aspects of computer systems in the organization',
	'80000',
	'120000',
	'HR department',
	'Oversee different computer systems in the organization|Troubleshoot and identify systems problems n|Identify necessary improvements to computer systems|Configure and test systems|Respond to, and solve technical problems',
	'A bachelor degree in computer science or a similar field|Extensive knowledge of computer hardware systems|Knowledge of LAN and wireless networks',
	''
), (
	'PRG01',
	'Automation Programmer',
	'Develop the internal software that provides the main functionality of IoT devices',
	'92000',
	'142000',
	'HR department',
	'Code automation programs in C#, Java or Python|Apply scripting languages to automate tasks in existing systems|Produce and update documentation for software development projects|Review and edit codes from other programmers or developers',
	'For non-native English speakers: IELTS 6.9+ or TOEFL 6969|5 years of experience in Python and C++',
	''
), (
	'ISA01',
	'Information Security Analyst',
	'Monitor and protect the organization computer networks and systems. Investigate and report any security breaches, assist computer users with security products, and develop strategies for maintaining security',
	'85000',
	'115000',
	'HR department',
	'Detect, monitor and meditate various aspects of security - including physical security, software security, and network security|Perform compliance control testing|Develop recommendations and training programs to minimize security risk in the company|Stay aware of evolving threats in cybersecurity space by communicating with external sources|Collaborate with other teams and management to implement best security practices',
	'Computer security basics, which includes knowledge of firewalls, routers and other security infrastructures|Familiarity with privacy laws|Communication and teamwork|A bachelor degree for Information security analyst positions|A cybersecurity certification',
	''
), (
	'ENG02',
	'Quality Assurance Engineer',
	'Write and perform tests, identify and report any software issues',
	'84000',
	'142000',
	'HR department',
	'Ensure all products from the company meet the required commercial standards',
	'3+ years of experience in C++ and Python|Soft skills: Critical thinking, Written/Verbal communication skills',
	'Soft skill: Being sensitive to details|For Swinburne students only: D or HD in SWE30009'
);
