<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Profile</title>
    <!-- Dropzone CSS & JS -->
    <link href='<?= base_url() ?>dropzone/dist/dropzone.css' type='text/css' rel='stylesheet'>
    <script src='<?= base_url() ?>dropzone/dist/dropzone.js' type='text/javascript'></script>
    
    <?php $this->load->view('scripts'); ?>
    <script type="text/javascript" src="/MeTube/scripts/activity.js"></script>
  </head>

  <?php if($this->session->userdata('logged_in')): ?>
    <body onload="set_interval()";
      onmousemove="reset_interval()";
      onclick="reset_interval()";
      onkeypress="reset_interval()";
      onscroll="reset_interval()";>
  <?php else: ?>
    <body>
  <?php endif;?>
    <?php $this->load->view('navbar'); ?>

    <div class="container-fluid" style="margin-top:40px">
      <div class="row">

        <?php $this->load->view('sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

            <h1 class="h2"><?=$userdata['username']?>'s Profile</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#editModal">Edit</button>
            </div>

          </div>

          <!-- Email Error Alert Box -->
          <?php if($error == ''): ?>
            <div id="email_box" class="alert hidden" role="alert"></div>
          <?php elseif($error == 'error' ): ?>
            <div id="email_box" class="alert-danger" style="padding:10px" role="alert">Sorry unable to verify your email</div>
          <?php else: ?>
            <div id="email_box" class="alert-success" style="padding:10px" role="alert">Email verified successfully!</div>
          <?php endif ?>

          <div class="col" style="padding:10px">
            <form>
              <img src="<?php echo base_url();?>uploads/<?=$userdata['dp']?>" width="220">
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label"><strong>Username</strong></label>
                <div class="col-sm-10">
                  <input type="text" id="email" readonly class="form-control-plaintext" value="<?=$userdata['username']?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label"><strong>Email</strong></label>
                <div class="col-sm-10">
                  <input type="text" id="email" readonly class="form-control-plaintext" value="<?=$userdata['email']?>">
                  <?php if($userdata['verified'] == 'N'): ?>
                    <span class="badge badge-danger">Unverified</span>
                    <a href="<?php echo base_url();?>index.php/Users/sendVerificationEmail">Click here to resend verification email</a>
                  <?php else: ?>
                    <span class="badge badge-success">Verified</span>
                  <?php endif ?>  
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label"><strong>Date of Birth</strong></label>
                <div class="col-sm-10">
                  <input type="text" id="email" readonly class="form-control-plaintext" value="<?=$userdata['birthdate']?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label"><strong>Gender</strong></label>
                <div class="col-sm-10">
                  <input type="text" id="email" readonly class="form-control-plaintext" value="<?=$userdata['gender']?>">
                </div>
              </div>
            </form>
          </div>

          <canvas class="my-4 chartjs-render-monitor" width="2304" height="972" style="display: block; height: 486px; width: 1152px;"></canvas>
        </main>

        <!-- Update Profile Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div class="modal-header">Update Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <?php echo form_open_multipart('Profile/dp_upload', 'class="dropzone"'); ?></form>
                <?php echo form_open('Profile/update'); ?>

                  <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="username" readonly class="form-control" name="username" id="username" value="<?=$userdata['username']?>">
                  </div>

                  <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" readonly class="form-control" name="email" id="email" value="<?=$userdata['email']?>">
                  </div>

                  <div class="form-group">
                    <label for="birthdate">Date of Birth:</label>
                    <input type="date" class="form-control" name="birthdate" id="birthdate" value="<?=$userdata['birthdate']?>">
                  </div>

                  <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" id="gender" name="gender">
                      <?php if ($userdata['gender'] == ""):?><option value=""></option><?php endif; ?>
                      <option <?php if ($userdata['gender'] == "M"){echo "selected";}?> value="M">Male</option>
                      <option <?php if ($userdata['gender'] == "F"){echo "selected";}?> value="F">Female</option>
                      <option <?php if ($userdata['gender'] == "O"){echo "selected";}?>  value="O">Other</option>
                    </select>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Update</button>
                  </div>

                </form> 
              </div>

            </div>
          </div>

      </div>
    </div>
  </body>
</html>