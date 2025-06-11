<?php echo $htmlHeader; ?>
        <section class="space h-lg-100vh d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row mb-40">
                    <div class="col-12 col-lg-6 mx-auto text-center">
                         <img src="<?php echo $asset->getAssetForAdmin('img/404page.png') ?>" alt="Error Image" alt="hero-image">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 mx-auto text-center">
                        <h1 class="color-primary h3-font mb-20">Halaman Tidak Ditemukan</h1>
                        <p>Oops! Sepertinya anda masuk melalui URL yang salah</p>
                        <p>Do you think this might be a mistake? <a href="#" class="btn-text-hover">Contact us</a></p>
                        <a href="index.html" class="btn btn--bg-primary btn-splash-hover btn-3d-hover mt-40"><i class="fa fa fa-long-arrow-left mr-20"></i><span class="btn__text">Go Back</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- =========== End of Body ============ -->
        <!--Partner Area Start-->
	    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>