<?php
//createThreadProcess.php
session_start();

if(!$_SESSION["username"]) /* FIND BETTER WAY TO ANNOTATE SIGNED-ON-NESS. if($_SESSION['signed_in'] == false) */
{
    //the user is not signed in
    echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';
}
else
{

    $connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

    if (!$connection) {
      die("Failed to connect to MySQL: " . mysqli_connect_error() );
    }

    //the user is signed in
    $username = $_SESSION["username"];


    //start the transaction
    $query  = "BEGIN WORK;";
    $result = mysql_query($query);

    if(!$result)
    {
        //Damn! the query failed, quit
        echo 'An error occured while creating your thread. Please try again later.';
    }
    else
    {

        //the form has been posted, so save it
        //insert the topic into the topics table first, then we'll save the post into the posts table
        $sql = "INSERT INTO
                    topics(topic_subject,
                           topic_date,
                           topic_cat,
                           topic_by)
               VALUES('" . mysql_real_escape_string($_POST['topic_subject']) . "',
                           NOW(),
                           " . mysql_real_escape_string($_POST['topic_cat']) . ",
                           " . $_SESSION['user_id'] . "
                           )";

        $result = mysql_query($sql);
        if(!$result)
        {
            //something went wrong, display the error
            echo 'An error occured while inserting your data. Please try again later.' . mysql_error();
            $sql = "ROLLBACK;";
            $result = mysql_query($sql);
        }

        else
        {
            $sql = "COMMIT;";
            $result = mysql_query($sql);

            //after a lot of work, the query succeeded!
            echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
        }
      }
}

?>
