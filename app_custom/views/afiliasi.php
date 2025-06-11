<?php echo $htmlHeader; ?>
       <!-- =========== Start of Navigation (main menu) ============ -->
 <header class="header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg fixed-top bg-transparent color-primary">
        <div class="container">
            <?php foreach($salesDomainArray as $adminDomain)  :?>
                <a class="navbar-brand" href="<?php echo $urlBuilder->build(''.$adminDomain->getUsername().'')?>">
                    <img src ="asset/images/new_indihome/indihome_logo_white.png" width="120px" alt="logo"></a>
            <?php endforeach;?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span style="color: white;"class="fa fa-align-justify"></span>
            </button>

            <div class="collapse navbar-collapse main-menu" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <?php foreach($salesDomainArray as $adminDomain)  :?>
                        <a class="nav-link page-scroll" href="<?php echo $urlBuilder->build(''.$adminDomain->getUsername().'')?>">Home</a>
                        <?php endforeach;?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="<?php echo $urlBuilder->build(''.$adminDomain->getUsername().'/paket')?>">Paket Indihome</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="https://www.indihome.co.id/addon" target="_blank">Add On</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="https://www.indihome.co.id/useetv" target="_blank">Usee TV</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--end navbar-->
</header>
        <!-- =========== End of Navigation (main menu)  ============ -->';

    <!--contact us section end-->
    <div class="shape-img subscribe-wrap">
        <img src="asset/images/footer-top-shape.png" alt="footer shape">
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
                        <div class="col-md-8 col-lg-9">
                            <div class="hero-content-left text-white text-center mt-5 ptb-100">
                                <?php if (count($hometitleDomainArray) == 0) : ?> 
                                    <p> tidak ada data </p>
                                <?php endif; ?>
                                <?php foreach($hometitleDomainArray as $hometitleDomain) :?>
                                    <img src="<?php echo $asset->getAssetForAdmin('images/hometitle/image_title/'.$hometitleDomain->getImageTitle()) ?>" alt="<?php echo $hometitleDomain->getImageTitle()?>" alt="hero bg" class="svg">
                                    <br>
                                    <br>
                                    <?php foreach($salesDomainArray as $adminDomain)  :?>
                                    <p class="lead">
                                        Halo, Selamat Datang di Indihome Yogyakarta. Perkenalkan saya <?php echo $adminDomain->getFullName(); ?>. Untuk informasi lebih lanjut dapat langsung menghubungi kontak di bawah ini.
                                    </p>   
                                    <?php  
                                        $nohp = $adminDomain->getphone();
                                            // kadang ada penulisan no hp 0811 239 345
                                            $nohp = str_replace(" ","",$nohp);
                                            
                                            // kadang ada penulisan no hp (0274) 778787
                                            $nohp = str_replace("(","",$nohp);
                                            
                                            // kadang ada penulisan no hp (0274) 778787
                                            $nohp = str_replace(")","",$nohp);
                                            
                                            // kadang ada penulisan no hp 0811.239.345
                                            $nohp = str_replace(".","",$nohp);

                                            // cek apakah no hp mengandung karakter + dan 0-9
                                            if(!preg_match('/[^+0-9]/',trim($nohp))){
                                                // cek apakah no hp karakter 1-3 adalah +62
                                                if(substr(trim($nohp), 0, 2)=='62'){
                                                    $hp = trim($nohp);
                                                }

                                            // cek apakah no hp karakter 1 adalah 0
                                                elseif(substr(trim($nohp), 0, 1)=='0'){
                                                    $hp = '62'.substr(trim($nohp), 1);
                                                }
                                            }
                                        ?>
                                <a href="https://wa.me/<?php echo $hp;?>?text=Halo%20Indihome%20Jogja.%20Saya%20ingin%20berlanggan%20Indihome%20Paket%20Yogyakarta%20.%20Apakah%20bisa%20dibantu%20untuk%20informasi%20lebih%20lanjut%20?" class="btn google-play-btn">HUBUNGI SEKARANG!</a>
                                <?php endforeach;?>
                                <?php endforeach;?>
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
            <div class="row justify-content">
                <?php if (count($homepackageafiliasiDataSource) == 0) : ?>
                    <?php foreach($homepackagedetailDomainArray as $namaPaket => $homepackageListDomain) :?>
                <div class="col-lg-4 col-md" style="padding-bottom: 100px">
                    <div class="card text-center single-pricing-pack">
                        <?php foreach($homepackageListDomain as $homepackagedetailDomain) : ?>
                        <div class="pt-4"><span class="custom-nav-badge badge badge-danger badge-pill"><?php echo$homepackagedetailDomain->getPackageKeterangan();?></span><br><br><h5><?php echo $namaPaket;?></h5></div>
                        <div class="pricing-img mt-4">
                            <img src="<?php echo $asset->getAssetForAdmin('images/package/'.$homepackagedetailDomain->getPackageImage()) ?>" class="img-fluid">
                        </div>
                        <div class="card-header py-4 border-0 pricing-header">
                            <div class="h1 text-center mb-0" style="color:red">Rp<span class="price font-weight-bolder"><?php echo number_format($homepackagedetailDomain->getPackagePrice());?></span></div>
                        </div>
                        <?php endforeach;?>
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
                            <?php if (count($salesDomainArray) == 0) : ?>
                                 <?php echo '<h6>tidak ada data</h6>'?>
                            <?php endif; ?>
                            <?php foreach($salesDomainArray as $adminDomain)  :?>
                            <?php  
                                        $nohp = $adminDomain->getphone();
                                            // kadang ada penulisan no hp 0811 239 345
                                            $nohp = str_replace(" ","",$nohp);
                                            
                                            // kadang ada penulisan no hp (0274) 778787
                                            $nohp = str_replace("(","",$nohp);
                                            
                                            // kadang ada penulisan no hp (0274) 778787
                                            $nohp = str_replace(")","",$nohp);
                                            
                                            // kadang ada penulisan no hp 0811.239.345
                                            $nohp = str_replace(".","",$nohp);

                                            // cek apakah no hp mengandung karakter + dan 0-9
                                            if(!preg_match('/[^+0-9]/',trim($nohp))){
                                                // cek apakah no hp karakter 1-3 adalah +62
                                                if(substr(trim($nohp), 0, 2)=='62'){
                                                    $hp = trim($nohp);
                                                }

                                            // cek apakah no hp karakter 1 adalah 0
                                                elseif(substr(trim($nohp), 0, 1)=='0'){
                                                    $hp = '62'.substr(trim($nohp), 1);
                                                }
                                            }
                                        ?>
                            <a href="https://wa.me/<?php echo $hp;?>?text=Halo%20Indihome%20Jogja.%20Saya%20ingin%20berlanggan%20Indihome%20Paket%20<?php echo $paket?>%20.%20Apakah%20bisa%20dibantu%20untuk%20informasi%20lebih%20lanjut%20?" class="btn outline-btn mb-3">DAFTAR SEKARANG</a>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <?php endif; ?>
                <?php foreach($homepackageafiliasiDataSource as $namaPaket => $homepackageListDomain) :?>
                <div class="col-lg-4 col-md" style="padding-bottom: 100px">
                    <div class="card text-center single-pricing-pack">
                        <?php foreach($homepackageListDomain as $homepackageafiliasiDomain) : ?>
                        <div class="pt-4"><span class="custom-nav-badge badge badge-danger badge-pill"><?php echo$homepackageafiliasiDomain->getPackageKeterangan();?></span><br><br><h5><?php echo $namaPaket;?></h5></div>
                        <div class="pricing-img mt-4">
                            <img src="<?php echo $asset->getAssetForAdmin('images/afiliasi/'.$homepackageafiliasiDomain->getPackageImage()) ?>" alt="<?php echo $asset->getAssetForAdmin('images/afiliasi/'.$homepackageafiliasiDomain->getPackageImage()) ?>" class="img-fluid">
                        </div>
                        <div class="card-header py-4 border-0 pricing-header">
                            <div class="h1 text-center mb-0" style="color:red">Rp<span class="price font-weight-bolder"><?php echo number_format($homepackageafiliasiDomain->getPackagePrice());?></span></div>
                        </div>
                        <?php endforeach;?>
                        <div class="card-body">
                            <ul class="list-unstyled text-sm mb-4 pricing-feature-list">
                                <?php if (count($homepackageafiliasiDataSource) == 0) : ?>
                                        <?php echo '<h6>tidak ada data</h6>'?>
                                <?php endif; ?>
                                <?php foreach($homepackageListDomain as $homepackageafiliasiDomain)  :?>
                                <?php $packageDescription = $homepackageafiliasiDomain->getPackageDescription();
                                    $listPackage = explode(PHP_EOL, $packageDescription);?>
                                <?php endforeach;?>
                                <?php foreach($listPackage as $val): ?>
                                    <h6 class="mb-3 color-light-secondary-2"><?php echo $val; ?></h6>
                                <?php endforeach; ?>
                            </ul>
                            <?php if (count($salesDomainArray) == 0) : ?>
                                 <?php echo '<h6>tidak ada data</h6>'?>
                            <?php endif; ?>
                            <?php foreach($salesDomainArray as $adminDomain)  :?>
                            <?php  
                                        $nohp = $adminDomain->getphone();
                                            // kadang ada penulisan no hp 0811 239 345
                                            $nohp = str_replace(" ","",$nohp);
                                            
                                            // kadang ada penulisan no hp (0274) 778787
                                            $nohp = str_replace("(","",$nohp);
                                            
                                            // kadang ada penulisan no hp (0274) 778787
                                            $nohp = str_replace(")","",$nohp);
                                            
                                            // kadang ada penulisan no hp 0811.239.345
                                            $nohp = str_replace(".","",$nohp);

                                            // cek apakah no hp mengandung karakter + dan 0-9
                                            if(!preg_match('/[^+0-9]/',trim($nohp))){
                                                // cek apakah no hp karakter 1-3 adalah +62
                                                if(substr(trim($nohp), 0, 2)=='62'){
                                                    $hp = trim($nohp);
                                                }

                                            // cek apakah no hp karakter 1 adalah 0
                                                elseif(substr(trim($nohp), 0, 1)=='0'){
                                                    $hp = '62'.substr(trim($nohp), 1);
                                                }
                                            }
                                        ?>
                            <a href="https://wa.me/<?php echo $hp;?>?text=Halo%20Indihome%20Jogja.%20Saya%20ingin%20berlanggan%20Indihome%20Paket%20<?php echo $paket?>%20.%20Apakah%20bisa%20dibantu%20untuk%20informasi%20lebih%20lanjut%20?" class="btn outline-btn mb-3">DAFTAR SEKARANG</a>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <div class="mt-5 text-center">
                <?php foreach($salesDomainArray as $adminDomain)  :?>
                <p class="mb-2">Mau paket Indihome yang lain dan lebih menarik ? 
                    <a href="<?php echo $urlBuilder->build(''.$adminDomain->getUsername().'/paket')?>" class="color-secondary">
                    Yuk!
                </a></p>
            <?php endforeach;?>
            </div>
        </div>
    </section>
    <!--our pricing packages section end--> 
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

    <!--contact us section start-->
<div class="shape-img subscribe-wrap">
    <img src="asset/images/footer-top-shape.png" alt="footer shape" class="img-fluid">
</div>
        <!-- =========== End of CTA ============ -->
<!--footer section start-->
        <footer class="footer-section" style="background-color : #E73328;">
            <!--footer top start-->
                <div class="footer-top pt-150 pb-5 background-img-2" style="background-image: url("asset/images/footer-bg.png") no-repeat center top / cover">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3 ml-auto mb-4 mb-lg-0">
                    <div class="footer-nav-wrap text-white">
                        <span class="mb-20">
                            <a href="#">
                                <img src="asset/images/new_indihome/indihome_logo_white.png" width="120px" alt="logo">
                            </a>
                        </span>
                        <p> Paket Internet Fiber Ultra Cepat dan Unlimited. Daftar dan nikmati sekarang untuk menikmati internet fiber ultra cepat dan tanpa batas dari Indihome</p>
                    </div>
                </div>
                <div class="col-lg-3 ml-auto mb-4 mb-lg-0">
                    <div class="footer-nav-wrap text-white">
                        <h5 class="mb-3 text-white">Tentang Kami</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="<?php echo $urlBuilder->build('profil-kami')?>" target="_blank">Profil Kami</a></li>
                            <li class="mb-2"><a href="<?php echo $urlBuilder->build('syarat-ketentuan')?>" target="_blank">Syarat dan Ketentuan</a></li>
                            <li class="mb-2"><a href="<?php echo $urlBuilder->build('kebijakan-privasi')?>" target="_blank">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                </div>
                 <div class="col-lg-3 ml-auto mb-4 mb-lg-0">
                    <div class="footer-nav-wrap text-white">
                        <h5 class="mb-3 text-white">Informasi</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="<?php echo $urlBuilder->build(''.$adminDomain->getUsername().'/paket')?>">Paket Indihome</a></li>
                            <li class="mb-2"><a href="https://www.indihome.co.id/pusat-bantuan" target="_blank">Tanya Jawab</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 ml-auto mb-4 mb-lg-0">
                    <div class="footer-nav-wrap text-white">
                        <h5 class="mb-3 text-white">Hubungi Kami</h5>
                        <ul class="list-unstyled support-list">
                            <li class="mb-2 d-flex align-items-center"><span class="fa fa-address"></span>
                                Jl. Yos Sudarso No.9A, 001, Kotabaru, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55224
                            </li>
                        </ul>
                        <br>
                        <br>
                        <ul class="list-unstyled support-list">
                            <li class="mb-2 d-flex align-items-center"><span class="fa fa-address"></span>
                                Provided By:
                            </li>
                                    <img src="asset/images/new_indihome/telkom_ver_white.png"  alt="logotelkom">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--footer top end-->

    <!--footer copyright start-->
    <div class="footer-bottom gray-light-bg pt-4 pb-4">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-md-6 col-lg-7"><p class="copyright-text pb-0 mb-0">Copyright © 2020 PT Telekomunikasi Indonesia (Persero) Tbk All Right Reserved.
                </div>
            </div>
        </div>
    </div>
    <!--footer copyright end-->
</footer>      
    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>
