<?php
  //upvote.php
  session_start();

  $username = $_SESSION['username'];

  $connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

  if (!$connection) {
    die("Failed to connect to MySQL: " . mysqli_connect_error() );
  }

  $vote_type = $_GET["type"] ;

  if ($vote_type == "up") {
    $type = 1 ;
  }
  else {
    $type = 2 ;
  }

  echo $type ;

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $usql = "UPDATE Threads SET thread_votes = thread_votes + 1 WHERE thread_id = $id ;" ;
    $dsql = "UPDATE Threads SET thread_votes = thread_votes - 1 WHERE thread_id = $id ;" ;
    $fieldname = "thread";
    $is_thread = True;

  }
  else {
    $id = $_GET["rid"];
    $usql = "UPDATE Replies SET reply_votes =  reply_votes + 1 WHERE reply_id = $id ;" ;
    $dsql = "UPDATE Replies SET reply_votes = reply_votes - 1 WHERE reply_id = $id ; " ;
    $fieldname = "reply";
    $is_thread = False;

  }

  //lookup user ID based on username
  $userLookup = "SELECT user_id FROM users WHERE username = '$username'; ";
  //echo $userLookup;
  $userResult = mysqli_query($connection, $userLookup);

  if (!$userResult)
  {
    //something went wrong, display the error
    echo "An error occurred when confirming your account. Please try again later. This is the error:" . mysqli_error($connection);
  }

  else
  {

    while ($record = mysqli_fetch_assoc($userResult)) {
      $user_id = $record["user_id"];
      //echo "The user id is " . $user_id ;
    }

  }

  $voteActionQuery = "SELECT * FROM Votes WHERE user = $user_id AND $fieldname = $id ;" ;

  $voteActionResult = mysqli_query($connection, $voteActionQuery);

  //echo $voteActionResult ;

  $hasVoted = mysqli_num_rows($voteActionResult) != 0;

  if ($hasVoted) { //user has voted on that id before
    switch ($voteActionResult["type"]) {
    case 0:
      $vote_action_type = "revoked";
      break;
    case 1:
      $vote_action_type = "up";
      break;
    case 2:
      $vote_action_type = "down";
      break;
    default:
      break;

    if ($vote_type == $vote_action_type) { // we voted before and we're voting for the same thing as before

      if ($vote_type == "up") {
          die();
      }

      elseif ($vote_type == "down") {
        die();
      }

    }

    else { //we voted before and we voted for the opposite thing as before

        $trackQuery = "UPDATE Votes SET type = 0 WHERE action_by ='$username' AND $fieldname =$id ;";
        //echo $trackQuery ;
        $trackResult = mysqli_query($trackQuery);

      }
  }
}
  else { //user has not voted on this before

    //get required data for inserting record into Votes table --- caseID, timestamp

    if ($is_thread) {
      $thread_case = "SELECT thread_case FROM Threads WHERE thread_id = $id ;";
      $threadQuery = mysqli_query($thread_case);
       while ($record = mysqli_fetch_assoc($threadQuery)) {
         $case_id = $record["thread_case"];
       }

    } else {
      $reply_case = "SELECT reply_case FROM Replies WHERE reply_id = $id;" ;
      $replyQuery = mysqli_query($reply_case);
      while ($record = mysqli_fetch_assoc($replyQuery)) {
        $case_id = $record["reply_case"];
      }

    }

  //  echo "This is the case id : " . $case_id ;


    //timestamp
    date_default_timezone_get(); //set time to the zone the server is on
    $date_time = mysqli_real_escape_string($connection, date("Y-m-d H:i:s"));


    //update Votes table
    $voteQuery = "INSERT INTO Votes (user, case_id, $fieldname, vote_time, type) VALUES ($user_id, $case_id, $id, $date_time, $type);";
  //  echo $voteQuery ;
    $voteResult = mysqli_query($voteQuery);


    //actually perform the action
    if ($vote_type == "up") {

        $upvoteQuery = mysqli_query($connection, $usql);

        //did upvote work?

        if(!$upvoteQuery) {
          //something went wrong, display the error
          echo 'An error occured while upvoting. Please try again later. This is the error:' . mysqli_error($connection);
          $sql = "ROLLBACK;";
          $result = mysqli_query($connection, $sql);
        }

        else {
          $sql = "COMMIT;";
          $result = mysqli_query($connection, $sql);

          header("Location: viewThread.php?id=$id");
        }


    } else {
      $downvoteQuery = mysqli_query($connection, $dsql);

      //did upvote work?

      if(!$downvoteQuery) {
        //something went wrong, display the error
        echo 'An error occured while downvoting. Please try again later. This is the error:' . mysqli_error($connection);
        $sql = "ROLLBACK;";
        $result = mysqli_query($connection, $sql);
      }

      else {
        $sql = "COMMIT;";
        $result = mysqli_query($connection, $sql);

        header("Location: viewThread.php?id=$id");
      }


    }

  }

?>

<footer>
<div class="footerDiv">

<a href="http://cgi.soic.indiana.edu/~team38/index.php">Home</a>
<a href="http://cgi.soic.indiana.edu/~team38/profile.php">Profile</a>
<a href="http://cgi.soic.indiana.edu/~team38/subscription.php">Subscriptions</a>
<?php
if (isset($_SESSION['username'])) {
	echo '<a href="http://cgi.soic.indiana.edu/~team38/users/logout.php">Log Out</a>';
}

else if (!isset($_SESSION['username'])) {
	echo '<a href="http://cgi.soic.indiana.edu/~team38/users/login.php">Log In</a>';
}
?>

</div>
</footer>

</body>
</html>
