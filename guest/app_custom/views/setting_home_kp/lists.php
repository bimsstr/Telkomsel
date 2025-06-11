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
                                <h4 class="page-title">HOME KEBIJAKAN PRIVASI</h4>
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
                                            <a href="<?php echo $urlBuilder->build('setting-home-kp-title/add')?>">Tambah</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <h2><strong>Home Kebijakan Privasi</strong> Title</h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($homekptitleDomainArray) == 0) : ?>
                                        <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                    <?php endif; ?>
                                    <?php
                                    foreach($homekptitleDomainArray as $homekptitleDomain) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo ++$no2 ?></td>
                                            <td><?php echo $homekptitleDomain->getDescription(); ?></td>
                                            <td><?php echo $homekptitleDomain->getCreatedDate(); ?></td>
                                            <td style="text-align:center"><?php echo $homekptitleDomain->getStatus() == 'active' ? '<span class="label label-success">active</span>' : '<span class="label label-danger">inactive</span>'; ?>
                                            </td>
                                            <td class="t-detail-agent" style="width: 150px; text-align: center">
                                                <button class="btn tblEditBtn">
                                                    <a href="<?php echo $urlBuilder->build('setting-home-kp-title/edit', 'id='.$homekptitleDomain->getId(), TRUE) ?>" data-placement="bottom" data-original-title="Edit"><i class="material-icons">mode_edit</i>
                                                </button>
                                                <button class="btn tblDelBtn">
                                                    <a class="del" href="javascript:void(0)" data-url="<?php echo $urlBuilder->build('setting-home-kp-title/delete') ?>" data-value="<?php echo $homekptitleDomain->getId() ?>" data-text="Anda yakin akan menghapus data?" data-placement="bottom" data-original-title="Hapus"><i class="material-icons">delete</i>
                                                </button>
                                            </td>
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
            <!--#END# Basic Table -->     

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
                                            <a href="<?php echo $urlBuilder->build('setting-home-kp/add')?>">Tambah</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <h2><strong>Home Kebijakan Privasi</strong> Category</h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($homekpDomainArray) == 0) : ?>
                                        <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                    <?php endif; ?>
                                    <?php
                                    foreach($homekpDomainArray as $homekpDomain) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo ++$no3 ?></td>
                                            <td><?php echo $homekpDomain->getCategory(); ?></td>
                                            <td class="t-detail-agent" style="width: 150px; text-align: center">
                                                <button class="btn tblEditBtn">
                                                    <a href="<?php echo $urlBuilder->build('setting-home-kp/edit', 'id='.$homekpDomain->getId(), TRUE) ?>" data-placement="bottom" data-original-title="Edit"><i class="material-icons">mode_edit</i>
                                                </button>
                                                <button class="btn tblDelBtn">
                                                    <a class="del" href="javascript:void(0)" data-url="<?php echo $urlBuilder->build('setting-home-kp/delete') ?>" data-value="<?php echo $homekpDomain->getId() ?>" data-text="Anda yakin akan menghapus data?" data-placement="bottom" data-original-title="Hapus"><i class="material-icons">delete</i>
                                                </button>
                                            </td>
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
                                            <a href="<?php echo $urlBuilder->build('setting-home-kp-detail/add')?>">Tambah</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <h2><strong>Home Syarat dan Ketentuan</strong> Detail</h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($homekpdetailDomainArray) == 0) : ?>
                                        <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                    <?php endif; ?>
                                    <?php
                                    foreach($homekpdetailDomainArray as $homekpdetailDomain) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo ++$no ?></td>
                                            <td><?php echo $homekpdetailDomain->getCategory(); ?></td>
                                            <td><?php echo $homekpdetailDomain->getDescription(); ?></td>
                                             <td><?php echo $homekpdetailDomain->getCreatedDate(); ?></td>
                                            <td style="text-align:center"><?php echo $homekpdetailDomain->getStatus() == 'active' ? '<span class="label label-success">active</span>' : '<span class="label label-danger">inactive</span>'; ?>
                                            </td>

                                            <td class="t-detail-agent" style="width: 150px; text-align: center">
                                                <button class="btn tblEditBtn">
                                                    <a href="<?php echo $urlBuilder->build('setting-home-kp-detail/edit', 'id='.$homekpdetailDomain->getId(), TRUE) ?>" data-placement="bottom" data-original-title="Edit"><i class="material-icons">mode_edit</i>
                                                </button>
                                                <button class="btn tblDelBtn">
                                                    <a class="del" href="javascript:void(0)" data-url="<?php echo $urlBuilder->build('setting-home-kp-detail/delete') ?>" data-value="<?php echo $homekpdetailDomain->getId() ?>" data-text="Anda yakin akan menghapus data?" data-placement="bottom" data-original-title="Hapus"><i class="material-icons">delete</i>
                                                </button>
                                            </td>
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
            <!--#END# Basic Table -->
        </div>
    </section>
	<?php echo $messageSession ?>
<?php echo $htmlFooter; ?>