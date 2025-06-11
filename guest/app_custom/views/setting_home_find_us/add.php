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
                                <h4 class="page-title">Home Find Us<small style="font-size: 15px"> Tambah Find Us Detail</small></h4>
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
                            <h2><strong>Tambah </strong>Find Us Detail</h2>
                        </div>
                        <div class="body">
                            <form  method="POST" action="" autocomplete="OFF" class="form-horizontal" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Title</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nama" class="form-control"
                                                    placeholder="Enter find us title" name="fu_title">
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('fu_title') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="description">Description</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea name="fu_description" style="height: 200px"></textarea>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('fu_description') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="uname">Image Background</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group <?php echo $validationErrorsRenderer->renderToAdminHtml('fu_image_bg') == '' ? '' : ' error' ?>" >
                                            <div class="form-line">
                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>File</span>
                                                             <input type="file" name="fu_image_bg" id="imgInp2">
                                                    </div>
                                                    
                                                    <div class="file-path-wrapper">
                                                        <input class="form-control file-path validate" type="text" placeholder="Upload Files Image - Find Us Image - Background (sz : px)">
                                                    </div>
                                                    <?php echo $validationErrorsRenderer->renderToAdminHtml('fu_image_bg') ?>
                                                    <img id='img-upload2' style="height: :40%" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="uname">Image</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group <?php echo $validationErrorsRenderer->renderToAdminHtml('fu_image') == '' ? '' : ' error' ?>" >
                                            <div class="form-line">
                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>File</span>
                                                             <input type="file" name="fu_image" id="imgInp">
                                                    </div>
                                                    
                                                    <div class="file-path-wrapper">
                                                        <input class="form-control file-path validate" type="text" placeholder="Upload Files Image - Find Us Image (sz : px)">
                                                    </div>
                                                    <?php echo $validationErrorsRenderer->renderToAdminHtml('fu_image') ?>
                                                    <img id='img-upload' style="height: :40%" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="sa">AppStore Status</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="appstore_status">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('appstore_status') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="sa">PlayStore Status</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="playstore_status">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('playstore_status') ?>
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
                                                 <select class="browser-default" name="fu_status">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('fu_status') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <input type="checkbox" id="remember_me_4" class="filled-in">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="process" value="add_homefindus">TAMBAH FIND US DETAIL</button>
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