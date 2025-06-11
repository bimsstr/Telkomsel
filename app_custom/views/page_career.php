<?php echo $htmlHeader; ?>
<?php echo $headerBar ?>
<!-- =========== Start of Hero ============ -->
<section class="space-bottom hero hero--dark hidden">
	<?php if (count($homecareertitleDomainArray) == 0) : ?>
		<p>tidak ada data</p>
	<?php endif; ?>
	<?php foreach($homecareertitleDomainArray as $homecareertitleDomain) :?>
		<div class="background-holder">
			<img src="<?php echo $asset->getAssetForAdmin('images/career_title/'.$homecareertitleDomain->getImage()) ?>" alt="<?php echo $homecareertitleDomain->getImage()?>" class="background-image-holder">
		</div>
	<?php endforeach;?>
	<!-- end of background image -->
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">
				<?php if (count($homecareertitleDomainArray) == 0) : ?>
					<p>tidak ada data</p>
				<?php endif; ?>
				<?php foreach($homecareertitleDomainArray as $homecareertitleDomain) :?>
					<div class="position-relative text-center">
						<div class="hero-content hero-content--center">
							<h1 class="hero__title"><?php echo $homecareertitleDomain->getTitle();?></h1>
							<p class="lead hero__description"><?php echo $homecareertitleDomain->getSubtitle();?></p>
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

<section id="features">
    <div class="my-wrapper3 color-white pt-40">
        <div class="col-12">
            <div class="row my-space-bottom reveal">
                <div class="col-12 col-md-6 col-lg-12 swipe-tab-content">
                	
                	<div class="card mb-20 ">
                        <blockquote class="card-body pl-50 pt-50 color-gray" style="padding-right:50px">
                        	<h3 class="font-w-400 text-center mb-10">WE ARE <strong class="color-primary">HIRING</strong></h3>
                        	<h5 class="text-center mb-40" style="font-size: 18px;" >We dare you to join our team ! Apply Now </h5>
                        	<h4 class="font-w400 mb-30">Values and Cultures <strong class="color-primary">That We Believe In</strong></h4>
                        	<div class="row justify-content-center"> 
                        	<?php if (count($homecareercultureDomainArray) == 0) : ?>
                        		<p>tidak ada data</p>
                    		<?php endif; ?>
                    		<?php foreach($homecareercultureDomainArray as $homecareercultureDomain) :?>                  
                    			<div class="col-12 col-md-3 col-lg-3 col-xl-3 reveal">
                        			<div class="card text-center mb-30 mb-md-0">
	                            		<div class="header pl-40 pr-40 py-5 border-bottom-light">
    	                            		<span class="mb-30 icon-rounded position-relative">
                                    			<img  src="<?php echo $asset->getAssetForAdmin('images/career_culture/thumbs/'.$homecareercultureDomain->getImage()) ?>" alt="<?php echo $homecareercultureDomain->getImage()?>">
                                			</span>
                                			<h5 class="mb-10"><?php echo $homecareercultureDomain->getTitle(); ?><br>
                                			<span class="color-primary"><?php echo $homecareercultureDomain->getDescription(); ?></span></h5>
                            			</div>
                        			</div>
                    			</div>
                    		<?php endforeach;?>
	                    	</div>
                    		<br>
                    		<br>
                        	<hr>
                        	<h3 class="font-w-400 mb-10 pt-20">AVAILABLE <strong class="color-primary">POSITION</strong></h3>
                        	<h6 class="font-w-400 mb-30">Saat ini kami membuka beberapa posisi sebagaimana tercantum di bawah ini, perlu job-seeker ketahui syarat-syarat apa yang harus dipenuhi yang juga telah tercantum sebagai berikut. Pastikan kamu menjadi salah satu kandidat yang kami cari. </h5>
                        	 <div class="row justify-content-start justify-content-sm-center pt-50 pb-50" style="background-color: white;">
            					<div class="col-12 col-md-6 col-lg-12 col-xl-12">
                					<div class="row justify-content-start justify-content-sm-center reveal">
        								<?php if (count($homecareerDomainArray) == 0) : ?>
                            				<p>tidak ada data</p>
                        				<?php endif; ?>
                        				<?php $counter = 0; foreach($homecareerDomainArray as $namaCategory => $homecareerlistDomain) :?>
                        				<?php foreach($homecareerlistDomain as $homecareerDomain) : ?>
                    					<div class="col-6 col-lg-3 col-sm-4 col-xl-2 mb-30 mb-sm-0 ">
                        					<a href="#career<?php echo $counter ?>" data-toggle="collapse" class="card card--outline btn-3d-hover btn-splash-hover transition-default text-center px-2 bg-color-primary">
                            					<span class="mb-10 pb-20 pt-20 d-flex justify-content-center align-items-center">
	                                				<img src="<?php echo $asset->getAssetForAdmin('images/career/'.$homecareerDomain->getImage()) ?>" alt="<?php echo $homecareerDomain->getImage()?>">
                            					</span>
                            					<p class="text-uppercase font-w-700 color-white pb-2"><?php echo $homecareerDomain->getCategory();?>
                            					</p>
                            					
                        					</a>
                        					<!-- end of card -->
                    					</div>
                    					<!-- end of col -->
                    					<div class="collapse" id="career<?php echo $counter++ ?>">
                        					<blockquote class="card-body pb-30 pl-50 pr-50">
                            					<h6 class="font-w-400" style="font-size: 14px"><?php echo $homecareerDomain->getDescription(); ?></h6>
                        					</blockquote>
                    					</div>
                    					<?php endforeach;?>
                    					<?php endforeach;?>
                    				</div>
        						</div>	
        					</div>
    						<div class="row bg-color-primary mt-50 pb-30">
            					<div class="col-12 col-md-8 col-lg-9 col-xl-9 mt-30 mb-10 ml-30">
                					<blockquote class="blockquote">
                    					<h6 class="font-w-400 lead">Kirim surat lamaran melalui email <i style="font-style:italic;" class="material-icons middle center">mail_outline</i> karir@grahatour.com <br>Cantumkan kode posisi ke subyek email<br>Unduh Dokumen Lamaran : 
                						</h6>
                					</blockquote>
                					<h5>
                						<a href="#" class="btn btn--transparent p-0 btn--arrow-after btn-border-hover color-white">
                							<span class="btn__text mr-30">Download Here</span>
                						</a> 
                					</h5> 
            					</div>
            					<div class="col-12 col-md-2 col-lg-1 col-xl-1 mt-100 mb-30 ml-100" style="align-content: middle">
                					<a href="<?php echo $urlBuilder->build('proses-registrasi');?>" class="btn btn--sm btn--bg-white btn--color-primary btn-3d-hover btn-splash-hover"><span class="btn__text">APPLY NOW</span></a>
            					</div>
        					</div>
		                </blockquote>
                    </div>                            
                </div>
                <!-- end of col  -->
            </div>
        <!-- </div> -->
        </div>
    </div>
<!-- end of container -->
</section>
		<?php echo $footerBar; ?>
		<?php echo $messageSession ?>
		<?php echo $htmlFooter; ?>