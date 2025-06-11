<?php echo $htmlHeader; ?>
<?php echo $headerBar ?>
<!-- =========== Start of Hero ============ -->

<section class="hero-section ptb-100 background-img"
             style="background: url('asset/images/hero-bg-1.jpg')no-repeat center center / cover">
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
                            <button type="submit" class="btn btn-danger waves-effect" name="process" value="sort">Urutkan</button>
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
                <?php if (count($homepackagedetailDomainArray) == 0) : ?>
                    <?php echo '<h6>tidak ada data</h6>'?>
                <?php endif; ?>
                <?php foreach($homepackagedetailDomainArray as $namaPaket => $homepackageListDomain) :?>
                <div class="col-lg-4 col-md" style="padding-bottom: 100px">
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
<div class="shape-img subscribe-wrap">
    <img src="asset/images/footer-top-shape.png" alt="footer shape" class="img-fluid">
</div>
        <?php echo $footerBar; ?>
        <?php echo $messageSession ?>
        <?php echo $htmlFooter; ?>