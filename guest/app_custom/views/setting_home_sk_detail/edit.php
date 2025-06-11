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
                                <h4 class="page-title">Home Syarat dan Ketentuan<small style="font-size: 15px"> Edit Detail</small></h4>
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
                            <h2><strong>Edit </strong>Detail</h2>
                        </div>
                        <div class="body">
                            <form  method="POST" action="" autocomplete="OFF" class="form-horizontal" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="sa">Category</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="sk_category">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <?php
                                                    if (count($homeskDomainArray) == 0) : ?>
                                                        <option value="0">tidak ada data</option>
                                                    <?php endif; ?>
                                                    <?php foreach($homeskDomainArray as $homeskDomain) :?>
                                                        <option <?php echo $homeskDomain->getCategory() == $homeskdetailDomain->getCategory() ? "selected" : ""  ?> value="<?php echo $homeskDomain->getCategory(); ?>" ><?php echo $homeskDomain->getCategory(); ?> </option>
                                                        
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('sk_category') ?>
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
                                                <textarea class="ckeditor" id="editor-standar" style="height: 200px" name="sk_description"><?php echo $homeskdetailDomain->getDescription() ?></textarea>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('sk_description') ?>
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
                                                <select class="browser-default" name="sk_status">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="active" <?php echo $homeskdetailDomain->getStatus() == "active" ? "selected" : "" ?>>Active</option>
                                                    <option value="inactive" <?php echo $homeskdetailDomain->getStatus() == "inactive" ? "selected" : "" ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <?php echo $validationErrorsRenderer->renderToAdminHtml('sk_status') ?>
                                        </div>
                                    </div>
                                </div>  
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <input type="checkbox" id="remember_me_4" class="filled-in">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="process" value="edit_homeskdetail">EDIT S&K Detail</button>
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