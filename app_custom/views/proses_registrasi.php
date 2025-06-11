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

                        <span class="col-lg-5">
                            <span class="middle center">
                                <h6 class="h6-test"><i class="material-icons middle center">person_add</i> REGISTRASI</h6>
                            </span>
                        </span>
                    </div>

                    <div class="column col-lg-6">
                        <span class="col-lg-6">
                        </span>
                    
                        <span class="col-lg-5">
                            <span class="middle center color-primary">
                                <a href=""><h6 class="h6-test middle center font-12"><i class="h6-test material-icons middle center">exit_to_app</i> Home</h6> </a>
                            </span>
                            <span class="middle center color-primary">
                                <h6 class="color-primary middle center font-12"><i class="middle center material-icons">exit_to_app</i> Registrasi</h6>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

	<section class="space-top-md bg-white" id="features">
        <div class="my-wrapper color-gray">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-7 col-xl-6 mx-auto">
                    <div class="section-title reveal text-center mb-80">
                        <br>
                        <br>
                        <h3 class="font-w-400">FORM <strong class="color-primary">REGISTRASI</strong></h3>
                        <p class="font-w-800">Isilah form pemesanan dibawah ini dengan data yang valid dan benar</p>
                    </div>
                </div>
            </div>
            <!-- end of row -->
            <div class="row my-space-bottom my-border-bottom reveal">
                <!-- end of col -->
                <div class="col-12 col-md-12 col-lg-12 mb-10 mb-lg-0">
                    <div class="features" >
                        <form method="POST" autocomplete="off">
                            <div class="d-flex mb-20">
                                <h6 class="color-primary">Data Akun</h6>
                            </div>
                            	<div class="row mb-10">
                            		<div class="col-sm-3">
                            			<div class="form-group">
											<label for="select-paket"><i class="text-danger">*</i> Paket Keagenan</label>
											<select name="agen_paket" id="pili-paket-agen" class="form-control">					
												<option value="paket_basic">Basic</option>
												<option value="paket_pro">Pro</option>
												<option value="paket_bisnis">Bisnis</option>
												<option value="paket_bisnis">Master</option>
											</select>
										</div>
                            		</div>
                            		<div class="col-md-4">
                            			<div class="form-group mb-20">
                                			<label class="label-control mb-10" for="username_agen"><i class="text-danger">*</i> Username</label>
                                			<input type="text" class="form-control" id="input-username-agen" name="agen_username" value="<?php echo set_value('agen_username');?>" >
                                            <?php echo $validationErrorsRenderer->renderToHtml('agen_username') ?>
                            			</div>
                            		</div>
                            		<div class="col-md-5">
                            			<div class="form-group mb-20">
                                			<label class="label-control mb-10" for="email_agen"><i class="text-danger">*</i> Email</label>
                                			<input type="email" class="form-control" id="input-email-agen" name="agen_email" value="<?php echo set_value('agen_email');?>">
                                            <?php echo $validationErrorsRenderer->renderToHtml('agen_email') ?>
                            			</div>
                            		</div>
                            	</div>
                            	<div class="my-border-bottom"></div>
                                <div class="d-flex mt-20 mb-20">
                                    <h6 class="color-primary">Data Pribadi</h5>
                                </div>
                            	<div class="row">
                            		<div class="col-lg-6">
                            			<div class="form-group mb-20">
                                			<label class="label-control mb-10" for="namalengkap_agen"><i class="text-danger">*</i> Nama Lengkap</label>
                                			<input type="text" class="form-control" id="input-nama-agen" name="agen_nama" style="width: 118%" value="<?php echo set_value('agen_nama');?>" >
                                            <?php echo $validationErrorsRenderer->renderToHtml('agen_nama') ?>
                            			</div>
                            		</div>
                            	</div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-20">
                                            <label class="label-control mb-10" for="nophone1_agen"><i class="text-danger">*</i> Nomor Handphone</label>
                                            <input type="text" class="form-control allow_only_numbers" id="input-nophone1-agen" name="agen_nophone1" value="<?php echo set_value('agen_nophone1');?>">
                                            <?php echo $validationErrorsRenderer->renderToHtml('agen_nophone1') ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-20">
                                            <label class="label-control mb-10" for="nophone2_agen"> Nomor Handphone (secondary)</label>
                                            <input type="text" class="form-control allow_only_numbers" id="input-nophone2-agen" name="agen_nophone2" placeholder="optional" value="<?php echo set_value('agen_nophone2');?>">
                                            <?php echo $validationErrorsRenderer->renderToHtml('agen_nophone2') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7" style="width: 100%">
                                        <div class="form-group mb-20">
                                            <label class="label-control mb-10" for="alamat_agen"><i class="text-danger">*</i> Alamat</label>
                                            <textarea id="input-alamat-agen" name="agen_alamat" class="form-control mt-12" style="height: 10rem;width: 42.3rem"></textarea>
                                            <?php echo $validationErrorsRenderer->renderToHtml('agen_alamat') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-20">
                                    <div class="col-md-3">
                                        <div class="form-group mb-20">
                                            <label class="label-control mb-10" for="propinsi_agen"><i class="text-danger">*</i> Propinsi</label>
                                            <select class="form-control" name="agen_provinsi" data-placeholder="Pilih Provinsi" id="input-propinsi-agen">
                                                <option value="1">Aceh</option>
                                                <option value="2">Sumatera Utara</option>
                                                <option value="3">Sumatera Barat</option>
                                                <option value="4">Riau</option>
                                                <option value="5">Kep. Riau</option>
                                                <option value="6">Kep. Bangka Belitung</option>
                                                <option value="7">Jambi</option>
                                                <option value="8">Sumatera Selatan</option>
                                                <option value="9">Bengkulu</option>
                                                <option value="10">Lampung</option>
                                                <option value="11">DKI Jakarta</option>
                                                <option value="12">Jawa Barat</option>
                                                <option value="13">Banten</option>
                                                <option value="14">Jawa Tengah</option>
                                                <option value="15">DI Yogyakarta</option>
                                                <option value="16">Jawa Timur</option>
                                                <option value="17">Kalimantan Barat</option>
                                                <option value="18">Kalimantan Tengah</option>
                                                <option value="19">Kalimantan Utara</option>
                                                <option value="20">Kalimantan Timur</option>
                                                <option value="21">Kalimantan Selatan</option>
                                                <option value="22">Bali</option>
                                                <option value="23">Nusa Tenggara Barat</option>
                                                <option value="24">Nusa Tenggara Timur</option>
                                                <option value="25">Sulawesi Utara</option>
                                                <option value="26">Gorontalo</option>
                                                <option value="27">Sulawesi Tengah</option>
                                                <option value="28">Sulawesi Barat</option>
                                                <option value="29">Sulawesi Selatan</option>
                                                <option value="30">Sulawesi Tenggara</option>
                                                <option value="31">Maluku Utara</option>
                                                <option value="32">Maluku</option>
                                                <option value="33">Papua Barat</option>
                                                <option value="34">Papua / Irian Jaya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-20">
                                            <label class="label-control mb-10" for="namausaha_agen"><i class="text-danger">*</i> Nama Usaha</label>
                                            <input type="text" class="form-control" id="input-perusahaan-agen" name="agen_perusahaan">
                                            <?php echo $validationErrorsRenderer->renderToHtml('agen_perusahaan') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-border-bottom"></div>
                                <div class="d-flex mt-20 mb-20">
                                <h6 class="color-primary">Informasi Lainnya</h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-20">
                                            <label class="label-control mb-10" for="kp">Kode Promo :</label>
                                            <input type="text" class="form-control" id="input-kode-promo" name="kode_promo">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-20">
                                            <label class="label-control mb-10" for="info_dari_agen"> Info Keagenan Dari : </label>
                                            <input type="text" class="form-control" id="input-agen-infodari" name="agen_infodari">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="select-paket">Bersedia Dihubungi Pada:</label>
                                            <select name="agen_pilihjam" id="input-agen-hubungi" class="form-control">             
                                                <option value="jam_a">Pukul 08:00 - 10:00</option>
                                                <option value="jam_b">Pukul 10:00 - 12:00</option>
                                                <option value="jam_c">Pukul 12:00 - 14:00</option>
                                                <option value="jam_d">Pukul 14:00 - 16:00</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                    <!-- end of col -->
                <!-- end of row -->
            </div>
            <div class="row my-space-top-1 my-border-top ">
                <div class="col-md-9 mb-40">
                    <label>
                        <input type="checkbox" name="syarat_ketentuan" value="sk" id="termcondition"> 
                            Dengan menekan tombol berikut, Anda setuju dengan <span class="color-primary"><a href="<?php echo $urlBuilder->build('syarat-ketentuan')?>" class="color-primary"> Syarat & Ketentuan</a></span> yang berlaku pada Velosita</input>
                    </label>
                </div>
                <div class="col-md-3 text-right">
                    <div class="flex-row ml-lg-auto d-md-flex mr-70 mr-lg-0 d-none d-sm-inline-block"></div>
                    <button class="btn btn--sm my-btn-color my-text-white btn-3d-hover btn-splash-hover" type="submit" name="process" value="Daftar" id="submitButton" disabled>KIRIM PERMINTAAN</button>
                </div>

            </div>
        </form>
            <!-- end of container -->
    </section>
        <?php echo $footerBar; ?>
    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>