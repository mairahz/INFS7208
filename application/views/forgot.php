<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Verification</title>
    <?php $this->load->view('scripts'); ?>
  </head>
  <body>

  <?php $this->load->view('navbar'); ?>

  <div class="container-fluid" style="margin-top:40px">
    <div class="row">
      <?php $this->load->view('sidebar'); ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Verify account information</h1>
        </div>

        <div class="container-fluid">
          <!-- Error Alert Box -->
          <div id="form1_box" class="alert hidden" role="alert"></div>

          <!-- Change Password Form -->
          <form id="passForm">
            <input type="hidden" value="<?=$username?>" name="username" />
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="passconf">Confirm Password</label>
              <input type="password" class="form-control" name="passconf" id="passconf" placeholder="Confirm Password">
            </div>
            <button type="button" id="sendPass" class="btn btn-info">Submit</button>
          </form>

          <!-- Secret Question Form -->
          <form id="form1">
            <input type="hidden" value="<?=$username?>" name="username" />
            <?php $i=1 ?>
            <?php foreach ($qns as $qn): ?>
              <input type="hidden" value="<?=$qn['question']?>" name="qn<?=$i?>" />
              <div class="col" style="padding-bottom:30px">
                <p><strong>Security question: </strong><?php echo $qn['question'] ?> </p>
                <label for="forgotUser" class="sr-only">Answer: </label>
                <input type="text" id="ans<?=$i?>" name="ans<?=$i?>" class="form-control" placeholder="Answer" required="">
              </div>
              <?php $i = $i + 1 ?>
            <?php endforeach; ?>

            <button type="button" id="sendform1" class="btn btn-info">Submit</button>
          </form>
        </div>
        <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="2304" height="972" style="display: block; height: 486px; width: 1152px;"></canvas>
      </main>  

		<script>
      $( document ).ready(function() {
        $("#passForm").hide();
      });

      // Send answers to backend
      $("#sendform1").click(function () {
        $.post('<?= site_url('Users/verifyQns') ?>', $('#form1').serialize(), function (data) {
          data = JSON.parse(data);
            if (data.code === 1)
            {
                $("#form1_box").removeClass('alert-success').addClass('alert-danger').removeClass('hidden').html(data.msg);
            } else {
                $("#form1_box").removeClass('alert-danger').addClass('alert-success').removeClass('hidden').html(data.msg);
                $("#form1").hide();
                $("#passForm").show();
            }
        });
      });

      // Send Change password form
      $("#sendPass").click(function () {
        $.post('<?= site_url('Users/changePass') ?>', $('#passForm').serialize(), function (data) {
          data = JSON.parse(data);
            if (data.code === 1)
            {
                $("#form1_box").removeClass('alert-success').addClass('alert-danger').removeClass('hidden').html(data.msg);
            } else {
                $("#form1_box").removeClass('alert-danger').addClass('alert-success').removeClass('hidden').html(data.msg);
                setTimeout(function(){window.location.replace("<?php echo base_url();?>index.php/Login/login"); }, 3000);
            }
        });
      });
		</script>  
  </body>
</html>