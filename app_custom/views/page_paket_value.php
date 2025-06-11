<?php echo $htmlHeader; ?>
<?php echo $headerBar ?>
<!-- =========== Start of Hero ============ -->

<section class="hero-section ptb-100 background-img"
             style="background: url('asset/images/hero-bg-1.jpg')no-repeat center center / cover">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-12">
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <h1 class="text-white mb-0">INDIHOME VALUE </h1>
                        <p>Yuk! Lihat Paket Indihome Value Yang Sesuai Kebutuhan Kamu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="module mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-8">
                    <!-- Post-->
                    <article class="post">
                        <?php if (count($homepackageblogDomainArray) == 0) : ?>
                            <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homepackageblogDomainArray as $homepackageblogDomain) :?>
                        <div class="post-wrapper">
                            <div class="post-header">
                                <h4 class="mb-30">Paket <span style="color: red"> <?php echo $homepackageblogDomain->getPackageCategory();?> </span></h4>
                            </div>
                            <div class="text-center" style="padding-top: 50px"><img src="<?php echo $asset->getAssetForAdmin('images/package_blog/'.$homepackageblogDomain->getPackageImage()) ?>" alt="<?php echo $homepackageblogDomain->getPackageImage();?>">
                            </div>
                            <div class="post-content" style="padding-top: 50px">
                                <p><?php echo $homepackageblogDomain->getPackageDescription();?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </article>
                    <!-- Post end-->
                </div>
            </div>
        </div>
    </div>
    <div class="module">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <!-- Post-->
                        <?php if (count($homepackageblogDomainArray) == 0) : ?>
                                        <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homepackageblogDomainArray as $homepackageblogDomain) :?>
                        <div class="post-wrapper">
                            <div class="post-header" align="text-center">
                                <h5> Daftar Paket <span style="color: red"> <?php echo $homepackageblogDomain->getPackageCategory();?> </span> </h5>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    <!-- Post end-->
                </div>
            </div>
        </div>
    </div>
    <!--header section end-->
    <section id="pricing" class="package-section mt-4">
        <div class="container">
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
                            <img src="<?php echo $asset->getAssetForAdmin('images/package/'.$homepackagedetailDomain->getPackageImage()) ?>" alt="<?php echo $asset->getAssetForAdmin('images/package/'.$homepackagedetailDomain->getPackageImage()) ?>" class="img-fluid">
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
                            <a href="<?php echo $urlBuilder->build('pilih-sales', 'paket='.$namaPaket, TRUE) ?>" class="btn outline-btn mb-3">DAFTAR SEKARANG</a>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <div class="module ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-8">
                    <!-- Post-->
                    <article class="post">
                        <?php if (count($homepackageblogDomainArray) == 0) : ?>
                                        <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homepackageblogDomainArray as $homepackageblogDomain) :?>
                        <div class="post-wrapper">
                            <div class="post-header">
                                <h5 class="mb-30">Syarat dan <span class="color-primary"> Ketentuan </span> </h5>
                            </div>
                            <div class="post-content">
                                <?php
                                    $desc = $homepackageblogDomain->getPackageSK(); 
                                    $list = explode("\n\r", $desc);?>
                                <?php foreach ($list as $val):?>
                                <div class="row" style="padding-left: 20px;">
                                        <i class="material-icons middle center color-primary">arrow_right</i>
                                    <div class="col-12 col-md-12 col-lg-11 ">
                                        <?php echo $val; ?>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </article>
                    <!-- Post end-->
                </div>
            </div>
        </div>
    </div>
<div class="shape-img subscribe-wrap">
    <img src="asset/images/footer-top-shape.png" alt="footer shape" class="img-fluid">
</div>
        <?php echo $footerBar; ?>
        <?php echo $messageSession ?>
        <?php echo $htmlFooter; ?>