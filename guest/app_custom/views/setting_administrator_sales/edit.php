<?php echo $htmlHeader; ?>
    <?php echo $headerBar; ?>
    <?php echo $sideBar; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Sales<small style="font-size: 15px"> Edit Profile</small></h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                    <div class="header">
                        <p> <?php echo $breadcrumb ?></p>                   
                    </div>
                </div>
            </div>
             <!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Edit </strong>Sales</h2>
                        </div>
                        <div class="body">
                            <form method="POST" action="" autocomplete="OFF" class="form-horizontal" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Full Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nama" class="form-control"
                                                    placeholder="Enter your name" name="admin_name" value="<?php echo $adminDomain->getFullname()?>">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_name') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Staff Position</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nama" class="form-control"
                                                    placeholder="Enter your staff position" name="admin_position" value="<?php echo $adminDomain->getPosition()?>">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_position') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="email" class="form-control"
                                                    placeholder="Enter your email address" name="admin_email" value="<?php echo $adminDomain->getEmail()?>">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_email') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="uname">Phone</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="username" class="form-control"
                                                    placeholder="Enter your phone number" name="admin_phone" value="<?php echo $adminDomain->getPhone()?>">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_phone') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email">Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea style="height: 200px" name="admin_address"><?php echo $adminDomain->getAddress()?></textarea>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_address') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email">About</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea style="height: 200px" name="admin_about"><?php echo $adminDomain->getAbout()?></textarea>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_about') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="uname">Image</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_image') == '' ? '' : ' error' ?>" >
                                            <div class="form-line">
                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>File</span>
                                                             <input type="file" name="admin_image" id="imgInp2">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="form-control file-path validate" type="text" placeholder="Upload Files Image - Admin Image (sz : px)" value="<?php echo $adminDomain->getImage() ?>" name="admin_image">
                                                    </div>
                                                    <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_image') ?>
                                                    <br>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <span>Image Old :</span>
                                                        <br>
                                                        <img id='img-upload4' src="<?php echo $asset->getAssetForAdmin('images/profile/'.$adminDomain->getImage()) ?>" alt="<?php echo $adminDomain->getImage()?>" style="width:20%" />
                                                        <br>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <span>Image New :</span>
                                                        <br>
                                                        <img id='img-upload2' style="width:20%" />
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="uname">Username</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="username" class="form-control"
                                                    placeholder="Enter your username" name="admin_username" value="<?php echo $adminDomain->getUsername()?>" disabled>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_username') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="pw">Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="password" class="form-control"
                                                    placeholder="Enter your password" name="admin_password">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_password') ?>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="sa">Bintang</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="admin_star">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="1" <?php echo $adminDomain->getStar() == "1" ? "selected" : "" ?>>1</option>
                                                    <option value="2" <?php echo $adminDomain->getStar() == "2" ? "selected" : "" ?>>2</option>
                                                    <option value="3" <?php echo $adminDomain->getStar() == "3" ? "selected" : "" ?>>3</option>
                                                    <option value="4" <?php echo $adminDomain->getStar() == "4" ? "selected" : "" ?>>4</option>
                                                    <option value="5" <?php echo $adminDomain->getStar() == "5" ? "selected" : "" ?>>5</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_star') ?>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="sa">Tier</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="admin_tier">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="sales" <?php echo $adminDomain->getTier() == "sales" ? "selected" : "" ?>>sales</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_tier') ?>
                                        </div>
                                    </div>
                                </div> 
                               <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="sa">Status</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="admin_status">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="active" <?php echo $adminDomain->getStatus() == "active" ? "selected" : "" ?>>Active</option>
                                                    <option value="inactive" <?php echo $adminDomain->getStatus() == "inactive" ? "selected" : "" ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_status') ?>
                                        </div>
                                    </div>
                                </div>  

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <input type="checkbox" id="remember_me_4" class="filled-in">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="process" value="edit_sales">EDIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Horizontal Layout -->
           
        </div>
    </section>
    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>