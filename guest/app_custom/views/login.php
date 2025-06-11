<?php echo $htmlHeader; ?>
<section>
	<div class="loginmain">
		<div class="loginCard">
			<div class="wrapper">
				<form role="form" action="" method="post" autocomplete="off" id="login" tabindex="500">
					<img src="asset/img/indihome_logo_color_medium.png" style="width: 50%; height: 15%">
					<br>
					<br>
					<h3 class="color-primary">Login Admin</h3>
					<div class="mail <?php echo $validationErrorsRenderer->renderToAdminHtml('login_username') == '' ? '' : 'has-error'; ?>">
						<input type="text" placeholder="Enter KContact" autofocus name="login_username">
						<label>KContact</label>
						<?php echo $validationErrorsRenderer->renderToAdminHtml('login_username') ?>
					</div>
					<div class="passwd <?php echo $validationErrorsRenderer->renderToAdminHtml('login_password') == '' ? '' : 'has-error'; ?>">
						<input type="password" placeholder="Enter Password" name="login_password">
						<label>Password</label>
						<?php echo $validationErrorsRenderer->renderToAdminHtml('login_password') ?>
					</div>
					<div class="text-right p-t-8 p-b-31">
						<a href="<?php echo $urlBuilder->build('register')?>">Belum Punya Akun?</a>
					</div>
					<div class="submit">
						<button type="submit" class="dark" name="process" value="loginAdmin">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</section>
</body>
    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>