<?php
//deleteReplyProcess.php
  session_start();

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    //echo "This is the id: " . $id ;
  }

  if(!$_SESSION["username"]) /* FIND BETTER WAY TO ANNOTATE SIGNED-ON-NESS, e.g. if($_SESSION['signed_in'] == false) */
   {
      //the user is not signed in
      echo "Sorry, you have to be <a href='../users/login.php'>signed in</a> to delete a thread.";
  }

  else {

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
        echo "An error occured while creating your reply." . mysqli_error($connection) . " Please try again later.";
    }
    else
    {
        mysqli_free_result($query);
    }

    //check: does thread have children?
    $childQuery = mysqli_query($connection, "SELECT * FROM Replies WHERE reply_id = $id;");

    while ($record = mysqli_fetch_assoc($childQuery)) {
      $num_children = $record["reply_replies"];
    }

    //if thread has children, replace content with [deleted]
    if($num_children >= 1) {
      $updateQuery = mysqli_query($connection, "UPDATE Replies SET reply_content = '[deleted]' WHERE reply_id = $id;");

      //did update work?

      if(!$updateQuery) {
          //something went wrong, display the error
          echo 'An error occured while deleting your data. Please try again later. This is the error:' . mysqli_error($connection);
          $sql = "ROLLBACK;";
          $result = mysqli_query($connection, $sql);
      }

      else
      {
          $sql = "COMMIT;";
          $result = mysqli_query($connection, $sql);

          //the query succeeded!
          echo 'You have successfully deleted your reply. Check out the <a href="forum.php">discussion</a>.'; // Find way to redirect, e.g. '<a href="thread.php?id='. $thread_id . '">your new thread</a>.';
      }
    }

    else {
      $deleteQuery = mysqli_query($connection, "DELETE FROM Replies WHERE reply_id = $id;");

      //did delete work?

      if(!$deleteQuery) {
          //something went wrong, display the error
          echo 'An error occured while deleting your data. Please try again later. This is the error:' . mysqli_error($connection);
          $sql = "ROLLBACK;";
          $result = mysqli_query($connection, $sql);
      }

      else
      {
          $sql = "COMMIT;";
          $result = mysqli_query($connection, $sql);

          //the query succeeded!
          echo 'You have successfully deleted your reply. Check out the <a href="forum.php">discussion</a>.'; // Find way to redirect, e.g. '<a href="thread.php?id='. $thread_id . '">your new thread</a>.';
      }

    }

  }

?>
