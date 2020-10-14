<!DOCTYPE html>
<html lang="en">
	<head>
  
    <title>Register</title>
    <!-- Custom styles for this template -->
		<?php $this->load->view('scripts'); ?>

		<script>
			// Refresh captcha
			$(document).ready(function(){
				$('.captcha-refresh').on('click', function(){
					$.get('<?= site_url('Users/refresh') ?>', function(data){
						$('#image_captcha').html(data);
					});
				});
			});
   </script>
	</head>

  <body>
		<?php $this->load->view('navbar'); ?>

		<div class="container-fluid" style="margin-top:40px">
			<div class="row">

				<?php $this->load->view('sidebar'); ?>
				
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2">Register New User</h1>
					</div>
					<div class="col" >
						<div id="form1_box" class="alert hidden" role="alert"></div>
						<form id="form1">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="username" class="form-control" name="username" id="username" placeholder="Username">
							</div>
							<div class="form-group">
								<label for="email">Email address</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="password">Password</label>
									<input type="password" class="form-control" name="password" id="password" placeholder="Password">
								</div>
								<div class="form-group col-md-6">
									<label for="passconf">Confirm Password</label>
									<input type="password" class="form-control" name="passconf" id="passconf" placeholder="Confirm Password">
								</div>
							</div>
							<div class="form-group">
								<label for="question1">Secret Question 1</label>
								<select class="form-control" name="question1" id="question1">
									<option value="What is the last name of the teacher who first gave you your first failing grade?">What is the last name of the teacher who first gave you your first failing grade?</option>
									<option value="What is the name of the person you first kissed?">What is the name of the person you first kissed?</option>
									<option value="What is the name of the place your wedding reception was held?">What is the name of the place your wedding reception was held?</option>
									<option value="What was the name of your elementary school?">What was the name of your elementary school?</option>
									<option value="In what city or town does your nearest sibling live?">In what city or town does your nearest sibling live?</option>
								</select>
							</div>
							<div class="form-group">
								<label for="ans1">Answer</label>
								<input type="text" class="form-control" name="ans1" id="ans1">
							</div>
							<div class="form-group">
								<label for="question2">Secret Question 2</label>
								<select class="form-control" name="question2" id="question2">
									<option value="What is the last name of the teacher who first gave you your first failing grade?">What is the last name of the teacher who first gave you your first failing grade?</option>
									<option value="What is the name of the person you first kissed?">What is the name of the person you first kissed?</option>
									<option value="What is the name of the place your wedding reception was held?">What is the name of the place your wedding reception was held?</option>
									<option value="What was the name of your elementary school?">What was the name of your elementary school?</option>
									<option value="In what city or town does your nearest sibling live?">In what city or town does your nearest sibling live?</option>
								</select>
							</div>
							<div class="form-group">
								<label for="ans2">Answer</label>
								<input type="text" class="form-control" name="ans2" id="ans2">
							</div>
							<div class="form-group">
								<label for="image_captcha">Captcha</label>
								<p id="image_captcha"><?=$captcha['image']?></p>
								<a href="javascript:void(0);" class="captcha-refresh" >
									<svg class="bi bi-arrow-repeat" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M2.854 7.146a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L2.5 8.207l1.646 1.647a.5.5 0 0 0 .708-.708l-2-2zm13-1a.5.5 0 0 0-.708 0L13.5 7.793l-1.646-1.647a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"/>
										<path fill-rule="evenodd" d="M8 3a4.995 4.995 0 0 0-4.192 2.273.5.5 0 0 1-.837-.546A6 6 0 0 1 14 8a.5.5 0 0 1-1.001 0 5 5 0 0 0-5-5zM2.5 7.5A.5.5 0 0 1 3 8a5 5 0 0 0 9.192 2.727.5.5 0 1 1 .837.546A6 6 0 0 1 2 8a.5.5 0 0 1 .501-.5z"/>
									</svg>
								</a>
								<input type="text" name="captcha" id="captcha" value=""/>
							</div>
							<div class="modal-footer">
								<button type="button" id="sendform1" class="btn btn-info">Register</button>
							</div>
						</form>
					</div>
					<canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="2304" height="972" style="display: block; height: 486px; width: 1152px;"></canvas>
				</main>
			</div>  
		</div>
		<script>
			// Sends register form and sends back any errors via AJAX
			$("#sendform1").click(function () {
				$.post('<?= site_url('Users/register') ?>', $('#form1').serialize(), function (data) {
					data = JSON.parse(data);
						if (data.code === 1)
						{
								$("#form1_box").removeClass('alert-success').addClass('alert-danger').removeClass('hidden').html(data.msg);
								$('#image_captcha').html(data.image);
								$('#captcha').val("");
						} else {
								$("#form1_box").removeClass('alert-danger').addClass('alert-success').removeClass('hidden').html(data.msg);
								setTimeout(function(){window.location.replace("<?php echo base_url();?>"); }, 3000);
						}
				});
			});
		</script>  
	</body>
</html>