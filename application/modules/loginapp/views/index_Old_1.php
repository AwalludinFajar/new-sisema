<form novalidate="novalidate" id="bb" name="bb" accept-charset="utf-8" method="post" action="">
	<?php if (isset($pesan)) { ?><hr><div class="alert alert-danger alert-dismissable"><?php echo $pesan; ?></div><?php } ?>
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">						
	<div class="panel panel-body login-form">
		<div class="text-center">
			<div class="icon-object border-warning-400 text-warning-400"><i class="icon-people"></i></div>
			<h5 class="content-group-lg">Login Akun ULA & Unit Kerja<small class="display-block">Enter your credentials</small></h5>
		</div>
		
		<div class="form-group has-feedback has-feedback-left">
			<input type="text" data-rule-required="true" data-rule-email="false" placeholder="Username" id="username" class="form-control" name="username" value="<?php if(!empty($username)){ echo $username;} ?>">
			<span class="required-server"><?php echo form_error('username','<p style="color:#F83A18">','</p>'); ?></span>
			<div class="form-control-feedback">
				<i class="icon-user text-muted"></i>
			</div>
		</div>
		
		<div class="form-group has-feedback has-feedback-left">
			<input type="password" data-rule-required="true" name="user_password" id="user_password" placeholder="Password" class="form-control" value="<?php if(!empty($user_password)){ echo $user_password;} ?>">
			<span class="required-server"><?php echo form_error('user_password','<p style="color:#F83A18">','</p>'); ?></span>
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
		</div>
		
		<div class="form-group has-feedback has-feedback-left">
			<?php echo $captcha['image']; ?>
		</div>
		
		<div class="form-group has-feedback has-feedback-left">
			<input type="text" data-rule-maxlength="6" data-rule-required="true" data-rule-number="true" autocomplete="off" name="userCaptcha" class="form-control" placeholder="Masukan Kode" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
			
			<span class="required-server"><?php echo form_error('userCaptcha','<p style="color:#F83A18">','</p>'); ?></span> 
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
		</div>
		
		<div class="form-group">
			<button name="submitlogin" type="submit" class="btn bg-blue btn-block">Login <i class="icon-circle-right2 position-right"></i></button>
		</div>
	</div>
</form>
<div class="container-fluid">
<div class="row-fluid">
	<div class="span3"></div>
	<div class="span6">
		<div class="box">
		<div class="box-content">
			<div class="box box-color box-bordered">
				<div class="box-title">
					<h3><i class="icon-user"></i>Login Akun ULA & Unit Kerja</h3>
				</div>            
				<div class="box-content">
					<form novalidate="novalidate" class="form-horizontal form-validate" id="bb" name="bb" accept-charset="utf-8" method="post" action="">	
						<?php if (isset($pesan)) { ?><hr><div class="alert alert-danger alert-dismissable"><?php echo $pesan; ?></div><?php } ?>								
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">						
						<div class="control-group">
							<label for="textfield" class="control-label">NIP</label>
							<div class="controls">
								<input type="text" data-rule-required="true" data-rule-email="false" placeholder="" id="username" class="input-xlarge" name="username" value="<?php if(!empty($username)){ echo $username;} ?>">
								<span class="required-server"><?php echo form_error('username','<p style="color:#F83A18">','</p>'); ?></span>
							</div>
						</div>
						<div class="control-group">
							<label for="password" class="control-label">Password</label>
							<div class="controls">
								<input type="password" data-rule-required="true" name="user_password" id="user_password" placeholder="" class="input-xlarge" value="<?php if(!empty($user_password)){ echo $user_password;} ?>">
								<span class="required-server"><?php echo form_error('user_password','<p style="color:#F83A18">','</p>'); ?></span>
							</div>
						</div>
						<div class="control-group">
							<label for="password" class="control-label">Masukan Kode</label>
							<div class="controls">
							<input type="text" data-rule-maxlength="6" data-rule-required="true" data-rule-number="true" autocomplete="off" name="userCaptcha" class="input-small" placeholder="" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
							<?php echo $captcha['image']; ?>
							<span class="required-server"><?php echo form_error('userCaptcha','<p style="color:#F83A18">','</p>'); ?></span> 
							</div>
						</div>
						<button name="submitlogin" type="submit" class="btn btn-primary"><i class="icon-check"></i>&nbsp;LOGIN</button>
					</form>
				</div>       
			</div>
		</div>
		</div>
	</div>
</div>				
</div>