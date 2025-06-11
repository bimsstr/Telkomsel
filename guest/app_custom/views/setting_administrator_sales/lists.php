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
                                <h4 class="page-title">ADMINISTRATOR</h4>
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
                        
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Admin</strong> Info</h2>
                        </div>
                         <div class="body table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Profile Image</th>
                                        <th>Username</th>
                                        <th>Fullname</th>
                                        <th>Staff Position</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($adminDomainArray) == 0) : ?>
                                        <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                    <?php endif; ?>
                                    <?php
                                    foreach($adminDomainArray as $adminDomain) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo ++$no ?></td>
                                            <td style="text-align:center;" >
                                                <img src="<?php echo $asset->getAssetForAdmin('images/profile/thumbs/'.$adminDomain->getImage()) ?>" alt="<?php echo $adminDomain->getImage()?>" style ="width: 40%;">
                                            </td>
                                            <td><?php echo $adminDomain->getUsername(); ?></td>
                                            <td><?php echo $adminDomain->getFullname(); ?></td>
                                            <td><?php echo $adminDomain->getPosition(); ?></td>
                                            <td><?php echo $adminDomain->getPhone(); ?></td>
                                            <td><?php echo $adminDomain->getEmail(); ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->

            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="#" onClick="return false;" class="dropdown-toggle" data-toggle="dropdown"
                                        role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="<?php echo $urlBuilder->build('setting-administrator-sales/add')?>">Tambah</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            <h2><strong>Admin</strong> Detail</h2>
                        </div>
                         <div class="body table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Address</th>
                                        <th>About</th>
                                        <th>Created Date</th>
                                        <th>Star</th>
                                        <th>Tier</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($adminDomainArray) == 0) : ?>
                                        <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                    <?php endif; ?>
                                    <?php
                                    foreach($adminDomainArray as $adminDomain) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo ++$no2 ?></td>
                                            <td style="text-align:center">
                                                <?php echo $adminDomain->getAddress(); ?>
                                            </td>
                                             <td style="text-align:center">
                                                <?php echo $adminDomain->getAbout(); ?>
                                            </td>
                                            <td><?php echo $adminDomain->getCreatedDate(); ?></td>
                                            <td>
                                                <ul class="list-inline team-social social-icon mt-4 text-white">
                                                    <li class="list-inline-item">
                                                        <?php for( $i = 0; $i < $adminDomain->getStar(); $i++ ){
                                                            echo '<img src="asset/img/star.png" alt="star" style="width:20px">';
                                                        } ?>   
                                                    </li>
                                                </ul>
                                            </td>
                                            <td><?php echo $adminDomain->getTier(); ?></td>
                                            <td style="text-align:center"><?php echo $adminDomain->getStatus() == 'active' ? '<span class="label label-success">active</span>' : '<span class="label label-danger">inactive</span>'; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                                <div class="col-md-6" style="padding-left: 15px;">
                                    <?php if(count($adminDomainArray) > 0) : ?>
                                        Total Data : <strong><?php echo ($jumlahData > $maxData ? $maxData : $jumlahData); ?></strong>
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php echo $pagination->renderAdminPage(); ?>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
        </div>
    </section>
    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>