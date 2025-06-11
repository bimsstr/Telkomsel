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
                                <h4 class="page-title">ADMINISTRATOR<small style="font-size: 15px"> Tambah Baru</small></h4>
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
                            <h2><strong>Tambah </strong>Admin</h2>
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
                                                    placeholder="Enter your name" name="admin_name">
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
                                                    placeholder="Enter your staff position" name="admin_position">
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
                                                    placeholder="Enter your email address" name="admin_email">
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
                                                    placeholder="Enter your phone number" name="admin_phone">
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
                                                <textarea style="height: 200px" name="admin_address"></textarea>
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
                                                <textarea style="height: 200px" name="admin_about"></textarea>
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
                                                        <input class="form-control file-path validate" type="text" placeholder="Upload Files Image - Admin Photo (sz : px)">
                                                    </div>
                                                    <?php echo $validationErrorsRenderer->renderToAdminHtml('admin_image') ?>
                                                    <img id='img-upload2' style="width: 20%" />
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
                                                    placeholder="Enter your username" name="admin_username">
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
                                        <label for="sa">Tier</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <select class="browser-default" name="admin_tier">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="1">sales</option>
                                                    <option value="2">superuser</option>
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
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
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
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="process" value="add_admin">TAMBAH</button>
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