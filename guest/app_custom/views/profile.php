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
                                <h4 class="page-title">Profile</h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Your content goes here  -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="m-b-20">
                            <div class="contact-grid">
                                <div class="profile-header bg-dark">
                                    <div class="user-name"><?php echo $adminDomainArray->getFullName();?></div>
                                    <div class="name-center"><?php echo $adminDomainArray->getPosition();?></div>
                                </div>
                                <img src="<?php echo $asset->getAssetForAdmin('images/profile/thumbs/'.$adminDomain->getImage()) ?>" class="user-img" alt="<?php echo $adminDomain->getImage()?>">
                                <p>
                                    <?php echo $adminDomainArray->getAddress();?>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="profile-tab-box">
                            <div class="p-l-20">
                                <ul class="nav ">
                                    <li class="nav-item tab-all">
                                        <a class="nav-link active show" href="#project" data-toggle="tab">About Me</a>
                                    </li>
                                    <li class="nav-item tab-all p-l-20">
                                        <a class="nav-link" href="#usersettings" data-toggle="tab">Settings</a>
                                    </li>
                                    <?php if($adminDomainArray->getTier() == "sales") : ?>
                                        <li class="nav-item tab-all p-l-20">
                                            <a class="nav-link" href="<?php echo $urlBuilder->build('setting-administrator-sales/edit', 'id='.$adminDomainArray->getId(), TRUE) ?>')?>">Edit profile</a>
                                        </li>';
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="project" aria-expanded="true">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card project_widget">
                                        <div class="header">
                                            <h2>About</h2>
                                        </div>
                                        <div class="body">
                                            <div class="row">
                                                <div class="col-md-3 col-6 b-r">
                                                    <strong>Nama Lengkap</strong>
                                                    <br>
                                                    <p class="text-muted"><?php echo $adminDomainArray->getFullname();?></p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r">
                                                    <strong>No HP</strong>
                                                    <br>
                                                    <p class="text-muted"><?php echo $adminDomainArray->getPhone();?></p>
                                                </div>
                                                <div class="col-md-4 col-6 b-r">
                                                    <strong>Email</strong>
                                                    <br>
                                                    <p class="text-muted"><?php echo $adminDomainArray->getEmail();?></p>
                                                </div>
                                            </div>
                                            <p class="m-t-30"><?php echo $adminDomainArray->getAbout();?>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="usersettings" aria-expanded="false">
                            <form method="POST" action="" autocomplete="OFF"  enctype="multipart/form-data">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>Security</strong> Settings</h2>
                                    </div>
                                    <div class="body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Username" value="<?php echo $adminDomainArray->getUsername(); ?>" name="username" disabled>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Current Password" name="old_password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="New Password" name="new_password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Retype New Password" name="newre_password">
                                        </div>
                                        <button type="submit" name="process" value="edit_password" class="btn btn-info btn-round">Save Changes</button>
                                    </div>
                            </div>
    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<?php echo $messageSession ?>
<?php echo $htmlFooter; ?>