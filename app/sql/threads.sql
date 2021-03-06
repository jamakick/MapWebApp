CREATE TABLE Threads (
thread_id         INT(8) NOT NULL AUTO_INCREMENT,
thread_content        TEXT NOT NULL,
thread_title      VARCHAR(255) NOT NULL,
thread_date       DATETIME NOT NULL,
thread_case     INT(8) NOT NULL,
thread_by     INT(8) NOT NULL,
thread_replies  INT(8) DEFAULT 0,
thread_votes    INT(8) DEFAULT 1,
PRIMARY KEY (thread_id),
FOREIGN KEY (thread_case) REFERENCES cases(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (thread_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=INNODB;
