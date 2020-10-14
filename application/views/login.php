<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Login</title>
    <?php $this->load->view('scripts'); ?>
	</head>

  <body>
		<?php $this->load->view('navbar'); ?>

		<div class="container-fluid" style="margin-top:40px">
			<div class="row">

				<?php $this->load->view('sidebar'); ?>
				
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2">Login</h1>
					</div>

					<div class="col-md-4 text-center offset-md-4" >
						<?php echo form_open('Login/login'); ?>
							<img src="<?php echo base_url();?>/img/MeTube(Dark).png" alt="MeTube Logo" width="220">
							<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

							<!-- Alert for any errors in logging in -->
							<?php if($error != ''): ?>
								<div class="alert alert-danger" role="alert">
									<?=$error?>
								</div>
							<?php endif; ?>

							<label for="username" class="sr-only">Username</label>
							<input type="username" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="" value="<?php echo set_value('username', $username) ?>">
							<label for="inputPassword" class="sr-only">Password</label>
							<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="" value="<?php echo set_value('password', $password) ?>">
							<div class="checkbox col-mb-3">
								<label>
									<input type="checkbox" name="remember" value=1> Remember me
								</label>
								<a href="#" style="padding-left:50px" data-toggle="modal"data-target="#forgotModal">Forgot Password?</a>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-secondary btn-lg" onclick="window.location.href='<?php echo site_url('Users/registerForm');?>';">Register</button>
								<button type="submit" class="btn btn-info btn-lg">Sign in</button>
							</div>
							<!-- Facebook Login -->
							<div>
								<button type="button" style="margin-top:10px" id="fbLogin" class="btn btn-primary btn-lg" onclick="window.location.replace('<?= site_url('Login/fbLogin') ?>');">Login with Facebook</button>
							</div>
						</form>
					</div>
					
					<canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="2304" height="972" style="display: block; height: 486px; width: 1152px;"></canvas>
				</main>  
			</div>
		</div>

		<!-- Forgotton Password Modal -->
		<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="forgotModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="forgotModalLabel">Forgot Password</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php echo form_open('Users/forgot'); ?>
						<div class="modal-body">
							<label for="forgotUser" class="sr-only">Username</label>
							<input type="text" id="forgotUser" name="forgotUser" class="form-control" placeholder="Please enter your username" required="">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-info">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div> 
	</body>
</html>