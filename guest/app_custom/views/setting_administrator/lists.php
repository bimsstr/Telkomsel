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
                            <h2><strong>Keyword</strong> Pencarian</h2>
                            <!-- Inline Layout | With Floating Label -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="body">
                                <form method="get">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="keyword_admin" value="<?php echo $keyword ?>">
                                                    <label class="form-label">KContact / Nama / No Hp</label>
                                                </div>
                                           </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">CARI</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                            <h2><strong>Admin</strong> Info</h2>
                        </div>
                         <div class="body table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Profile Image</th>
                                        <th>KContact</th>
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
                                            <a href="<?php echo $urlBuilder->build('setting-administrator/add')?>">Tambah</a>
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
                                        <th>KContact</th>
                                        <th>Fullname</th>
                                        <th>Address</th>
                                        <th>About</th>
                                        <th>Created Date</th>
                                        <th>Tier</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
                                            <td style="text-align:center;"><?php echo ++$no1 ?></td>
                                            <td><?php echo $adminDomain->getUsername(); ?></td>
                                            <td><?php echo $adminDomain->getFullname(); ?></td>
                                            <td style="text-align:center">
                                                <?php echo $adminDomain->getAddress(); ?>
                                            </td>
                                             <td style="text-align:center">
                                                <?php echo $adminDomain->getAbout(); ?>
                                            </td>
                                            <td><?php echo $adminDomain->getCreatedDate(); ?></td>
                                            <td><?php echo $adminDomain->getTier(); ?></td>
                                            <td style="text-align:center"><?php echo $adminDomain->getStatus() == 'active' ? '<span class="label label-success">active</span>' : '<span class="label label-danger">inactive</span>'; ?>
                                            </td>
                                            <td class="t-detail-agent" style="width: 150px; text-align: center">
                                                <button class="btn tblEditBtn">
                                                    <a href="<?php echo $urlBuilder->build('setting-administrator/edit', 'id='.$adminDomain->getId(), TRUE) ?>" data-placement="bottom" data-original-title="Edit"><i class="material-icons">mode_edit</i>
                                                </button>
                                                <button class="btn tblDelBtn">
                                                    <a class="del" href="javascript:void(0)" data-url="<?php echo $urlBuilder->build('setting-administrator/delete', 'package_by='.$adminDomain->getUsername(), TRUE) ?>" data-value="<?php echo $adminDomain->getId() ?>" data-text="Anda yakin akan menghapus data?" data-placement="bottom" data-original-title="Hapus"><i class="material-icons">delete</i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                            <div class="col-md-6" style="padding-left: 15px;">
                                <?php if(count($adminDomainArray) > 0) : ?>
                                    Total Data : <strong><?php echo ($jumlahData > $maxData ? $maxData : $jumlahData); ?></strong>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6">
                                <?php echo $pagination->renderAdminPage(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
        </div>
    </section>

    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>