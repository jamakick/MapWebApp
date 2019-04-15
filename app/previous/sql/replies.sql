CREATE TABLE Replies (
reply_id         INT(8) NOT NULL AUTO_INCREMENT,
reply_content        TEXT NOT NULL,
reply_date       DATETIME NOT NULL,
reply_case     INT(8) NOT NULL,
reply_thread   INT(8) NOT NULL,
reply_by     INT(8) NOT NULL,
reply_replies   INT(8) DEFAULT 0,
reply_votes   INT(8) DEFAULT 1,
PRIMARY KEY (reply_id),
FOREIGN KEY (reply_case) REFERENCES cases(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (reply_thread) REFERENCES Threads(thread_id) ON DELETE RESTRICT ON UPDATE CASCADE,
FOREIGN KEY (reply_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=INNODB;
