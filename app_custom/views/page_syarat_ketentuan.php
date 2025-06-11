<?php echo $htmlHeader; ?>
<?php echo $headerBar ?>
<!-- =========== Start of Hero ============ -->

<section class="hero-section ptb-100 background-img"
             style="background: url('asset/images/hero-bg-1.jpg')no-repeat center center / cover">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <h1 class="text-white mb-0">SYARAT DAN KETENTUAN</h1>
                        <p>Syarat dan Ketentuan Penggunaan Layanan Indihome Jogja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->
    <div class="module ptb-100">
        <div class="container">
            <div class="row">
            <div class="col-12 col-md-10 col-lg-7 col-xl-6 mx-auto">
                <div class="section-title reveal text-center mb-20">
                    <br>
                    <br>
                    <h3 class="font-w-400">SYARAT <strong class="color-primary">DAN KETENTUAN</strong></h3>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <blockquote class="card-body" style="padding-right:50px; padding-left: 50px">
                            <?php if (count($homeskdetailDomainArray) == 0) : ?>
                                <p>tidak ada data</p>
                            <?php endif; ?>
                            <?php foreach($homeskdetailDomainArray as $namaCategory => $homeskListDomain) :?>
                               <h6 class="color-primary" style="font-size: 16px; padding-bottom: 20px"><i class="material-icons middle center">security</i>&nbsp<?php echo $namaCategory; ?> </h6>
                            <?php foreach($homeskListDomain as $homeskdetailDomain) : ?>
                                <?php
                                    $desc = $homeskdetailDomain->getDescription(); 
                                    $list = explode("\n\r", $desc);?>
                                <?php foreach ($list as $val):?>
                                <div class="row" style="padding-left: 20px;">
                                        <i class="material-icons middle center color-primary">arrow_right</i>
                                    <div class="col-12 col-md-12 col-lg-11 ">
                                        <?php echo $val; ?>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            <?php endforeach;?>
                            <?php endforeach;?>        
                        </blockquote>
                    </div>                            
                <!-- end of col  -->
            </div>
        <!-- </div> -->
        </div>
        </div>
        
    </div>
<div class="shape-img subscribe-wrap">
    <img src="asset/images/footer-top-shape.png" alt="footer shape" class="img-fluid">
</div>
        <?php echo $footerBar; ?>
        <?php echo $messageSession ?>
        <?php echo $htmlFooter; ?>