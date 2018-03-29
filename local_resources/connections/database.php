<!-- connection to database  -->

<?php

  function userConnection($username, $password){
      $connection=mysqli_connect('localhost','root','','decoders');

      if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
      }

      //escape the string escape sequence
      $username=mysqli_real_escape_string($connection,$username);
      $password=mysqli_real_escape_string($connection,$password);

      $hashFormat="$2y$10$";
      $salt="KLMNOPCBARQPZYXPOIUYRT";
      $hash_and_salt=$hashFormat . $salt;

      $encriptPass=crypt($password,$hash_and_salt);


      $query="select * from users where username='$username' && password='$encriptPass'";
      $result=mysqli_query($connection,$query);
      $rowcount=mysqli_num_rows($result);

      if($rowcount){
            $_SESSION["username"]=$username;
            header('location: member.php');
      }else{
            echo 'password not correct';
      }
}
?>
