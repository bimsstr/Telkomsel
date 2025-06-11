<?php echo $htmlHeader; ?>

    <div class="login-header text-center">
			<img src="<?php echo $asset->get('img/tiketturindo-white.png'); ?>" class="logo" alt="krevatif">
		</div>
		<div class="login-wrapper">
			<h1 class="error-number">4<i class="fa fa-meh-o icon-xl icon-square"></i>4</h1>
			<h3 style="text-align:center"><strong>Maaf!</strong><br />Anda nyasar nih.</h3>
			<p class="text-center"><strong><a href="<?php echo $urlBuilder->build('dashboard') ?>">kembali</a></strong></p>
		</div>

<?php echo $htmlFooter; ?>