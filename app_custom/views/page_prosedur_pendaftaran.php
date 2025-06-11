<?php echo $htmlHeader; ?>
<?php echo $headerBar ?>
<!-- =========== Start of Hero ============ -->
<section class="hero-section pt-100 background-img"
             style="background: url('img/hero-bg-1.jpg')no-repeat center center / cover">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-9 col-lg-7">
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <h1 class="text-white mb-0">Prosedur Pendaftaran</h1>
                        <p class="lead">
                            Prosedur Pendaftaran Indihome Jogja
                        </p>
                    </div>
                </div>
            </div>
            <!--counter start-->
            <div class="row">
                <ul class="list-inline counter-wrap">
                    <li class="list-inline-item">
                        <div class="single-counter text-center">
                            <span>2305</span>
                            <h6>Happy Client</h6>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="single-counter text-center">
                            <span>2145</span>
                            <h6>App Download</h6>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="single-counter text-center">
                            <span>2345</span>
                            <h6>Total Rates</h6>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="single-counter text-center">
                            <span>2245</span>
                            <h6>Awards win</h6>
                        </div>
                    </li>
                </ul>
            </div>
            <!--counter end-->
        </div>
    </section>
    <!--hero section end-->

    <!--our video promo section start-->
    <section id="download" class="video-promo ptb-100">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="row" >
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 pl-0">
                <div class="section-title reveal text-left mb-20">
                    <br>
                    <br>
                    <h6 class="font-w-400">PETUNJUK <strong class="color-primary">PENDAFTARAN</strong></h6>
                    <p style="font-size: 14px">Sebelum melakukan pendaftaran harap perhatikan beberapa persiapan dan hal berikut.</p>
                </div>
            </div>
        </div>
        <div class="row" style="background-color: black 20;">
            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                <div class="section-title reveal text-left mb-50 mt-60 pl-30">
                    <div class="tab-content">
                        <ul>
                            <li class="mb-10" style="font-size: 12px"><i class="material-icons middle center color-primary">arrow_right</i> Komputer, laptop, mobile device</li>
                            <li class="mb-10" style="font-size: 12px"><i class="material-icons middle center color-primary">arrow_right</i> Koneksi internet</li>
                            <li class="mb-10" style="font-size: 12px"><i class="material-icons middle center color-primary">arrow_right</i> Nomor handphone yang masih aktif</li>
                            <li class="mb-10" style="font-size: 12px"><i class="material-icons middle center color-primary">arrow_right</i> Akun e-mail yang masih aktif</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                <div class="section-title reveal text-left mb-50 mt-50 pl-30 pr-30" style="border-left: 1px solid #e7eaee;">
                    <div class="border-none tab-content">
                        <p style="font-size: 12px">Pastikan nomor handphone dalam keadaan aktif. Pastikan juga akun email seperti Yahoo!, GMail, dsb dapat diakses. Akun email dibutuhkan untuk konfirmasi dan berkomunikasi beragam informasi terkait transaksi anda nantinya. </p>
                        <br>
                        <p style="font-size: 12px">Apabila belum memiliki akun email, silahkan membuatnya terlebih dahulu. Usahakan anda memiliki salah satu rekening bank yang sama dengan kami untuk kemudahan bertransaksi dengan kami dan memaksimalkan keuntungan. </p>
                        <br>
                        <p style="font-size: 12px">Jika perisapan sudah dilakukan, silahkan melakukan proses pendaftaran.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 mt-50" style="padding-left:0px;border-top:1px dashed; color: gray">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 pl-0">
                <div class="section-title reveal text-left mb-20">
                    <br>
                    <br>
                    <h6 class="font-w-400">PROSEDUR <strong class="color-primary">PENDAFTARAN ONLINE</strong></h6>
                    <p style="font-size: 14px">Pendaftaran tidak sulit, isi formulir, melakukan pembayaran, akun aktif.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="my-space-bottom reveal">
                <div class="col-12 col-md-12 col-lg-12 pl-0">
                    <?php if (count($homeprosedurdaftardetailDomainArray) == 0) : ?>
                        <p>tidak ada data</p>
                    <?php endif; ?>
                    <?php foreach($homeprosedurdaftardetailDomainArray as $namaCategory => $homepdListDomain) :?>
                    <div class="mb-10">
                        <h6 class="font-w-600" style="font-size: 16px"> <?php echo $namaCategory; ?> </h6>
                    </div>
                    <?php foreach($homepdListDomain as $homeprosedurdaftarDomain) : ?>
                        <?php 
                            $desc = $homeprosedurdaftarDomain->getDescription();   
                            $list = explode("\n\r", $desc);
                            ?>
                            <?php foreach ($list as $val):?>                                       
                            <div class="row pl-30">
                                <div>
                                    <i class="material-icons middle center color-primary">arrow_right</i>
                                </div>
                                <div class="col-12 col-md-12 col-lg-11 pl-0">
                                    <?php echo $val; ?>
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php endforeach;?>
                    <?php endforeach;?>
                </div>
                <!-- end of col  -->
            </div>
        <!-- </div> -->
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 mt-30" style="padding-left:0px;border-top:1px dashed; color: gray">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 pl-0">
                <div class="section-title reveal text-left mb-20">
                    <br>
                    <br>
                    <h6 class="font-w-400">REKENING BANK <strong class="color-primary">PEMBAYARAN</strong></h6>
                    <p style="font-size: 14px">Silahkan melakukan pembayaran ke salah satu rekening berikut : </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="row justify-content-center mt-30 mb-20">
                <?php if (count($bankDomainArray) == 0) : ?>
                    <p>tidak ada data</p>
                <?php endif; ?>
                <?php foreach($bankDomainArray as $homebankDomain) :?>                          
                <div class="col-12 col-md-3 col-lg-3 col-xl-3 z-index2 reveal">
                    <div class="card text-center mb-10 mb-md-0">
                        <div class="header pl-40 pr-40 py-5 border-bottom-light">
                            <span class="mb-10 position-relative" >
                                <img  src="<?php echo $asset->getAssetForAdmin('images/bank/'.$homebankDomain->getImage()) ?>" alt="<?php echo $homebankDomain->getImage()?>" >
                            </span>
                            <div class="mb-10 mt-10" style="border-bottom: 2px solid #e7eaee;"></div>
                            <h6 class="font-w-400 mb-10" style="font-size: 16px"><?php echo $homebankDomain->getAccountNo(); ?></h6>
                            <div class="mb-10 mt-10" style="border-bottom: 2px solid #e7eaee;"></div>
                            <h6 class="font-w-400 mb-10" style="font-size: 16px"><?php echo $homebankDomain->getAccountName(); ?></h6>
                            <div class="mb-10 mt-10"style="border-bottom: 2px solid #e7eaee;"></div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <!-- end of row -->
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 mt-30" style="padding-left:0px;border-top:1px dashed; color: gray">
            </div>
        </div>
        <div class="row bg-color-primary mt-30">
            <div class="col-12 col-md-8 col-lg-8 col-xl-8 mt-30 mb-10 ml-30">
                <blockquote class="blockquote">
                    <h6 class="font-w-400 lead">“Kesempatan bagi Anda untuk memulai bisnis online! Lebih dari 5000 Agen sudah bergabung dan sukses bersama Velosita”</h6>
                </blockquote>
            </div>
            <div class="col-12 col-md-2 col-lg-2 col-xl-2 mt-40 mb-30 ml-100" style="align-content: middle">
                <a href="<?php echo $urlBuilder->build('proses-registrasi');?>" class="btn btn--sm btn--bg-white btn--color-primary btn-3d-hover btn-splash-hover"><span class="btn__text">DAFTAR SEKARANG</span>
                </a>
            </div>
        </div>
            </div>
        </div>
    </section>
<?php echo $footerBar; ?>
<?php echo $messageSession ?>
<?php echo $htmlFooter; ?>