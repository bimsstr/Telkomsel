<?php echo $htmlHeader; ?>
	<?php echo $headerBar ?>
    <!--contact us section end-->
    <div class="shape-img subscribe-wrap">
        <img src="asset/images/footer-top-shape.png" alt="footer shape" class="img-fluid">
    </div>
</div>
    <!-- =========== Start of Hero ============ -->
    <section>
        <div class="video-section-wrap">
            <div class="background-video-overly ptb-100">
                <?php if (count($hometitleDomainArray) == 0) : ?> 
                    <p> tidak ada data </p>
                <?php endif; ?>
                <?php foreach($hometitleDomainArray as $hometitleDomain) :?>
                <div class="player"
                     data-property="{videoURL:'<?php echo $hometitleDomain->getVideoURL(); ?>',containment:'.video-section-wrap', quality:'highres', autoPlay:true, showControls: false, startAt:0, mute:true, opacity: 1}"></div>
                     <?php endforeach;?>
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-8 col-lg-7">
                            <div class="hero-content-left text-white text-center mt-5 ptb-100">
                                <?php if (count($hometitleDomainArray) == 0) : ?> 
                                    <p> tidak ada data </p>
                                <?php endif; ?>
                                <?php foreach($hometitleDomainArray as $hometitleDomain) :?>
                                    <img src="<?php echo $asset->getAssetForAdmin('images/hometitle/image_title/'.$hometitleDomain->getImageTitle()) ?>" alt="<?php echo $hometitleDomain->getImageTitle()?>" alt="hero bg" class="svg">
                                    <br>
                                    <br>
                                    <p class="lead"><?php echo $hometitleDomain->getSubtitle(); ?> </p>
                                <?php endforeach;?>
                                <a href="<?php echo $urlBuilder->build('paket-indihome-jogja')?>" class="btn google-play-btn">DAFTAR SEKARANG!</a>
                            </div>
                        </div>
                    </div>

                    <!--clients logo start-->
                    <div class="row justify-content-between text-center">
                        <div class="col-md-10">
                            <div class="client-section-wrap d-flex flex-row align-items-center">
                                <p class="lead mr-3 mb-0 text-white">Provided by : </p>
                                <ul class="list-inline justify-content-between">
                                    <li class="list-inline-item"><img src="<?php echo $asset->getAssetForAdmin('images/new_indihome/telkom_ver_white.png') ?>"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--clients logo end-->
                </div>
            </div>
        </div>
    </section>
    <!--hero section end-->

    <!--promo section start-->
    <section class="promo-section ptb-100" id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-8">
                    <div class="section-heading text-center mb-5">
                        <?php if (count($homeaboutDomainArray) == 0) : ?>
                                tidak ada data
                            <?php endif; ?>
                        <?php foreach($homeaboutDomainArray as $homeaboutDomain) :?>
                            <h2 class="section-heading"><span><?php echo $homeaboutDomain->getBigQuotation(); ?></span></h2>
                            <p>
                                <?php echo $homeaboutDomain->getBigAbout(); ?>
                            </p>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <div class="row equal">
                <?php if (count($homeaboutDomainArray) == 0) : ?>
                        tidak ada data
                    <?php endif; ?>
                    <?php foreach($homeaboutdetailDomainArray as $homeaboutdetailDomain) :?>
                <div class="col-md-4 col-lg-4">
                    <div class="single-promo single-promo-hover single-promo-1 rounded text-center white-bg p-5 h-100">
                        <div class="circle-icon mb-1">
                            <img  src="<?php echo $asset->getAssetForAdmin('images/card_image/thumbs/'.$homeaboutdetailDomain->getCardImage()) ?>" alt="<?php echo $homeaboutdetailDomain->getCardImage()?>">
                        </div>
                        <h6><?php echo $homeaboutdetailDomain->getCardTitle(); ?></h6>
                        <p class="section-heading lead mb-1" style="color: red"><?php echo $homeaboutdetailDomain->getCardSubtitle(); ?></p>
                        <p><?php echo $homeaboutdetailDomain->getCardDescription();?></p>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>

    <!--our pricing packages section start-->
    <section id="pricing" class="package-section ptb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <?php if (count($homepackageDomainArray) == 0) : ?>
                                <?php echo '<h6>tidak ada data</h6>'?>
                    <?php endif; ?>
                    <?php foreach($homepackageDomainArray as $homepackageDomain ) :?>
                    <div class="section-heading text-center mb-5">
                        <h2 class="color-primary"><?php echo $homepackageDomain->getTitle(); ?></h2>
                        <p class="lead"><?php echo $homepackageDomain->getSubTitle(); ?></p>
                    </div>
                <?php endforeach;?>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php if (count($homepackagedetailDomainArray) == 0) : ?>
                    <?php echo '<h6>tidak ada data</h6>'?>
                <?php endif; ?>
                <?php foreach($homepackagedetailDomainArray as $namaPaket => $homepackageListDomain) :?>
                <div class="col-lg-4 col-md">
                    <div class="card text-center single-pricing-pack">
                        <?php foreach($homepackageListDomain as $homepackagedetailDomain) : ?>
                        <div class="pt-4"><span class="custom-nav-badge badge badge-danger badge-pill"><?php echo$homepackagedetailDomain->getPackageKeterangan();?></span><br><br><h5><?php echo $namaPaket;?></h5></div>
                        <div class="pricing-img mt-4">
                            <img src="<?php echo $asset->getAssetForAdmin('images/package/'.$homepackagedetailDomain->getPackageImage()) ?>" class="img-fluid">
                        </div>
                        <div class="card-header py-4 border-0 pricing-header">
                            <div class="h1 text-center mb-0" style="color:red">Rp<span class="price font-weight-bolder"><?php echo number_format($homepackagedetailDomain->getPackagePrice());?></span></div>
                        </div>
                        
                        <form method="POST" action="" autocomplete="OFF" class="form-horizontal" enctype="multipart/form-data">
                        <div class="card-body">
                            <ul class="list-unstyled text-sm mb-4 pricing-feature-list">
                                <?php if (count($homepackagedetailDomainArray) == 0) : ?>
                                        <?php echo '<h6>tidak ada data</h6>'?>
                                <?php endif; ?>
                                <?php foreach($homepackageListDomain as $homepackagedetailDomain)  :?>
                                <?php $packageDescription = $homepackagedetailDomain->getPackageDescription();
                                    $listPackage = explode(PHP_EOL, $packageDescription);?>
                                <?php endforeach;?>
                                <?php foreach($listPackage as $val): ?>
                                    <h6 class="mb-3 color-light-secondary-2"><?php echo $val; ?></h6>
                                <?php endforeach; ?>
                            </ul>   
                            <a href="<?php echo $urlBuilder->build('pilih-sales', 'paket='.$namaPaket, TRUE) ?>" class="btn outline-btn mb-3">DAFTAR SEKARANG</a>
                        </div>
                        </form>
                    </div>
                </div>
                <?php endforeach;?>
                <?php endforeach;?>
            </div>
            <div class="mt-5 text-center">
                <p class="mb-2">Mau paket Indihome yang lain dan lebih menarik ? <a href="<?php echo $urlBuilder->build('paket-indihome-jogja')?>#" class="color-secondary">
                    Yuk!
                </a></p>
            </div>
        </div>
    </section>
    <!--our pricing packages section end--> 

    <!--our team section start-->
    <section id="team" class="team-member-section gray-light-bg" style="padding-top: 60px; padding-bottom: 60px;">
        <div class="container">
            <div class="row justify-content">
                <div class="col-lg-12 col-md-5">
                    <div class="section-heading text-center">
                        <?php if (count($salesTitleDomainArray) == 0) : ?>
                            <?php echo "tidak ada data";?>
                        <?php endif; ?>
                        <?php foreach($salesTitleDomainArray as $salesTitleDomain) :?>
                        <h2 class="color-primary"><?php echo $salesTitleDomain->getTitle(); ?></h2>
                        <p class="lead">
                           Klik di sini untuk melihat daftar Sales terbaik Indihome Jogja<a href="<?php echo $urlBuilder->build('sales')?>" class="color-secondary">
                    Yuk!</a>
                        </p>
                        <?php endforeach;?> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--our team section end-->
    <!--download section start-->
    <?php if (count($homefindusDomainArray) == 0) : ?>
    <?php echo "tidak ada data"?>
    <?php endif; ?>
    <?php foreach($homefindusDomainArray as $homefindusDomain) :?>
    <section class="download-section pt-100 background-img" 
             style="background: url(<?php echo "asset/images/find_us/bg/".$homefindusDomain->getImageBackground();?>)no-repeat center center / cover">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-7">
                    <div class="download-content text-white pb-100">
             
                        <h2 class="text-white"><?php echo $homefindusDomain->getTitle(); ?></h2>
                        <p class="lead"><?php echo $homefindusDomain->getDescription(); ?></p>
                        <div class="download-btn">
                            <a href="#" >
                                <?php if($homefindusDomain->getAppStore() == 'active'){
                                            echo '<img src="asset/images/mobile/app-store-md.png" class="rounded-md" alt="app-store-md.png">';}?>
                            </a>
                            <a href="#" >
                                <?php if($homefindusDomain->getPlayStore() == 'active'){
                                            echo '<img src="asset/images/mobile/google-play-md.png" class="rounded-md" alt="google-play-md.png">';}?>
                            </a>
                        </div>
                      
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="download-img d-flex align-items-end">
                        <img src="<?php echo $asset->getAssetForAdmin('images/find_us/'.$homefindusDomain->getImage()) ?>" alt="download" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endforeach;?>  
    <!--download section end-->



    <!--client section start-->
    <section class="client-section ptb-100" id="addon">
        <div class="container">
            <!--clients logo start-->
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-12">
                    <div class="section-heading text-center mb-5">
                        <h2 class="color-primary">SPECIAL ADD-ON</h2>
                        <p class="lead" style="font-size: 16px">
                            Berlangganan IndiHome dapatkan internet broadband, nelpon rumah sepuasnya dan nonton beragam konten terbaik di layar TV interaktif
                        </p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme clients-carousel dot-indicator">
                        <?php if (count($homepartnerDomainArray) == 0) : ?>
                            <?php echo "<p> tidak ada data </p"?>
                        <?php endif; ?>
                        <?php foreach($homepartnerDomainArray as $homepartnerDomain) :?>
                        <div class="item single-client">
                            <img src="<?php echo $asset->getAssetForAdmin('images/partner/'.$homepartnerDomain->getImage()) ?>" alt="<?php echo $homepartnerDomain->getImage()?>" alt="client logo" class="client-img">
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <!--clients logo end-->
        </div>
    </section>
    <!--client section start-->

<div class="shape-img subscribe-wrap">
    <img src="asset/images/footer-top-shape.png" alt="footer shape" class="img-fluid">
</div>
        <!-- =========== End of CTA ============ -->
    <?php echo $footerBar; ?>           
    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>
