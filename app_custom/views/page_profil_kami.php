<?php echo $htmlHeader; ?>
<?php echo $headerBar ?>
<!-- =========== Start of Hero ============ -->
<?php if (count($homeprofilkamititleDomainArray) == 0) : ?>
		<p>tidak ada data</p>
<?php endif; ?>
<?php foreach($homeprofilkamititleDomainArray as $homeprofilkamititleDomain) :?>
<section class="hero-section ptb-100 background-img"
             style="background: url('asset/images/profil_kami/<?php echo $homeprofilkamititleDomain->getImage()?>')no-repeat center center / cover">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                	<?php if (count($homeprofilkamititleDomainArray) == 0) : ?>
						<?php echo "tidak ada data";?>
					<?php endif;?>
					<?php foreach($homeprofilkamititleDomainArray as $homeprofilkamititleDomain) :?>
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <h1 class="text-white mb-0"><?php echo $homeprofilkamititleDomain->getTitle();?></h1>
                        <p><?php echo $homeprofilkamititleDomain->getSubtitle();?></p>
                    </div>
               		<?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->
   <?php endforeach; ?>

    <!--blog section start-->
    <div class="module ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <!-- Post-->
                    <article class="post">
                    	<?php if (count($homeprofilkamiDomainArray) == 0) : ?>
										<p>tidak ada data</p>
						<?php endif; ?>
						<?php foreach($homeprofilkamiDomainArray as $homeprofilkamiDomain) :?>
                        <div class="post-wrapper">
                            <div class="post-header">
                                <h5 class="mb-30">Profil <span style="color: red"> Kami </span>
                            </div>
                            <div class="post-content">
                                <p><?php echo $homeprofilkamiDomain->getDescription();?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </article>
                    <!-- Post end-->

                    <!-- Comments area-->
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="sidebar-right pl-4">
                        <!-- Categories widget-->

                        <aside class="widget widget-categories">
                            <div class="widget-title">
                                <h6 class="mb-10" style="color: red">Tautan Terkait</h6>
                            </div>
                            <ul>
                            	<a href="<?php echo $urlBuilder->build('sales')?>"><h6 style="font-size: 14px">Tim Sales Indihome Jogja</h6></a>
								<hr>
								<a href="<?php echo $urlBuilder->build('syarat-ketentuan')?>"><h6 style="font-size: 14px">Syarat dan Ketentuan</h6></a>
								<hr>
								<a href="<?php echo $urlBuilder->build('kebijakan-privasi')?>"><h6 style="font-size: 14px">Kebijakan Privasi</h6></a>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--blog section end-->
</div>
<div class="shape-img subscribe-wrap">
    <img src="asset/images/footer-top-shape.png" alt="footer shape" class="img-fluid">
</div>
		<?php echo $footerBar; ?>
		<?php echo $messageSession ?>
		<?php echo $htmlFooter; ?>