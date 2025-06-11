<section id="contact" class="contact-us ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="section-heading">
                        <h3 class="color-primary">Kontak Kami</h3>
                        <p>Jangan segan untuk sekedar menyapa dan bertanya kepada kami, atau mungkin memberikan saran masukan.</p>
                    </div>
                    <div class="footer-address">
                    <?php if (count($homecontactDomainArray) == 0) : ?>
                        <?php echo "<p> tidak ada data </p"?>
                    <?php endif; ?>
                    <?php foreach($homecontactDomainArray as $homecontactDomain) :?>
                        <h5 class="color-primary"><strong>TELKOM YOS SUDARSO</strong></h5>
                        <p><?php echo $homecontactDomain->getAddress(); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-7">
                    <form class="contact-us-form" method="POST" autocomplete="OFF" enctype="multipart/form-data">
                        <h5 class="color-primary">Reach us quickly</h5>
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan Nomor HP" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Masukkan Email" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" value="" placeholder="Masukkan Subjek" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="message" id="message" class="form-control" rows="7" cols="25" placeholder="Masukkan Pesan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-3">
                                <button type="submit" class="btn solid-btn" name="process" value="send_message">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                    <p class="form-message"></p>
                </div>
            </div>
        </div>
    </section>
  <!-- Trigger the modal with a button -->

  <div class="row justify-content-center">
                <?php if (count($salesDomainArray) == 0) : ?>
                    <?php echo "tidak ada data";?>
                <?php endif; ?>
                <?php foreach($salesDomainArray as $salesDomain) :?>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-team-member position-relative">
                        <div class="team-image">
                            <img src="<?php echo $asset->getAssetForAdmin('images/profile/'.$salesDomain->getImage()) ?>" alt="Team Members" class="img-fluid rounded-circle">
                        </div>
                        <div class="team-info text-white rounded-circle d-flex flex-column align-items-center justify-content-center">
                            <h5 class="mb-0"><?php echo $salesDomain->getFullname(); ?></h5>
                            <h6><?php echo $salesDomain->getPosition(); ?></h6>
                            <ul class="list-inline team-social social-icon mt-4 text-white">
                                <li class="list-inline-item">
                                    <?php for( $i = 0; $i < $salesDomain->getStar(); $i++ ){
                                        echo '<img src="asset/images/star.png" alt="star" style="width:20px">';
                                    } ?>   
                                </li>
                            </ul>
                            <ul class="list-inline team-social social-icon my-4 text-white">
                                <li class="list-inline-item"><a href="https://wa.me/<?php echo $salesDomain->getphone();?>?text=Saya%20ingin%20mendaftar%20Indihome%20Jogja"><span style="font-size: 18px"class="fa fa-whatsapp" class="lead"> <?php echo $salesDomain->getphone(); ?></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach;?> 
            </div>