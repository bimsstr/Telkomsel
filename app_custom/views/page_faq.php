<?php echo $htmlHeader; ?>
<?php echo $headerBar ?>
<!-- =========== Start of Hero ============ -->
<section class="hero-section ptb-100 background-img"
             style="background: url('asset/images/hero-bg-1.jpg')no-repeat center center / cover">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-9 col-lg-7">
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <h3 class="text-white mb-0">FREQUENTLY ASKED QUESTION</h1>
                        <p class="lead">
                            Mengalami kesulitan? Halaman ini bisa membantu menjawabnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hero section end-->

    <!--promo section start-->
    <section class="promo-section ptb-100">
        <div class="container">

            <!--pricing faq start-->
            <div class="row">
                <?php if (count($homefaqDomainArray) == 0) : ?>
                        <p>tidak ada data</p>
                <?php endif; ?>
                <?php $counter = 0; foreach($homefaqDomainArray as $namaCategory => $homefaqListDomain) :?>
                <div class="col-lg-12">
                    <h5 class="font-w-600" style="color: red"><?php echo $namaCategory; ?> </h5>
                </div>
                <br>
                <br>
                <div class="col-lg-12">
                    <!-- Accordion card 1 -->
                    <div id="accordion-1" class="accordion accordion-faq">
                        <?php foreach($homefaqListDomain as $homefaqDomain) : ?>
                        <div class="card mb-10" style="max-height: 90px" >
                            <blockquote class="card-body">
                                <h6 class="font-w-400"><?php echo $homefaqDomain->getPertanyaan(); ?></h6>
                                <h6 style="text-align: right">
                                    <a href="#faq<?php echo $counter ?>" data-toggle="collapse" class="color-primary">
                                        <i style="color: red" class="material-icons">add_circle</i>
                                    </a>
                                </h6>
                            </blockquote>
                        </div>
                        <div class="collapse card mb-10" id="faq<?php echo $counter++ ?>">
                            <blockquote class="card-body pb-30">
                                <h6><?php echo $homefaqDomain->getJawaban(); ?></h6>
                            </blockquote>
                        </div>
                        <?php endforeach;?>
                     </div>                              
                </div>
            <?php endforeach;?>   
            <!--pricing faq end-->
        </div>
    </section>
<div class="shape-img subscribe-wrap">
    <img src="asset/images/footer-top-shape.png" alt="footer shape" class="img-fluid">
</div>
<?php echo $footerBar; ?>
<?php echo $messageSession ?>
<?php echo $htmlFooter; ?>