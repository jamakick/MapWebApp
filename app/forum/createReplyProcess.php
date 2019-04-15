<?php
//createReplyProcess.php
session_start();



if(!$_SESSION["username"]) /* FIND BETTER WAY TO ANNOTATE SIGNED-ON-NESS, e.g. if($_SESSION['signed_in'] == false) */
 {
    //the user is not signed in
    echo "Sorry, you have to be <a href='../users/login.php'>signed in</a> to create a reply.";
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
      $id = $_GET["id"];
    //  echo "This is the id: " . $id ;
    }

    //start the transaction -- abundance of caution
    $query  = "BEGIN WORK;";
    $result_bw = mysqli_query($connection, $query);

    if(!$result_bw)
    {
        //the query failed, quit
        echo "An error occured while creating your thread." . mysqli_error($connection) . " Please try again later.";
    }
    else
    {
        mysqli_free_result($query);



        //lookup user ID based on username
        $user_lookup = "SELECT user_id FROM users WHERE username = '$username'; ";
      //  echo $user_lookup;
        $user_result = mysqli_query($connection, $user_lookup);

        if (!$user_result)
        {
          //something went wrong, display the date_get_last_errors
          echo "An error occurred when connecting to your account. Please try again later. This is the error:" . mysqli_error($connection);
        }

        else
        {

          while ($record = mysqli_fetch_assoc($user_result)) {
            $user_id = $record["user_id"];
          }

        }

        //lookup case in based on thread
        $case_lookup = "SELECT * FROM Threads WHERE thread_id = '$id';";
        $case_result = mysqli_query($connection, $case_lookup);
        if (!$case_result) {
          echo "An error occurred when locating the case. Please try again. This is the error: " . mysqli_error($connection);
        }
        else {
          while ($record = mysqli_fetch_assoc($case_result)) {
            $case_id = $record["thread_case"];
          }
        }

      //  echo "Case ID is : " . $case_id;



        //create needed variables given by user
        $content = mysqli_real_escape_string($connection, $_POST["content"]);

        date_default_timezone_get(); //set time to the zone the server is on
        $date_time = mysqli_real_escape_string($connection, date("Y-m-d H:i:s"));

        $thread_id = mysqli_real_escape_string($connection, $id);
        //echo "the thread ID is: " . $thread_id;


        //insert the thread
        $sql = "INSERT INTO Replies(reply_content, reply_date, reply_case, reply_thread, reply_by) VALUES ('$content', '$date_time', $case_id, '$thread_id', '$user_id');";
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
            $update_replies = "UPDATE Threads SET thread_replies = thread_replies + 1 WHERE thread_id = $thread_id;";
            $update_result = mysqli_query($update_replies);

            $sql = "COMMIT;";
            $result = mysqli_query($connection, $sql);

            //the query succeeded!
            //echo "You have successfully created your new reply. Check out the <a href='../viewThread.php?id=$case_id'>discussion</a>."; // Find way to redirect, e.g. '<a href="thread.php?id='. $thread_id . '">your new thread</a>.';
            header("Location:viewThread.php?id=$thread_id");
        }
    }
}

?>
