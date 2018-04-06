<?php
  // start the session
  session_start();

  // database connection
  include './local_resources/connections/database.php';
  // including the head
  require_once './local_resources/components/header.php';

  // database connection
  $connection=databaseConnection();

  //requires the registration form php file
  require 'admin.php';

  // user vlidation and user registration
  if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    if($username && $password)
        userConnection($username,$password);
    else{
        echo 'enter username and password';
    }

  }elseif (isset($_POST['signup'])) {

    $username=$_POST['username'];
    $password=$_POST['password'];
    $authKey=$_POST['authkey'];

    // insert the new user into the users table
    if($username && $password)
      putUser($username,$password);
    else
      echo 'enter username and password';
    }else{
        //  toastr.success('Hi! I am success message.');
    }
?>
<body class="body1">

    <!-- Start your project here-->
    <!-- Card -->
    <section class=" container main_section">
      <!-- Card -->
      <div class="card col-sm-6 align-items-center">
          <!-- Card body -->
          <div class="card-body">
              <!-- Default form subscription -->
              <form method=post action="index.php">
                  <div class="row">
                    <img src="./local_resources/components/img/custom_images/title.jpg" alt="decoders_logo" class="scr" id="logo" style="width: 30%; height:70%; border-radius:10px cursor: pointer;" >
                  </div>
                  <br><br>
                  <!-- Default input name -->
                  <label for="username" class="grey-text font-weight-light">User name</label>
                  <input type="text" id="username" class="form-control" name="username" placeholder=" enter username ">
                  <br>
                  <!-- Default input email -->
                  <label for="password" class="grey-text font-weight-light">Password</label>
                  <input type="password" id="password" class="form-control form-5 md-form" name="password" placeholder="•••••••• ">
                  <div class="text-center py-4 mt-3">
                      <button class="btn btn-primary  btn-block" type="submit" name="submit">Login</button>
                  </div>
              </form>

                  <!-- registration -->
                  <a href="" class="badge badge-primary mb-4" data-toggle="modal" data-target="#signupform" class="badge badge-primary">admin</a>
                  <!-- registration -->

              <!-- Default form subscription -->
          </div>
          <!-- Card body -->
      </div>
      <!-- Card -->
    </section>
    <!-- Card -->
    <!-- /Start your project here-->


<!-- JQuery -->
<script type="text/javascript" src="./local_resources/components/js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="./local_resources/components/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="./local_resources/components/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="./local_resources/components/js/mdb.min.js"></script>
<!-- scripts -->
</body>
</html>
