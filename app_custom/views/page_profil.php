<?php echo $htmlHeader; ?>
	<?php echo $headerBar ?>
<!--
	<div class="banner-area about-banner" style="background: url('asset/gallery/search/<?php echo $sliderSearchDomain->getImage()?>') no-repeat scroll center top /cover;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center">
						<div class="title-border">
							<h1>Tentang <span>Kami</span></h1>
						</div>
						<p class="text-white">Temukan pengalaman terbaik dalam sebuah perjalanan liburan bersama kami</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<?php echo $breadcrumb ?>
				</div>
			</div>
		</div>
	</div>
-->
	<div id="content-first" class="service-area section-padding">
		<div class="container">
			<div class="section-title text-center mb-none">
				<div class="title-border">
					<h1>Tentang <span>Kami</span></h1>
				</div>
				<p>Temukan pengalaman terbaik dalam sebuah perjalanan liburan bersama kami.</p>
			</div>
		</div>
	</div>
	<div class="service-area section-padding text-center" style="padding-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <div class="single-service">
                            <div class="single-icon">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/3.png') ?>" class="primary-img" alt="">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/3-hover.png') ?>" class="secondary-img" alt="">
                            </div>
                            <h5>Adventure</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="single-service">
                            <div class="single-icon">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/2.png') ?>" class="primary-img" alt="">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/2-hover.png') ?>" class="secondary-img" alt="">
                            </div>
                            <h5>Family</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="single-service">
                            <div class="single-icon">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/6.png') ?>" class="primary-img" alt="">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/6-hover.png') ?>" class="secondary-img" alt="">
                            </div>
                            <h5>Nature</h5>
                        </div>
                    </div>
					<div class="col-md-2 col-sm-2">
                        <div class="single-service">
                            <div class="single-icon">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/4.png') ?>" class="primary-img" alt="">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/4-hover.png') ?>" class="secondary-img" alt="">
                            </div>
                            <h5>Heritage</h5>
                        </div>
                    </div>
					<div class="col-md-2 col-sm-2">
                        <div class="single-service">
                            <div class="single-icon">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/5.png') ?>" class="primary-img" alt="">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/5-hover.png') ?>" class="secondary-img" alt="">
                            </div>
                            <h5>City Tour</h5>
                        </div>
                    </div>
                    <div class="col-md-2 hidden-sm no-margin">
                        <div class="single-service">
                            <div class="single-icon">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/more-black.png') ?>" class="primary-img" alt="" width="60">
                                <img src="<?php echo $asset->getAssetForAdmin('images/icon/more-white.png') ?>" class="secondary-img" alt="" width="60">
                            </div>
                            <h5>More</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="blog-area section-padding grid-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h1>Sekilas <span>Profil</span> Kami</h1>
                            </div>
                            <?php $textTentangKami = "PT. Grahatour Indonesia adalah sebuah perusahaan yang menekankan pada layanan pariwisata yang berkualitas.
                                	Kami juga menawarkan kepada wisatawan untuk memilih paket wisata baik di Indonesia maupun Luar Negeri sesuai
                                	dengan keinginan dari perjalanan Anda.<br><br>
                                	Paket tour kami dirancang secara hati-hati dengan mempertimbangkan keamanan perjalanan klien kami dan juga dampak terhadap lingkungan sekitar.
                                	Kami juga ingin membantu klien kami untuk merencanakan dan merancang perjalanan sesuai dengan kebutuhannya mengunjungi Yogyakarta, Bali, dan
                                	seluruh destinasi yang ada di Indonesia dan Internasional.<br><br>
                                	Kami akan selalu berusaha melayani segala kebutuhan wisata Anda sebaik mungkin. Anda bisa mengunjungi website kami atau datang langsung ke kantor Grahatour
                                	untuk menentukan perjalanan Anda. Jika Anda tidak menemukan apa yang Anda cari, Anda cukup memberitahu kami apa yang ingin Anda lakukan dan destinasi mana
                                	yang Anda inginkan.<br><br>
                                	Kami akan mempersiapkan rencana perjalanan sesuai permintaan Anda sebagai bahan pertimbangan. Kami sangat senang bisa memenuhi segala kebutuhan perjalanan Anda."
                            ?>

                            <p style="text-align:justify"><?php echo $textTentangKami ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="partner-area section-bottom-padding" style="padding-top:100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h1>Our <span>Great</span> Moments</h1>
                            </div>
                            <p>Portofolio kami</p>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="widget_black-studio-tinymce">
							<div class="gallery gallery-columns-4 gallery-size-medium">
								<?php foreach ($portofolioDomainArray as $portofolioDomain): ?>
								<figure class="gallery-item">
									<a data-slb-internal="0" data-slb-active="1" data-slb-group="26" href="<?php echo $asset->getAssetForHome('gallery/portofolio/thumbs/'.$portofolioDomain->getImage()) ?>">
										<img src="<?php echo $asset->getAssetForHome('gallery/portofolio/thumbs/'.$portofolioDomain->getImage()) ?>" alt="" />
									</a>
								</figure>
								<?php endforeach ?>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>


	<?php echo $footerBar; ?>
	<?php echo $messageSession ?>
<?php echo $htmlFooter; ?>