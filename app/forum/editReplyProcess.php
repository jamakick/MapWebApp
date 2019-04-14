<?php
//editReplyProcess.php
session_start();



if(!$_SESSION["username"]) /* FIND BETTER WAY TO ANNOTATE SIGNED-ON-NESS, e.g. if($_SESSION['signed_in'] == false) */
 {
    //the user is not signed in
    echo "Sorry, you have to be <a href='../users/login.php'>signed in</a> to edit a reply.";
}
else
{

    $connection= mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38"); // this info can be consolidated

    if (!$connection) {
      die("Failed to connect to MySQL: " . mysqli_connect_error() );
    }

    //the user is signed in
    $username = $_SESSION["username"];

    if (isset($_GET["id"])) {
      $id = mysqli_real_escape_string($connection, $_GET["id"]);
      //echo "This is the id: " . $id ;
    }

    //start the transaction -- abundance of caution
    $query  = "BEGIN WORK;";
    $result_bw = mysqli_query($connection, $query);

    if(!$result_bw)
    {
        //the query failed, quit
        echo "An error occured while editing your thread." . mysqli_error($connection) . " Please try again later.";
    }
    else
    {
        mysqli_free_result($query);


        //create needed variables given by user
        $content = mysqli_real_escape_string($connection, $_POST["content"]);
      //  echo $content;


        date_default_timezone_get(); //set time to the zone the server is on
        $date_time = mysqli_real_escape_string($connection, date("Y-m-d H:i:s"));

      //  echo $date_time;


        //insert the thread
        $sql = "UPDATE Replies SET reply_content = '$content', reply_date = '$date_time' WHERE reply_id = $id;";
      //  echo $sql;

        $result = mysqli_query($connection, $sql);

        if(!$result)
        {
            //something went wrong, display the error
            echo 'An error occured while inserting your data. Please try again later. This is the error:' . mysqli_error($connection);
            $sql = "ROLLBACK;";
            $result = mysqli_query($connection, $sql);
        }

        else
        {
            $sql = "COMMIT;";
            $result = mysqli_query($connection, $sql);

            $sql = "SELECT reply_thread FROM Replies WHERE reply_id = $id;";
            $result = mysqli_query($connection, $sql);

            while ($record = mysqli_fetch_assoc($result)) {
              $thread_id = $record["reply_thread"];
            }
          //  echo "Committed work";

            //the query succeeded!
            header("Location:viewThread.php?id=$thread_id");
            //echo 'You have successfully edited your reply. Check out the <a href="forum.php">discussion</a>.'; // Find way to redirect, e.g. '<a href="thread.php?id='. $thread_id . '">your new thread</a>.';
        }
    }
}

?>
