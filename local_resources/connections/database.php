<!-- connection to database  -->

<?php
$c=null;

function databaseConnection(){

    global $c;

    $c=mysqli_connect('localhost','root','','decoders');
        if (!$c) {
          die("Connection failed: " . mysqli_connect_error());
        }

  }

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
      'usn'=>$row['usn'],
      'email'=>$row['email'],
      'phone'=>$row['phone'],
      'year'=>$row['year'],
      'branch'=>$row['branch'],
      'cgpa'=>$row['cgpa'],
      'image'=>$row['image'],
      'resume'=>$row['resume'],
    );

    return $candidateArray;


}
?>
