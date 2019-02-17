-- CREATE statement for the Threads table, which contains individual posts along with their author and associated case.

CREATE TABLE Threads (
thread_id         INT(8) NOT NULL AUTO_INCREMENT,
thread_content        TEXT NOT NULL,
thread_date       DATETIME NOT NULL,
thread_case     INT(8) NOT NULL,
thread_by     INT(8) NOT NULL,
PRIMARY KEY (thread_id)
) TYPE=INNODB;

-- Link thread to case that it's associated with
-- If the associated case is updated, the thread will be updated; if case is deleted, thread is deleted
ALTER TABLE Threads ADD FOREIGN KEY(thread_case) REFERENCES cases(id) ON DELETE CASCADE ON UPDATE CASCADE;

-- Link thread to user it's associated with
-- Won't delete thread if user is deleted, if user updated, change cascades
ALTER TABLE Threads ADD FOREIGN KEY(thread_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE;
