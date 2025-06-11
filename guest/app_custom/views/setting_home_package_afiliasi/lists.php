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
                                <h4 class="page-title">HOME PACKAGE</h4>
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
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="#" onClick="return false;" class="dropdown-toggle" data-toggle="dropdown"
                                        role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="<?php echo $urlBuilder->build('setting-home-package-afiliasi/add')?>">Tambah</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            <h2><strong>Home Package</strong> Afiliasi</h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Package By</th>
                                        <th>Package Image</th>
                                        <th>Package Name</th>
                                        <th>Package Category</th>
                                        <th>Package Speed</th>
                                        <th>Package Description</th>
                                        <th>Package Keterangan</th>
                                        <th>Ditampilkan ?</th>
                                        <th>Package Price</th>
                                        <th>Created Date</th>
                                        <th>Package Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($homepackageafiliasiDomainArray) == 0) : ?>
                                        <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                    <?php endif; ?>
                                    <?php
                                    foreach($homepackageafiliasiDomainArray as $homepackageafiliasiDomain) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo ++$no4 ?></td>
                                            <td>
                                                <img src="<?php echo $asset->getAssetForAdmin('images/afiliasi/thumbs/'.$homepackageafiliasiDomain->getPackageImage()) ?>" alt="<?php echo $homepackageafiliasiDomain->getPackageImage()?>"></td>
                                            <td style="text-align:center;"><?php echo $homepackageafiliasiDomain->getPackageBy();?></td>
                                            <td style="text-align:center;"><?php echo $homepackageafiliasiDomain->getPackageName();?></td>
                                            <td style="text-align:center;"><?php echo $homepackageafiliasiDomain->getPackageCategory();?></td>
                                            <td style="text-align:center;"><?php echo $homepackageafiliasiDomain->getPackageSpeed();?></td>
                                            <td style="text-align:center;"><?php echo $homepackageafiliasiDomain->getPackageDescription();?></td>
                                            <td style="text-align:center;"><?php echo $homepackageafiliasiDomain->getPackageKeterangan();?></td>
                                            <td style="text-align:center;"><?php echo $homepackageafiliasiDomain->getShowLandingPage();?></td>
                                            <td style="text-align:center;"><?php echo $homepackageafiliasiDomain->getPackagePrice();?></td>
                                            <td style="text-align:center;"><?php echo $homepackageafiliasiDomain->getCreatedDate();?></td>
                                            <td style="text-align:center"><?php echo $homepackageafiliasiDomain->getPackageStatus() == 'active' ? '<span class="label label-success">active</span>' : '<span class="label label-danger">inactive</span>'; ?>
                                            </td>

                                            <td class="t-detail-agent" style="width: 150px; text-align: center">
                                                <button class="btn tblEditBtn">
                                                    <a href="<?php echo $urlBuilder->build('setting-home-package-afiliasi/edit', 'id='.$homepackageafiliasiDomain->getId(), TRUE) ?>" data-placement="bottom" data-original-title="Edit"><i class="material-icons">mode_edit</i>
                                                </button>
                                                <button class="btn tblDelBtn">
                                                    <a class="del" href="javascript:void(0)" data-url="<?php echo $urlBuilder->build('setting-home-package-afiliasi/delete') ?>" data-value="<?php echo $homepackageafiliasiDomain->getId() ?>" data-text="Anda yakin akan menghapus data?" data-placement="bottom" data-original-title="Hapus"><i class="material-icons">delete</i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                            <div class="col-md-6" style="padding-left: 15px;">
                                    <?php if(count($homepackagecategoryDomainArray) > 0) : ?>
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