<?php
// starting session
session_start();
// database connection
include './local_resources/connections/database.php';
// including the header
require_once './local_resources/components/header.php';
// include navbar
require_once './local_resources/components/navbar.php';
// maintain the session
if($_SESSION["username"]==true){
  $user=$_SESSION["username"];
}else{
  header('location: index.php');
}
// get the candidate name
$canName=$_GET["candidateName"];
$_SESSION['candidate']=$canName;
// connect database
$connection=databaseConnection();
// get the selected candidate details
$candidateArray=candidateConnection($canName);
$recomm=null;
$action=null;
// submit details
if(isset($_GET["submit"])){
  $action=$_GET["action"];
  $comment=$_GET["comment"];
  $sec_reviewer=$_GET["sec_reviewer"];
  if($action==="recommend"){
    $recomm=$_GET["recommending"];
  }else{
    $recomm=null;
  }
  $query="insert into feedback values(null,'$canName','$user','$sec_reviewer','$action','$comment','$recomm')";
  $result=mysqli_query($connection,$query);
}
?>

<!-- print the candidate details -->
<section class="profile container">
  <div class="row"><a type="button" href="member.php"class="btn btn-primary"><i class="fa fa-chevron-left ml-1 pull-left"></i> </a></div>
  <br>
<form action="candidate.php" method="get">

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


        </div>
      </div>

      <div class="row">
    <div class="col-sm-8 jumbotron">

      <div class="row">
          <!--Blue select-->
        <div class="col-sm-4">
          <!-- <label class="card-title text-muted" >Review: </label> -->
           <div class="selector" id="selector">
            <select class="mdb-select select-picker" id="action" name="action" >
                <option value="" disabled selected>Action</option>
                <option value="select" onclick="myFunction2()">Select</option>
                <option value="recommend" onclick="myFunction1()">Recommend</option>
                <option value="reject" onclick="myFunction2()">Reject</option>
                <option value="decide later" onclick="myFunction2()">Decide Later </option>

            </select>
          </div>
        </div>
        <!-- <div class="col-sm-2"><button class="btn-success" onclick="myFunction()">go</button></div> -->
        <div class="col-sm-4" id="myDIV" style="visibility:hidden;">
          <!-- <label class="card-title text-muted" >Recommend To: </label> -->
          <div class="selector" id="selector">
            <select class="mdb-select select-picker" name="recommending">
              <option disabled selected>forward to</option>
              <?php  $query="select * from users where username !='$user'";
              $select_rows=mysqli_query($connection,$query);
              while($row=mysqli_fetch_assoc($select_rows)){
                echo "<option value=".$row['username'].">".$row['username']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
    </div>
    <br><br>


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

                <hr>
                <div class="d-flex justify-content-center">
                  <!-- <input type="submit"  name="submit" class="btn btn-primary mb-lg-auto" value="Submit"> -->
                  <input type="submit" id="submit" name="submit" class="btn btn-primary mb-lg-auto" value="submit">
                </div>
  </form>

        <!-- </div> -->
      <!--submit button  -->

  </div>

  <!-- test scores  -->
  <div class="col-sm-4">


 <div class=" card score_card score_card comment_card">
   <div class="card-header blue text-center font-weight-bold">Previous Remark</div>
   <ul class="list-group list-group-flush">
     <?php
           $q="select * from feedback where candidate_name='$canName'";
           $s=mysqli_query($connection,$q);
           $row=mysqli_fetch_assoc($s);
           while($row=mysqli_fetch_assoc($s)){
             echo "<li class='list-group-item'><p class='pull-left'>".$row["comments"]."</p><small class='text-muted pull-right'>".$row["reviewer1"]."</small></li>";
           }
     ?>
   </ul>
 </div>
  <!-- test scores  -->
</div>
</section>




<!-- Central Modal Medium Success -->
<div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Modal Success</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="white-text">&times;</span>
                                        </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit iusto nulla aperiam
                        blanditiis ad consequatur in dolores culpa, dignissimos, eius non possimus fugiat.
                        Esse ratione fuga, enim, ab officiis totam.</p>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-primary">Get it now <i class="fa fa-diamond ml-1"></i></a>
                <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">No, thanks</a>
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
function myFunction1(){
  var x = document.getElementById('myDIV');
  x.style.visibility="visible";
}
function myFunction2(){
  var x = document.getElementById('myDIV');
  x.style.visibility="hidden";
}
</script>
<!-- jquery scripts  -->
<?php require_once './local_resources/components/footer.php';?>
