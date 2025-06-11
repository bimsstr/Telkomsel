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
                                <h4 class="page-title">HOME CONTACT<small style="font-size: 15px"> Edit Contact Detail</small></h4>
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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Edit </strong>Contact Detail</h2>
                        </div>
                        <div class="body">
                            <form  method="POST" action="" autocomplete="OFF" class="form-horizontal" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="title">Description</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea name="hc_description" style="height: 200px"><?php echo $homecontactDomain->getDescription() ?></textarea>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_description') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="title">Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea name="hc_address" style="height: 200px"><?php echo $homecontactDomain->getAddress() ?></textarea>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_address') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="title">Telephone</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nama" class="form-control"
                                                    placeholder="Enter for find us title here" name="hc_telephone" value="<?php echo $homecontactDomain->getTelephone() ?>">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_telephone') ?>
                                        </div>
                                    </div>
                                </div>  

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="title">Email</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nama" class="form-control"
                                                    placeholder="Enter for find us title here" name="hc_email" value="<?php echo $homecontactDomain->getEmail() ?>">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_email') ?>
                                        </div>
                                    </div>
                                </div> 

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="title">Facebook</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nama" class="form-control"
                                                    placeholder="Enter for find us title here" name="hc_fb" value="<?php echo $homecontactDomain->getFbUrl() ?>">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_fb') ?>
                                        </div>
                                    </div>
                                </div>             

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="sa">Facebook Status</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="hc_fb_status">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="active" <?php echo $homecontactDomain->getFbStatus() == "active" ? "selected" : "" ?>>Active</option>
                                                    <option value="inactive" <?php echo $homecontactDomain->getFbStatus() == "inactive" ? "selected" : "" ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_fb_status') ?>
                                        </div>
                                    </div>
                                </div>    


                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="title">Instagram</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nama" class="form-control"
                                                    placeholder="Enter for find us title here" name="hc_ig" value="<?php echo $homecontactDomain->getIgUrl() ?>">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_ig') ?>
                                        </div>
                                    </div>
                                </div>             

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="sa">Instagram Status</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="hc_ig_status">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="active" <?php echo $homecontactDomain->getIgStatus() == "active" ? "selected" : "" ?>>Active</option>
                                                    <option value="inactive" <?php echo $homecontactDomain->getIgStatus() == "inactive" ? "selected" : "" ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_ig_status') ?>
                                        </div>
                                    </div>
                                </div>        

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="title">Twitter</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nama" class="form-control"
                                                    placeholder="Enter for find us title here" name="hc_twitter" value="<?php echo $homecontactDomain->getTwitterUrl() ?>">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_twitter') ?>
                                        </div>
                                    </div>
                                </div>             

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="sa">Twitter Status</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="hc_twitter_status">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="active" <?php echo $homecontactDomain->getTwitterStatus() == "active" ? "selected" : "" ?>>Active</option>
                                                    <option value="inactive" <?php echo $homecontactDomain->getTwitterStatus() == "inactive" ? "selected" : "" ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_twitter_status') ?>
                                        </div>
                                    </div>
                                </div>   

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="uname">Logo Image</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_image') == '' ? '' : ' error' ?>" >
                                            <div class="form-line">
                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>File</span>
                                                             <input type="file" name="hc_image" id="imgInp1">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="form-control file-path validate" type="text" placeholder="Upload Files Image - Logo Image (sz : px)" value="<?php echo $homecontactDomain->getLogo() ?>" name="hc_image">
                                                    </div>
                                                    <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_image') ?>
                                                    <br>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <span>Image Old :</span>
                                                        <br>
                                                        <img id='img-upload4' src="<?php echo $asset->getAssetForAdmin('images/logo/'.$homecontactDomain->getLogo()) ?>" alt="<?php echo $homecontactDomain->getLogo()?>" style="width:40%" />
                                                        <br>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <span>Image New :</span>
                                                        <br>
                                                        <img id='img-upload1' style="width:40%" />
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
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
                                                 <select class="browser-default" name="hc_status">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="active" <?php echo $homecontactDomain->getStatus() == "active" ? "selected" : "" ?>>Active</option>
                                                    <option value="inactive" <?php echo $homecontactDomain->getStatus() == "inactive" ? "selected" : "" ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('hc_status') ?>
                                        </div>
                                    </div>
                                </div>  
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <input type="checkbox" id="remember_me_4" class="filled-in">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="process" value="edit_homecontact">EDIT CONTACT DETAIL</button>
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