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

// connect database
databaseConnection();

// get the selected candidate details
$candidateArray=candidateConnection($canName);
?>


<section class="profile container">
  <div class="row">
  <div class="jumbotron col-sm-8 ">
    <div class="card-title">
      <h3 class="text-center text-muted">Candidate profile</h3>
      <hr>
    </div>
    <div class="card-text">
        <table>
            <tr>
              <td><h4  class="font-weight-bold text-muted">USN :</h4></td>
              <td><h4 ><?php echo $candidateArray['usn'];?>1SI15CS059</h4></td>
            </tr>
            <tr>
              <td><h4  class="font-weight-bold text-muted">Year :</h4></td>
              <td><h4 ><?php echo $candidateArray['usn'];?>2nd Year</h4></td>
            </tr>
            <tr>
              <td><h4  class="font-weight-bold text-muted">Branch :</h4></td>
              <td><h4 ><?php echo $candidateArray['usn'];?>CSE</h4></td>
            </tr>
            <tr>
              <td><h4  class="font-weight-bold text-muted">CGPA :</h4></td>
              <td><h4 ><?php echo $candidateArray['usn'];?>9.40</h4></td>
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
              <img src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(147).jpg" class="img-fluid" alt="">
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
              <h5 class="text-primary "><span class="text-muted">&#9993;</span><?php echo $candidateArray['email'];?> mitesh.vishwakarma@gmail.com</h5>
              <!--Text-->
              <p class="card-text"></p>
              <a class="btn btn-primary waves-effect waves-light">Download Resume</a>
          </div>
          <!--/.Card content-->
      </div>
      <!-- Card -->
  </div>
</div>

<!--Blue select-->
<hr class="row" style="width: 69%;">
<!-- <label class="" >lReview: </label> -->
<div class="selector">
  <select class="row mdb-select colorful-select dropdown-primary">
    <option value="1" id="sel">selected</option>
    <option value="2" id="rec">recommend</option>
    <option value="3" id="rej">reject</option>
  </select>
</div>
<hr class="row" style="width: 69%;">
<!--/Blue select-->

<div class="row">
  <div class=" row form-group shadow-textarea col-sm-8">
      <label for="comment" class="text-muted">Remark</label>
      <textarea class="form-control z-depth-1" id="comment" rows="3" placeholder="Write something here..." style="height: 100%;" aria-expanded=false></textarea>
  </div>
</div>
<br><hr class="row" style="width: 69%;">

<select class="mdb-select row">
    <option value="" disabled selected>second viewer</option>
    <?php ?>
</select>

<br><hr class="row" style="width: 69%;">

<div class="row">
  <input type="submit" name="submit" class="btn btn-primary mb-r" value="Submit">
</div>

</section>



<!-- jquery scripts  -->
<script>
// Material Select Initialization
$(document).ready(function() {
   $('.mdb-select').material_select();
});

</script>

<?php require_once './local_resources/components/footer.php';?>
