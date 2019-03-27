<?php
  //downvote.php
  session_start();

  $username = $_SESSION['username'];

  if (isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "UPDATE Threads SET thread_votes = thread_votes - 1 WHERE thread_id = $id ;" ;
}
  else {
    $id = $_GET["rid"];
    $sql = "UPDATE Replies SET reply_votes =  reply_votes - 1 WHERE reply_id = $rid ;" ;
}

if ($downvote == False) {

  $connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

  if (!$connection) {
    die("Failed to connect to MySQL: " . mysqli_connect_error() );
  }



  $downvoteQuery = mysqli_query($connection, $sql);

  //did downvote work?

  if(!$downvoteQuery) {
      //something went wrong, display the error
      echo 'An error occured while upvoting. Please try again later. This is the error:' . mysqli_error($connection);
      $sql = "ROLLBACK;";
      $result = mysqli_query($connection, $sql);
  }

  else
  {
      $sql = "COMMIT;";
      $result = mysqli_query($connection, $sql);

      //set variable to show that user has already downvoted

      $downvote = True;

      header("Location: viewThread.php?id=$id");
  }
}

?>
