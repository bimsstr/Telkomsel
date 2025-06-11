<?php echo $htmlHeader; ?>
    <?php echo $headerBar ?>
<!-- =========== Start of Hero ============ -->
 <!--hero section start-->
    <section class="hero-section ptb-100 background-img"
             style="background: url('asset/images/hero-bg-1.jpg')no-repeat center center / cover">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-9 col-lg-10">
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <?php if (count($salesTitleDomainArray) == 0) : ?>
                        <?php echo "tidak ada data";?>
                        <?php endif; ?>
                        <?php foreach($salesTitleDomainArray as $salesTitleDomain) :?>
                        <h1 class="text-white mb-0">PILIH SALES INDIHOME JOGJA</h1>
                        
                        <p class="lead"><?php echo $salesTitleDomain->getSubtitle(); ?></p>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hero section end-->
    <div class="module mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-8">
                    <!-- Post-->
                        <div class="post-wrapper">
                            <div class="post-header">
                                <h4 class="">Paket Pilihan Anda : <span style="color: red"> <?php echo $paket;?> </span></h4>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!--our team section start-->
    <section class="module" style="margin-bottom: 100px">
        <div class="container">
            <div class="row">
                <?php if (count($salesDomainArray) == 0) : ?>
                    <?php echo "tidak ada data";?>
                <?php endif; ?>
                <?php foreach($salesDomainArray as $salesDomain) :?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-team-member position-relative my-lg-3 my-md-3 my-sm-0">
                        <div class="team-image">
                            <img src="<?php echo $asset->getAssetForAdmin('images/profile/'.$salesDomain->getImage()) ?>" alt="Team Members" alt="Team Members" class="img-fluid rounded">
                        </div>
                        <div class="team-info text-white rounded d-flex flex-column align-items-center justify-content-center">
                            <h5 class="mb-0"><?php echo $salesDomain->getFullname(); ?></h5>
                            <h6><?php echo $salesDomain->getPosition(); ?></h6>
                            <ul class="list-inline team-social social-icon my-4 text-white">
                                <li class="list-inline-item">
                                    <a href="#">
                                        <span style="font-size: 18px"class="fa fa-whatsapp" class="lead"> 
                                    <?php  
                                        $nohp = $salesDomain->getphone();
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
                                            echo $salesDomain->getphone();
                                        ?>
                                        
                                        </span>
                                    </a>
                                </li>
                            </ul>

                            <a href="https://wa.me/<?php echo $hp;?>?text=Halo%20Indihome%20Jogja.%20Saya%20ingin%20berlanggan%20Indihome%20Paket%20<?php echo $paket?>%20.%20Apakah%20bisa%20dibantu%20untuk%20informasi%20lebih%20lanjut%20?" class="btn app-store-btn">CHAT SEKARANG!</a>
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
</div>
    <!--our team section end-->
<?php echo $footerBar; ?>
<?php echo $messageSession ?>
<?php echo $htmlFooter; ?>