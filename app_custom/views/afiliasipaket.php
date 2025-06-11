<?php echo $htmlHeader; ?>
      <!-- =========== Start of Navigation (main menu) ============ -->
 <header class="header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg fixed-top bg-transparent color-primary">
        <div class="container">
            <?php foreach($salesDomainArray as $adminDomain)  :?>
                <a class="navbar-brand" href="<?php echo $urlBuilder->build(''.$adminDomain->getUsername().'')?>">
                    <img src ="../asset/images/new_indihome/indihome_logo_white.png" width="120px" alt="logo"></a>
            <?php endforeach;?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span style="color: white;"class="fa fa-align-justify"></span>
            </button>

            <div class="collapse navbar-collapse main-menu" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <?php if (count($salesDomainArray) == 0) : ?> 
                            <p> tidak ada data </p>
                        <?php endif; ?>
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
<section class="hero-section ptb-100 background-img"
             style="background: url('../asset/images/hero-bg-1.jpg')no-repeat center center / cover">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <h1 class="text-white mb-0">PAKET INDIHOME JOGJA</h1>
                        <p>Yuk! Lihat Paket Indihome Yang Sesuai Kebutuhan Kamu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->
        <div class="module mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-8">
                    <!-- Post-->
                    <div class="post-wrapper">
                        <div class="post-header">
                            <h4 class="text-center">Daftar Paket <span style="color: red"> Indihome Jogja </span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="module mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-8">
                    <!-- Post-->
                <form  method="POST" action="" autocomplete="OFF" class="form-horizontal" enctype="multipart/form-data">
                    <div class="post-wrapper">
                        
                        <div class="post-header">
                            <label for="sa">Urutkan Berdasarkan :  </label>
                            <select class="browser-default" name="sortby" style="height: 30px; width: 250px" >
                                <option value="" disabled selected>Sort By :</option>
                                <option value="termurah">Harga Termurah</option>
                                <option value="termahal">Harga Termahal</option>
                                <option value="bestseller">Terlaris</option>
                                <option value="category">Category</option>
                            </select>
                            <button type="submit" class="btn btn-danger waves-effect" name="process" value="sortafiliasi">Urutkan</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <section id="pricing" class="package-section ptb-100">
        <div class="container">
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
                            <a href="https://wa.me/<?php echo $hp?>?text=Halo%20Indihome%20Jogja.%20Saya%20ingin%20berlanggan%20Indihome%20Paket%20<?php echo $paket?>%20.%20Apakah%20bisa%20dibantu%20untuk%20informasi%20lebih%20lanjut%20?" class="btn outline-btn mb-3">DAFTAR SEKARANG</a>
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
                            <img src="<?php echo $asset->getAssetForAdmin('images/afiliasi/'.$homepackageafiliasiDomain->getPackageImage()) ?>" class="img-fluid">
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
        </div>
    </section>
<div class="shape-img subscribe-wrap">
    <img src="../asset/images/footer-top-shape.png" alt="footer shape" class="img-fluid">
</div>
        <footer class="footer-section" style="background-color : #E73328;">
            <!--footer top start-->
                <div class="footer-top pt-150 pb-5 background-img-2" style="background-image: url('../asset/images/footer-bg.png') no-repeat center top / cover">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3 ml-auto mb-4 mb-lg-0">
                    <div class="footer-nav-wrap text-white">
                        <span class="mb-20">
                            <a href="#">
                                <img src="../asset/images/new_indihome/indihome_logo_white.png" width="120px" alt="logo">
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
                                    <img src="../asset/images/new_indihome/telkom_ver_white.png"  alt="logotelkom">
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
        <?php echo $htmlFooter; ?>ss