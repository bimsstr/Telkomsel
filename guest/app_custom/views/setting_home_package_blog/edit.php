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
                                <h4 class="page-title">HOME PACKAGE BLOG<small style="font-size: 15px"> Edit Package Blog</small></h4>
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
                            <h2><strong>Edit </strong>Package Blog</h2>
                        </div>
                        <div class="body">
                            <form  method="POST" action="" autocomplete="OFF" class="form-horizontal" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Package Category</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="browser-default" name="package_category">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <?php
                                                    if (count($homepackagecategoryDomainArray) == 0) : ?>
                                                        <option value="0">tidak ada data</option>
                                                    <?php endif; ?>
                                                    <?php foreach($homepackagecategoryDomainArray as $homepackagecategoryDomain) :?>
                                                        <option <?php echo $homepackagecategoryDomain->getCategory() == $homepackageblogDomain->getPackageCategory() ? "selected" : ""  ?> value="<?php echo $homepackagecategoryDomain->getCategory(); ?>" ><?php echo $homepackagecategoryDomain->getCategory(); ?> </option>
                                                        
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('package_category') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="description">Package Description</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea class="ckeditor" id="editor-standar" style="height: 200px" name="package_description"><?php echo $homepackageblogDomain->getPackageDescription() ?></textarea>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('package_description') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="description">Package Syarat Ketentuan</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea class="ckeditor" id="editor-standar" style="height: 200px" name="package_sk"><?php echo $homepackageblogDomain->getPackageSK() ?></textarea>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('package_sk') ?>
                                        </div>
                                    </div>
                                </div>                          
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="uname">Image</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group <?php echo $validationErrorsRenderer->renderToAdminHtml('package_image') == '' ? '' : ' error' ?>" >
                                            <div class="form-line">
                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>File</span>
                                                             <input type="file" name="package_image" id="imgInp1">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="form-control file-path validate" type="text" placeholder="Upload Files Image - Package Image (sz : px)" value="<?php echo $homepackageblogDomain->getPackageImage() ?>" name="package_image">
                                                    </div>
                                                    <?php echo $validationErrorsRenderer->renderToAdminHtml('package_image') ?>
                                                    <br>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <span>Image Old :</span>
                                                        <br>
                                                        <img id='img-upload4' src="<?php echo $asset->getAssetForAdmin('images/package_blog/'.$homepackageblogDomain->getPackageImage()) ?>" alt="<?php echo $homepackageblogDomain->getPackageImage()?>" style="width:40%" />
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
                                        <label for="sa">Package Status</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="package_status">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="active" <?php echo $homepackageblogDomain->getPackageStatus() == "active" ? "selected" : "" ?>>Active</option>
                                                    <option value="inactive" <?php echo $homepackageblogDomain->getPackageStatus() == "inactive" ? "selected" : "" ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('package_status') ?>
                                        </div>
                                    </div>
                                </div>  
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <input type="checkbox" id="remember_me_4" class="filled-in">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="process" value="edit_homepackageblog">EDIT HOME PACKAGE BLOG</button>
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