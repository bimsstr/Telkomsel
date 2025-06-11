<?php echo $htmlHeader; ?>
	<?php echo $headerBar ?>
        <!-- =========== Start of Hero ============ -->
     <section class="space-bottom hero hero--dark hidden">
            <?php if (count($homecontactustitleDomainArray) == 0) : ?>
                <p>tidak ada data</p>
            <?php endif; ?>
            <?php foreach($homecontactustitleDomainArray as $homecontactustitleDomain) :?>
            <div class="background-holder">
                <img src="<?php echo $asset->getAssetForAdmin('images/contact_us/image_base/'.$homecontactustitleDomain->getImage()) ?>" alt="<?php echo $homecontactustitleDomain->getImage()?>" class="background-image-holder">
            </div>
            <?php endforeach;?>
            <!-- end of background image -->
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">
                        <?php if (count($homecontactustitleDomainArray) == 0) : ?>
                            <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homecontactustitleDomainArray as $homecontactustitleDomain) :?>
                        <div class="position-relative text-center">
                            <div class="hero-content hero-content--center">
                                <h1 class="hero__title"><?php echo $homecontactustitleDomain->getTitle();?></h1>
                                <p class="lead hero__description"><?php echo $homecontactustitleDomain->getSubtitle();?></p>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <!-- end of content -->
                    </div>
                    <!-- end of col -->
                </div>
                <!-- end of row -->
            </div>
            <!-- end of container -->
        </section>
        <!-- =========== End of Hero ============ -->

        <!-- =========== Start of Contact Info ============ -->
        <div class="py-5 bg-color-grey border-bottom-light">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3 text-center mb-40 mb-lg-0">    
                        <?php if (count($homecontactustitleDomainArray) == 0) : ?>
                            <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homecontactustitleDomainArray as $homecontactustitleDomain) :?>
                        <span class="mb-20 position-relative">
                            <img src="<?php echo $asset->getAssetForAdmin('images/contact_us/icon_address/thumbs/'.$homecontactustitleDomain->getIconAddress()) ?>" alt="<?php echo $homecontactustitleDomain->getIconAddress()?>">
                        </span>
                        <?php endforeach;?>
                        
                        <?php if (count($homecontactusDomainArray) == 0) : ?>
                            <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homecontactusDomainArray as $homecontactusDomain) :?>
                        <h2 class="h6-font">Alamat</h2>
                        <a href="tell:" class="btn-text-hover"><?php echo $homecontactusDomain->getAddress();?></a>
                        <?php endforeach;?>
                    </div>
                    
                    <!-- end of col -->
                    <div class="col-12 col-sm-6 col-lg-3 text-center  mb-40 mb-lg-0">
                        <?php if (count($homecontactustitleDomainArray) == 0) : ?>
                            <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homecontactustitleDomainArray as $homecontactustitleDomain) :?>
                        <span class="mb-20 position-relative">
                            <img src="<?php echo $asset->getAssetForAdmin('images/contact_us/icon_callcenter/thumbs/'.$homecontactustitleDomain->getIconCallcenter()) ?>" alt="<?php echo $homecontactustitleDomain->getIconCallcenter()?>">
                        </span>
                        <?php endforeach;?>
                        
                        <?php if (count($homecontactusDomainArray) == 0) : ?>
                            <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homecontactusDomainArray as $homecontactusDomain) :?>
                        <h2 class="h6-font">Call Center</h2>
                        <a href="tell:" class="btn-text-hover"><?php echo $homecontactusDomain->getCallCenter();?></a>
                        <?php endforeach;?>
                    </div>
                    <!-- end of col -->
                    <div class="col-12 col-sm-6 col-lg-3 text-center  mb-40 mb-lg-0">
                        <?php if (count($homecontactustitleDomainArray) == 0) : ?>
                            <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homecontactustitleDomainArray as $homecontactustitleDomain) :?>
                        <span class="mb-20 position-relative">
                            <img src="<?php echo $asset->getAssetForAdmin('images/contact_us/icon_smscenter/thumbs/'.$homecontactustitleDomain->getIconSmscenter()) ?>" alt="<?php echo $homecontactustitleDomain->getIconSmscenter()?>">
                        </span>
                        <?php endforeach;?>

                        <?php if (count($homecontactusDomainArray) == 0) : ?>
                            <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homecontactusDomainArray as $homecontactusDomain) :?>
                        <h2 class="h6-font">SMS Center</h2>
                        <a href="tell:" class="btn-text-hover"><?php echo $homecontactusDomain->getSmsCenter();?></a>
                        <?php endforeach;?>
                    </div>
                    <!-- end of col -->
                    <div class="col-12 col-sm-6 col-lg-3 text-center">
                        <?php if (count($homecontactustitleDomainArray) == 0) : ?>
                            <p>tidak ada data</p>
                        <?php endif; ?>
                        <?php foreach($homecontactustitleDomainArray as $homecontactustitleDomain) :?>
                        <span class="mb-20 position-relative">
                            <img src="<?php echo $asset->getAssetForAdmin('images/contact_us/icon_livechat/thumbs/'.$homecontactustitleDomain->getIconLivechat()) ?>" alt="<?php echo $homecontactustitleDomain->getIconLivechat()?>">
                        </span>
                        <?php endforeach;?>
                        <h2 class="h6-font">Live Chat</h2>
                        <a href="#" class="btn-text-hover">Live chat now</a>
                    </div>
                    <!-- end of col -->
                </div>
            </div>
        </div>
        <!-- =========== End of Contact Info ============ -->

        <!-- =========== End of Contact Form ============ -->
        <div class="space-top-sm border-bottom-light mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 mx-auto">
                        <div class="section-title reveal text-center mb-80 reveal mt-10">
                            <h3 class="mb-3">KONTAK KAMI</h3>
                            <p style="font=size: 12px;" >Jangan segan untuk sekedar menyapa dan bertanya kepada kami, atau mungkin memberikan saran masukan. </p>
                        </div>
                        <!-- end of section title -->
                    </div>
                </div>

                <!-- end of col -->
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto">
                        <form class="form form--sm" method="POST" autocomplete="OFF" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-row mb-20">
                                <div class="form-group col-sm-12 col-md-6">
                                    <label class="label-control mb-10" for="name">Nama Lengkap*</label>
                                    <input type="text" class="form-control" id="name" placeholder="" name="name" required>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label class="label-control mb-10" for="phone">Nomor Ponsel</label>
                                    <input type="text" class="form-control" id="phone" placeholder="" name="phone">
                                </div>
                            </div>
                            <div class="form-row mb-20">
                                <div class="form-group col-sm-12 col-md-6">
                                    <label class="label-control mb-10" for="email">Alamat Email*</label>
                                    <input type="email" class="form-control" id="email" placeholder="" name="email" required>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label class="label-control mb-10" for="subject">Subjek*</label>
                                    <input type="text" class="form-control" id="subject" placeholder="i.e. Webdesign" name="title"required>
                                </div>
                            </div>
                            <div class="form-row mb-20">
                                <div class="form-group col-sm-12">
                                    <label class="label-control mb-10" for="message">Your Message</label>
                                    <textarea class="form-control" id="message" rows="4" placeholder="i.e. The design is...." name="message" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12 text-center">
                                    <button type="submit" class="btn btn--bg-primary btn-splash-hover btn-3d-hover" name="process" value="send_message">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- =========== End of Contact Form ============ -->
        <?php echo $footerBar; ?>
    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>