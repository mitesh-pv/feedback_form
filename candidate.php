<?php
// starting session
session_start();

// database connection
include './local_resources/connections/database.php';

// including the header
require_once './local_resources/components/header.php';

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

  $recommend_to=null;
  if($action==="recommend"){
    $recommend_to;
  }


  // putFeedback($action,$comment,$sec_reviewer,$_SESSION['username'],$canName);
  // header("Location: member.php");
  $query="insert into feedback values(null,'$canName','$user','$sec_reviewer','$action','$comment','mitesh')";
  $result=mysqli_query($connection,$query);

  if(!$result){
    die('submission failed');
  }else{

  }
}

?>

<!-- print the candidate details -->
<section class="profile container">
  <div class="row"><a type="button" href="member.php"class="btn btn-primary"><i class="fa fa-chevron-left ml-1 pull-left"></i> </a></div>
  <br>
<form  action="candidate.php" method="get">

        <div class="row">
        <div class="jumbotron jumbotron1 col-sm-8 ">
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

      <div class="row">
    <div class="col-sm-8 jumbotron">

          <!--Blue select-->

          <label class="card-title text-muted" >Review: </label>
           <div class="selector" id="selector">
            <select class="mdb-select select-picker" id="s" name="action" required>
                <option value="" disabled selected>Action</option>
                <option value="select">Select</option>
                <option value="recommend" id="recommend">Recommend</option>
                <option value="reject">Reject</option>
            </select>
          </div>

          <br><br>

        <!-- </div> -->

        <!-- next to delete  -->
      <!-- <hr class="row"> -->
      <!--/Blue select-->
      <input type="hidden" name="candidateName" value="<?php echo $canName;?>">

        <!-- <div class="col-sm-8"> -->
                <!-- text area for comments -->

                <div class="form-group">
                  <label for="comments">Remarks</label>
                  <textarea class="form-control" id="comment" rows="3" placeholder="   Write something here..." name="comment" style="padding-Left:2px; height: 100%; width:;" aria-expanded=false></textarea>
                </div>


                <!-- text area for comments -->
                <br><br>
                <!-- <hr class="row"> -->

                <!-- option for second interviewer -->
                <select class="mdb-select select-picker" name="sec_reviewer" required>
                    <option value="" disabled selected>second reviewer</option>
                    <?php //$select_rows= getUsers($user);
                          $query="select * from users where username !='$user'";
                          $select_rows=mysqli_query($connection,$query);
                          while($row=mysqli_fetch_assoc($select_rows)){
                            echo "<option value=".$row['username'].">".$row['username']."</option>";
                          }
                    ?>
                </select>
                <br><br>
                <!-- <hr class="row"> -->



        <!-- </div> -->
      <hr>
      <!--submit button  -->
        <div class="d-flex justify-content-center"><input type="submit" name="submit" class="btn  btn-primary mb-lg-auto" value="Submit"></div>

  </div>

  <!-- test scores  -->
  <div class="col-sm-4">
  <div class=" card score_card">
    <div class="card-header blue text-center font-weight-bold">Test Scores</div>
    <ul class="list-group list-group-flush">
      <?php
            $q="select * from scores where usn='".$candidateArray["usn"]."'";
            $select_row=mysqli_query($connection,$q);
            $row=mysqli_fetch_assoc($select_row);
            echo "<li class='list-group-item'><h5 class='pull-left'>Aptitude</h5><p class='pull-right'>".$row["score1"]."</p></li>";
            echo "<li class='list-group-item'><h5 class='pull-left'>Coding</h5><p class='pull-right'>".$row["score2"]."</p></li>";
      ?>
    </ul>
  </div>
  <br>
  <div class="card border-light mb-3 score_card comment_card">
    <div class="card-header text-center blue font-weight-bold">Previous Remark</div>
    <div class="card-body">
        <?php $query="select * from feedback where candidate_name='$canName'";
              $s=mysqli_query($connection,$query);
              $row=mysqli_fetch_assoc($s);
              echo "<p class='card-text '>".$row["comments"]."</p>";
              echo " <p class='card-text '><small class='text-muted pull-right'>".$row["reviewer1"]."</small></p>"
        ?>
    </div>
 </div>
  <!-- test scores  -->
</div>
</form>
</section>




<!-- Central Modal Medium Success -->
<div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-notify modal-success" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <p class="heading lead">whome do you want to recommend</p>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
        </div>

        <!--Body-->
        <div class="modal-body">
            <div class="text-center">
              <select class="mdb-select select-picker" name="recommend_to">
            <?php  $query="select * from users where username !='$user'";
              $select_rows=mysqli_query($connection,$query);
              while($row=mysqli_fetch_assoc($select_rows)){
                echo "<option value=".$row['username'].">".$row['username']."</option>";
              }
              ?>
            </select>
            </div>
        </div>

        <!--Footer-->
        <div class="modal-footer justify-content-center">
            <a type="button" class="btn btn-success waves-effect" data-dismiss="modal">Forward</a>
        </div>
    </div>
    <!--/.Content-->
</div>
</div>
<!-- Central Modal Medium Success-->

<!-- Button trigger modal -->
<div class="text-center">
<a href="" class="btn btn-default btn-rounded" data-toggle="modal" data-target="#centralModalSuccess">Launch Modal Success <i class="fa fa-eye ml-1"></i></a>
</div>



<script>
$(function(){

   $(".dropdown-menu1 a").click(function(){

     $(".btn1:first-child").text($(this).text());
     $(".btn1:first-child").val($(this).text());

  });

});

</script>

<!-- jquery scripts  -->
<?php require_once './local_resources/components/footer.php';?>
