CREATE TABLE Votes (
id   INT(8) NOT NULL AUTO_INCREMENT,
user     INT(8) NOT NULL,
case_id   INT(8) NOT NULL,
thread_id INT(8),
reply_id  INT(8),
vote_time   DATETIME NOT NULL,
type   INT(8) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (user) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=INNODB;
