<form novalidate="novalidate" id="bb" name="bb" accept-charset="utf-8" method="post" action="">
	<div class="panel panel-body login-form">
		<div class="text-center">
			<div>
			<?php //echo $ListLogo[0]["logo"] == ""?'<img width="30%" height="30%" src="'.base_url().'uploads/profil_app/no_image.png" alt="Logo"></a>':'<img width="30%" height="30%" src="'.base_url().'uploads/profil_app/'.$ListLogo[0]["logo"].'" alt="Logo"></a>'; ?>
			</div>
			<h5 class="content-group-lg">LOGIN</h5>
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
			<?php //echo $captcha['image']; ?>
		</div>

		<!--<div class="form-group has-feedback has-feedback-left">
			<input type="text" data-rule-maxlength="6" data-rule-required="true" data-rule-number="true" autocomplete="off" name="userCaptcha" class="form-control" placeholder="Masukan Kode" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />

			<span class="required-server"><?php //echo form_error('userCaptcha','<p style="color:#F83A18">','</p>'); ?></span>
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
		</div>-->

		<div class="form-group">
			<button name="submitlogin" type="submit" class="btn bg-blue btn-block">Login <i class="icon-circle-right2 position-right"></i></button>
		</div>
		<?php if (isset($pesan)) { ?><div class="alert alert-danger alert-dismissable"><?php echo $pesan; ?></div><?php } ?>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	</div>
</form>
