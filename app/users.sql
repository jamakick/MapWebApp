create table users (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	user_email VARCHAR(40),
	user_first VARCHAR(20),
	user_last VARCHAR(20),
	user_dob DATE,
	username VARCHAR(50),
	password VARCHAR(50),
	browsing_history VARCHAR(1000),
	subscription VARCHAR(1000)
);
