<!-- connection to database  -->

<?php

$c=null;

// conenctiom establishment to the database
function databaseConnection(){

    global $c;

    $c=mysqli_connect('localhost','root','','decoders');
    if (!$c) {
      die("Connection failed: " . mysqli_connect_error());
    }
    return $c;
}

// generate usersConnection to validate login
function userConnection($username, $password){
      global $c;

      //escape the string escape sequence
      $username=mysqli_real_escape_string($c,$username);
      $password=mysqli_real_escape_string($c,$password);

      $hashFormat="$2y$10$";
      $salt="KLMNOPCBARQPZYXPOIUYRT";
      $hash_and_salt=$hashFormat . $salt;

      $encriptPass=crypt($password,$hash_and_salt);


      $query="select * from users where username='$username' && password='$encriptPass'";
      $result=mysqli_query($c,$query);
      $rowcount=mysqli_num_rows($result);

      if($rowcount){
            $_SESSION["username"]=$username;
            header('location: member.php');
      }else{
            echo 'password not correct';
      }

  }


// connect to candidate database to get candidate form details
function candidateConnection($canName){
    global $c;

    $query="select * from candidate where   name='$canName'";
    $select_row=mysqli_query($c,$query);

    // pull all the data from database
    while($row=mysqli_fetch_assoc($select_row)){
        $canUsn=$row['usn'];
        $canEmail=$row['email'];
        $canPhone=$row['phone'];
        $canYear=$row['year'];
        $canBranch=$row['branch'];
        $canCGPA=$row['cgpa'];
        $canImage=$row['image'];
        $canResume=$row['resume'];
    }

    // push the data into the candidate array and return the array
    $candidateArray= array(
      'usn'=>$canUsn,
      'email'=>$canEmail,
      'phone'=>$canPhone,
      'year'=>$canYear,
      'branch'=>$canBranch,
      'cgpa'=>$canCGPA,
      'image'=>$canImage,
      'resume'=>$canResume,
    );
    return $candidateArray;
}

//function to register new users  who are logging in first time
function putUser($username,$password){
  global $c;

  $username=mysqli_real_escape_string($c,$username);
  $password=mysqli_real_escape_string($c,$password);

  $hashFormat="$2y$10$";
  $salt="KLMNOPCBARQPZYXPOIUYRT";
  $hash_and_salt=$hashFormat . $salt;

  $encriptPass=crypt($password,$hash_and_salt);

  $query="insert into users values(null, '$username','$encriptPass')";
  $result=mysqli_query($c,$query);

  if($result){
    $_SESSION["username"]=$username;
    header('refresh: 1.5; url=member.php');
  }else{
    die('authentication failed');
  }
}

// function to fetch user who are the second reviewer

function putFeedback($action,$comment,$sec_reviewer,$username,$canName){
    global $c;

    $query="insert into frrdback values(null, '$canName','$username','$sec_reviewer','$action','$comment')";
    $result=mysqli_query($c,$query);

    if(!$result){
      die('submission failed');
    }else{
      header('member.php');
    }



}

?>
