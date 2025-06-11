<?php echo $htmlHeader; ?>
	<?php echo $headerBar ?>

	<div id="content-first" class="service-area section-padding">
		<div class="container">
			<div class="section-title text-center">
				<div class="title-border">
					<h1>Cek Status</h1>
				</div>
			</div>
			<div class="sheight-container">
				<div class="col-sm-4">
					<div class="sheight-img">
						<img src="<?php echo $asset->getAssetForAdmin('images/booking.png') ?>" alt="" style="width:200px;">
					</div>
				</div>
				<?php if ($transaksiDomain == NULL): ?>
				<div class="col-sm-8">
					<div class="sheight-content">
						<?php if ($sessionMessage != NULL): ?>
							<div class="row">
								<div class="col-md-10">
									<div class="alert alert-danger" role="alert">
									  <?php echo $sessionMessage['message'];?>
									</div>
								</div>
							</div>
						<?php endif ?>
						<form method="POST">
						<div class="row">
							<div class="col-md-4">
							  <div class="form-group <?php echo $validationErrorsRenderer->renderToAdminHtml('codeBook') == '' ? '' : 'has-error' ?>">
									<label for="input-nama-kontak"><i class="text-danger">*</i> Kode Book :</label>
									<input type="text" class="form-control" id="input-nama-kontak" name="codeBook" placeholder="Kode book tour" value="<?php echo set_value('codeBook');?>">
									<?php echo $validationErrorsRenderer->renderToAdminHtml('codeBook') ?>
							  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-group <?php echo $validationErrorsRenderer->renderToAdminHtml('email') == '' ? '' : 'has-error' ?>">
									<label for="input-nama-kontak"><i class="text-danger">*</i> Email :</label>
									<input type="text" class="form-control" id="input-nama-kontak" name="email" placeholder="Email Pemesan" value="<?php echo set_value('email');?>">
									<?php echo $validationErrorsRenderer->renderToAdminHtml('email') ?>
							  </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10 text-right">
								<div class="form-group">
									<button type="submit" name="process" value="cek" class="btn btn-md btn-warning">Cek!</button>
								</div>
							</div>
						</div>
						<form>
					</div>
				</div>
				<?php else: ?>
				<div class="col-sm-8">
					<div class="sheight-content">
						<div class="col-xs-12 col-sm-6 col-md-12">
									<div class="form-container red margin-bot-20">
										<div class="booking-status">
											<div class="row">
												<div class="col-xs-8">
													<small>Status:</small>
													<h1 class="white-color uppercase bolder">BOOKED</h1>
												</div>
												<div class="col-xs-4 text-right">
													&nbsp;
												</div>
											</div>
										</div>
										<div class="booking-status">
											<small><i class="fa fa-clock-o fa-fw"></i> Time Limit:</small>
											<h2 class="white-color">02-September-2018 &nbsp; 11:36 WIB</h2>
										</div>
										<div class="booking-status">
											<div class="row">
												<div class="col-xs-6">
													<small><i class="fa fa-barcode fa-fw"></i> Booking Pergi:</small>
													<h2 class="white-color">OIIUPQ</h2>
												</div>
																							</div>
										</div>
										<div class="clearfix">
											<a href="#bookFlightData" class="button btn-medium full-width white popupboxFlightData"><em class="bold">Data Penerbangan</em></a>
										</div>
									</div>
								</div>
					</div>
				</div>
				<?php endif ?>
			</div>
		</div>
	</div>

	<?php echo $footerBar; ?>
	<?php echo $messageSession ?>
<?php echo $htmlFooter; ?>