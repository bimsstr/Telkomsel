<?php echo $htmlHeader; ?>
	<div class="loginmain">
		<div class="loginCard">
			<div class="wrapper">
				<form role="form" action="" method="post" autocomplete="off" id="login" tabindex="500">
					<img src="asset/img/indihome_logo_color_medium.png" style="width: 50%; height: 15%">
					<br>
					<br>
					<h3 class="color-primary">Register Sales</h3>
					<div>
						<input type="text" placeholder="Enter KContact" autofocus name="register_username">
						<label>KContact</label>
						<?php echo $validationErrorsRenderer->renderToAdminHtml('register_username') ?>
					</div>
					<div>
						<input type="password" placeholder="Enter Password" name="register_password">
						<label>Password</label>
						<?php echo $validationErrorsRenderer->renderToAdminHtml('register_password') ?>
					</div>
					<div>
						<input type="text" placeholder="Enter Nama Lengkap" autofocus name="register_name">
						<label>Nama Lengkap</label>
						<?php echo $validationErrorsRenderer->renderToAdminHtml('register_name') ?>
					</div>
					<div>
						<input type="text" placeholder="Enter No Hp" autofocus name="register_phone">
						<label>Nomor HP</label>
						<?php echo $validationErrorsRenderer->renderToAdminHtml('register_phone') ?>
					</div>
					<div class="text-right p-t-8 p-b-31">
						<a href="<?php echo $urlBuilder->build('login')?>">Sudah Punya Akun ?</a>
					</div>
					<div class="submit">
						<button type="submit" class="dark" name="process" value="regisAdmin">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div>
    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>