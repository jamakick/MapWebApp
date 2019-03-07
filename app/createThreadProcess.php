<?php
//createThreadProcess.php
session_start();

if(!$_SESSION["username"]) /* FIND BETTER WAY TO ANNOTATE SIGNED-ON-NESS, e.g. if($_SESSION['signed_in'] == false) */
{
    //the user is not signed in
    echo "Sorry, you have to be <a href='../users/login.php'>signed in</a> to create a topic.";
}
else
{

    if (isset($_GET["id"])) {
      $id = $_GET["id"];
    //  echo "This is the id: " . $id ;
    }

    $connection= mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38"); // this info can be consolidated

    if (!$connection) {
      die("Failed to connect to MySQL: " . mysqli_connect_error() );
    }

    //the user is signed in
    $username = $_SESSION["username"];



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
          echo "An error occurred when confirming your account. Please try again later. This is the error:" . mysqli_error($connection);
        }

        else
        {

          while ($record = mysqli_fetch_assoc($user_result)) {
            $user_id = $record["user_id"];
          }

        }



        //create needed variables given by user
        $content = mysqli_real_escape_string($connection, $_POST["content"]);
        $title = mysqli_real_escape_string($connection, $_POST["title"]);
        //create needed variables that are not submitted by the users
        $case_id = mysqli_real_escape_string($connection, $id); 

        date_default_timezone_get(); //set time to the zone the server is on
        $date_time = mysqli_real_escape_string($connection, date("Y-m-d H:i:s"));


        //insert the thread
        $sql = "INSERT INTO Threads(thread_content, thread_title, thread_case, thread_date, thread_by) VALUES ('$content', '$title', $case_id, '$date_time', '$user_id');";
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

            //the query succeeded!
            echo 'You have successfully created your new thread. Check out the <a href="forum.php">discussion</a>.'; // Find way to redirect, e.g. '<a href="thread.php?id='. $thread_id . '">your new thread</a>.';
        }
    }
}

?>
