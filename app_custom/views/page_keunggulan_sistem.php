<?php echo $htmlHeader; ?>
<?php echo $headerBar ?>
<!-- =========== Start of Hero ============ -->
<section class="space-navbar bg-gradient-1 hidden">
</section>
<div class="space-headline color-gray">
    <div class="content-wrapper">
        <div class="row">
            <div class="column col-lg-6">
                <span class="col-lg-1">
                </span>

                <span class="col-lg-6">
                    <span class="middle center">
                        <h6 class="h6-test"><i class="material-icons middle center">person_add</i> Keunggulan Sistem</h6>
                    </span>
                </span>
            </div> 
        </div>
    </div>
</div>
<section class="space-top-md bg-white" id="features" >
    <div class="my-wrapper color-gray pb-50">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 mx-auto">
                <div class="section-title reveal text-center mb-20">
                    <br>
                    <br>
                    <h3 class="font-w-400">KEUNGGULAN <strong class="color-primary">SISTEM</strong></h3>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 pl-0">
                <div class="section-title reveal text-left">
                    <br>
                    <p style="font-size: 15px">Velosita selalu ingin memberikan lebih kepada Agen yang sudah bermitra dengan kami. Nikmati kemudahan transaksi dan program - program menarik yang sudah kami siapkan spesial hanya untuk mitra Agen Grahatour.</p>
                </div>
            </div>
        </div>
        <?php if (count($homekeunggulansistemdetailDomainArray) == 0) : ?>
            <p>tidak ada data</p>
        <?php endif; ?>
        <?php foreach($homekeunggulansistemdetailDomainArray as $namaCategory => $homeksListDomain) :?>
        <div class="row pt-10 pb-10 mt-10">
            <h6 class="font-w-600" style="font-size: 16px"> <?php echo $namaCategory; ?> </h6>
        </div>                
        <div class="row mb-20" style="background-color: white;">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            </div>
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="section-title reveal text-left mb-20 mt-20">
                    <div class="tab-content">
                    <?php foreach($homeksListDomain as $homekeunggulansistemDomain) : ?>
                        <?php 
                            $desc = $homekeunggulansistemDomain->getDescription();   
                            $list = explode("\n\r", $desc);
                            ?>
                            <?php foreach ($list as $val):?>                                       
                            <div class="row pl-30">
                                <div>
                                    <i class="material-icons middle center color-primary">arrow_right</i>
                                </div>
                                <div>
                                    <?php echo $val; ?>
                                </div>
                            </div>
                        <?php endforeach;?>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <div class="row">
            <div class="my-space-bottom reveal">
                <div class="col-12 col-md-12 col-lg-12 pl-0">
                    
                </div>
                <!-- end of col  -->
            </div>
        <!-- </div> -->
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
<!-- end of container -->
</section>
<?php echo $footerBar; ?>
<?php echo $messageSession ?>
<?php echo $htmlFooter; ?>