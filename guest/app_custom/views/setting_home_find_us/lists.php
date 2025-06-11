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
                                <h4 class="page-title">HOME FIND US</h4>
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
                            <h2><strong>Home Find Us</strong> Background</h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Image Background</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($homefindusDomainArray) == 0) : ?>
                                        <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                    <?php endif; ?>
                                    <?php
                                    foreach($homefindusDomainArray as $homefindusDomain) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo ++$no ?></td>
                                            <td style="text-align:center;">
                                                <img style="width:50%;" src="<?php echo $asset->getAssetForAdmin('images/find_us/bg/'.$homefindusDomain->getImageBackground()) ?>" alt="<?php echo $homefindusDomain->getImageBackground()?>">
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
                                            <a href="<?php echo $urlBuilder->build('setting-home-find-us/add')?>">Tambah</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            <h2><strong>Home Find Us</strong> Detail</h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>App Store Logo</th>
                                        <th>Play Store Logo</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($homefindusDomainArray) == 0) : ?>
                                        <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                    <?php endif; ?>
                                    <?php
                                    foreach($homefindusDomainArray as $homefindusDomain) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo ++$no ?></td>
                                            <td style="text-align:center;">
                                                <div class="col-md-6" style="padding-left: 0px;">
                                                <img src="<?php echo $asset->getAssetForAdmin('images/find_us/thumbs/'.$homefindusDomain->getImage()) ?>" alt="<?php echo $homefindusDomain->getImage()?>">
                                                </div>
                                            </td>
                                            <td><?php echo $homefindusDomain->getTitle(); ?></td>
                                            <td><?php echo $homefindusDomain->getDescription(); ?></td>
                                            <td style="text-align:center"><?php echo $homefindusDomain->getAppStore() == 'active' ? '<span class="label label-success">active</span>' : '<span class="label label-danger">inactive</span>'; ?>
                                            </td>
                                            <td style="text-align:center"><?php echo $homefindusDomain->getPlaystore() == 'active' ? '<span class="label label-success">active</span>' : '<span class="label label-danger">inactive</span>'; ?>
                                            </td>
                                            <td><?php echo $homefindusDomain->getCreatedDate(); ?></td>
                                            <td style="text-align:center"><?php echo $homefindusDomain->getStatus() == 'active' ? '<span class="label label-success">active</span>' : '<span class="label label-danger">inactive</span>'; ?>
                                            </td>
                                            <td class="t-detail-agent" style="width: 150px; text-align: center">
                                                <button class="btn tblEditBtn">
                                                    <a href="<?php echo $urlBuilder->build('setting-home-find-us/edit', 'id='.$homefindusDomain->getId(), TRUE) ?>" data-placement="bottom" data-original-title="Edit"><i class="material-icons">mode_edit</i>
                                                </button>
                                                <button class="btn tblDelBtn">
                                                    <a class="del" href="javascript:void(0)" data-url="<?php echo $urlBuilder->build('setting-home-find-us/delete') ?>" data-value="<?php echo $homefindusDomain->getId() ?>" data-text="Anda yakin akan menghapus data?" data-placement="bottom" data-original-title="Hapus"><i class="material-icons">delete</i>
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
        </div>
    </section>
	<?php echo $messageSession ?>
<?php echo $htmlFooter; ?>