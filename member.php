<?php
  // start the session
  session_start();
  // database connection
  include './local_resources/connections/database.php';
  // including the header
  require_once './local_resources/components/header.php';

  $connection=databaseConnection();

  if($_SESSION["username"]==true){
    $user=$_SESSION["username"];
  }else{
    header('location: index.php');
  }
?>

<body>
<?php require_once './local_resources/components/navbar.php'; ?>

    <br>
    <br>
    <br>
    <br>
<!--    <a href="logout.php">Logout</a>-->
<div class="container">
  <div class="row">
  <div class="col-sm-4">
   <h2 class="display-4 text-muted">1st Year</h2>
    <hr>
             <?php

            if($connection=mysqli_connect('localhost','root','','decoders')){

                    $query="select * from candidate where year='1'";
                    $result=mysqli_query($connection,$query);
                    $rowcount=mysqli_num_rows($result);

                    $canName="";
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                          //if($row["year"]=="1")
                            $canName=$row["name"];
      ?>

      <a href="candidate.php?candidateName=<?php echo $canName;?>" class="list-group-item select_candidate list-group-item-action "><?php echo  $canName;?></a>
        <?php
                        }

                  /*  while($fieldinfo=mysqli_fetch_field($result))
                    {
                     echo $fieldinfo["name"];

                    }*/


                    }


              }

    ?>


  </div>


  <div class="col-sm-4">
    <h2 class="display-4 text-muted">2nd Year</h2>
    <hr>
    <!--  -->
              <?php

            if($connection=mysqli_connect('localhost','root','','decoders')){

                    $query="select * from candidate where year='2'";
                    $result=mysqli_query($connection,$query);
                    $rowcount=mysqli_num_rows($result);

                    $canName="";
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                          // if($row["year"]=="2")
                            $canName=$row["name"];
      ?>

      <a href="candidate.php?candidateName=<?php echo $canName;?>" class="list-group-item select_candidate list-group-item-action "><?php echo  $canName;?></a>
        <?php

                        }

                  /*  while($fieldinfo=mysqli_fetch_field($result))
                    {
                     echo $fieldinfo["name"];

                    }*/


                    }


              }



    ?>



    <!--  -->
  </div>
  <div class="col-1">
  </div>
  <div class="col-3">
  <div class="card" style="width: 20rem;">
  <div class="card-header">
   <h5 class="text-center">Recomendations</h5>
  </div>
  <ul class="list-group list-group-flush">

    <?php
          $query="select * from feedback where recommend_to='$user'";
          $select_rows=mysqli_query($connection,$query);

          while($row=mysqli_fetch_assoc($select_rows)){
  echo "<li class='list-group-item pull-left'><a href='candidate.php?candidateName=".ucfirst($row["candidate_name"])."'>".$row['candidate_name']."</a><small class='pull-right'>from&nbsp&nbsp".$row['reviewer1']."</small></li>";
          }
    ?>
  </ul>
</div>
</div>
</div>
  <div class="row">
  <div class="col-4">



  </div>
  <div class="col-4">
  <div class="card">
  <div class="list-group">

      <!-- new updates added  -->


<!--  require the script files  -->

  </div>
  </div>
  </div>
   <div class="col-4"></div>
   </div>
 </div>

</body>


<?php require_once './local_resources/components/footer.php';?>
