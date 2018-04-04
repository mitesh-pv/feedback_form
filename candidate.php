<?php
// starting session
session_start();

// database connection
include './local_resources/connections/database.php';

// including the header
require_once './local_resources/components/head.php';

// include navbar
require_once './local_resources/components/navbar.php';

// get the candidate name
$canName=$_GET["candidateName"];
$_SESSION['candidate']=$canName;

// connect database
$connection=databaseConnection();

// get the selected candidate details
$candidateArray=candidateConnection($canName);

// maintain the session
if($_SESSION["username"]==true){
  $user=$_SESSION["username"];
}else{
  header('location: index.php');
}



// submit details
if(isset($_GET["submit"])){

  $action=$_GET['action'];
  $comment=$_GET['comment'];
  $sec_reviewer=$_GET['sec_reviewer'];


  // putFeedback($action,$comment,$sec_reviewer,$_SESSION['username'],$canName);
  // header("Location: member.php");
  $query="insert into feedback values(null,'$canName','$user','$sec_reviewer','$action','$comment')";
  $result=mysqli_query($connection,$query);

  if(!$result){
    die('submission failed');
  }else{
    header("Location: https://www.google.com");
  }
}

?>

<!-- print the candidate details -->
<section class="profile container">
<form  action="candidate.php" method="get">

        <div class="row">
        <div class="jumbotron col-sm-8 ">
          <div class="card-title">
            <h3 class="text-center font-weight-bold"><?php echo $canName;?></h3>
            <hr>
          </div>
          <div class="card-text">
              <table>
                  <tr>
                    <td><h4  class="font-weight-bold text-muted">USN :</h4></td>
                    <td><h4 ><?php echo $candidateArray['usn'];?></h4></td>
                  </tr>
                  <tr>
                    <td><h4  class="font-weight-bold text-muted">Year :</h4></td>
                    <td><h4 ><?php echo $candidateArray["year"];?></h4></td>
                  </tr>
                  <tr>
                    <td><h4  class="font-weight-bold text-muted">Branch :</h4></td>
                    <td><h4 ><?php echo $candidateArray["branch"];?></h4></td>
                  </tr>
                  <tr>
                    <td><h4  class="font-weight-bold text-muted">CGPA :</h4></td>
                    <td><h4 ><?php echo $candidateArray["cgpa"];?></h4></td>
                  </tr>
              </table>
          </div>
          <hr>
        </div>

        <div class=" col-sm-4 mb-r can_card">
            <!-- col-lg-4 col-md-6 -->
            <!--Card-->
            <div class="card card-cascade narrower mb-r text-center" style="margin-top: 28px">
                <!--Card image-->
                <div class="view card-body card1">
                    <img src="./local_resources/components/img/display_picture/<?php echo $candidateArray['image'];?>" class="img-fluid" alt="">
                    <a>
                        <div class="mask rgba-white-slight waves-effect waves-light"></div>
                    </a>
                </div>
                <!--/.Card image-->
                <hr>
                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title text-muted"><?php echo $canName;?></h4>
                    <h5 class="text-primary "><span class="text-muted">&#9993;</span> &nbsp<?php echo $candidateArray['email'];?></h5>
                    <!--Text-->
                    <p class="card-text"></p>
                    <a class="btn btn-primary waves-effect waves-light" href="./local_resources/resumes/<?php echo $candidateArray['resume'];?>" download>Download Resume</a>
                </div>
                <!--/.Card content-->
            </div>
            <!-- Card -->
        </div>
      </div>

      <!--Blue select-->
      <hr class="row" style="width: 69%;">
      <!-- <label class="" >lReview: </label> -->
      <div class="selector" id="selector">
        <select class="row mdb-select select-picker" name="action" required>
            <option value="" disabled selected>Action</option>
            <option value="select">Select</option>
            <option value="recommend" id="recommend">Recomend</option>
            <option value="reject">Reject</option>
        </select>


      </div>
      <hr class="row" style="width: 69%;">
      <!--/Blue select-->
      <input type="hidden" name="candidateName" value="<?php echo $canName;?>">

      <div class="row">
        <div class=" row form-group shadow-textarea col-sm-8">
            <label for="comment" class="text-muted">Remark</label>
            <textarea class="form-control z-depth-1" id="comment" rows="3" placeholder="Write something here..." name="comment" style="height: 100%;" aria-expanded=false></textarea>
        </div>
      </div>
      <br><hr class="row" style="width: 69%;">

      <select class="mdb-select row select-picker" name="sec_reviewer" required>
          <option value="" disabled selected>second reviewer</option>
          <?php //$select_rows= getUsers($user);
                $query="select * from users where username !='$user'";
                $select_rows=mysqli_query($connection,$query);
                while($row=mysqli_fetch_assoc($select_rows)){
                  echo "<option value=".$row['username'].">".$row['username']."</option>";
                }
          ?>
      </select>

      <br><hr class="row" style="width: 69%;">

      <div class="row">
        <input type="submit" name="submit" class="btn btn-primary mb-r" value="Submit">
      </div>

</form>
</section>





<!-- jquery scripts  -->



<?php require_once './local_resources/components/footer.php';?>
