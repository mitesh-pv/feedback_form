
<!-- modal form  -->
<div class="modal fade" id="signupform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form  action="index.php" method="post">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <img src="./local_resources/components/img/custom_images/title.jpg" alt="decoders_logo" class="scr" id="logo" style="width: 30%; height:%; border-radius:10px cursor: pointer;" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h4 class="text-center text-muted modal-title w-100 font-weight-bold">Sign up</h4>
            <hr>

            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <input type="text" id="username" class="form-control validate" name="username">
                    <label data-error="wrong" data-success="right" for="username">Enter Username</label>
                </div>
                <div class="md-form mb-4">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" id="password" class="form-control validate" name="password">
                    <label data-error="wrong" data-success="right" for="password">Enter Password</label>
                </div>
                <br>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary" name="signup">Sign up</button>
            </div>
        </div>
    </div>
  </form>
</div>
<!-- modal form  -->
