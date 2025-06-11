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
                                <h4 class="page-title">HOME FAQ</h4>
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
                                            <a href="<?php echo $urlBuilder->build('setting-home-faq-category/add')?>">Tambah</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            <h2><strong>Home FAQ</strong> Category</h2>
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
                                    <?php if (count($homefaqcategoryDomainArray) == 0) : ?>
                                        <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                    <?php endif; ?>
                                    <?php
                                    foreach($homefaqcategoryDomainArray as $homefaqcategoryDomain) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo ++$no2 ?></td>
                                            <td><?php echo $homefaqcategoryDomain->getCategory(); ?></td>
                                            <td class="t-detail-agent" style="width: 150px; text-align: center">
                                                <button class="btn tblEditBtn">
                                                    <a href="<?php echo $urlBuilder->build('setting-home-faq-category/edit', 'id='.$homefaqcategoryDomain->getId(), TRUE) ?>" data-placement="bottom" data-original-title="Edit"><i class="material-icons">mode_edit</i>
                                                </button>
                                                <button class="btn tblDelBtn">
                                                    <a class="del" href="javascript:void(0)" data-url="<?php echo $urlBuilder->build('setting-home-faq-category/delete') ?>" data-value="<?php echo $homefaqcategoryDomain->getId() ?>" data-text="Anda yakin akan menghapus data?" data-placement="bottom" data-original-title="Hapus"><i class="material-icons">delete</i>
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
                                            <a href="<?php echo $urlBuilder->build('setting-home-faq/add')?>">Tambah</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            <h2><strong>Home FAQ</strong> Detail</h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($homefaqDomainArray) == 0) : ?>
                                        <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                    <?php endif; ?>
                                    <?php
                                    foreach($homefaqDomainArray as $homefaqDomain) :
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo ++$no ?></td>
                                            <td><?php echo $homefaqDomain->getCategory(); ?></td>
                                            <td><?php echo $homefaqDomain->getPertanyaan(); ?></td>
                                            <td><?php echo $homefaqDomain->getJawaban(); ?></td>
                                            <td><?php echo $homefaqDomain->getCreatedDate(); ?></td>
                                            <td style="text-align:center"><?php echo $homefaqDomain->getStatus() == 'active' ? '<span class="label label-success">active</span>' : '<span class="label label-danger">inactive</span>'; ?>
                                            </td>

                                            <td class="t-detail-agent" style="width: 150px; text-align: center">
                                                <button class="btn tblEditBtn">
                                                    <a href="<?php echo $urlBuilder->build('setting-home-faq/edit', 'id='.$homefaqDomain->getId(), TRUE) ?>" data-placement="bottom" data-original-title="Edit"><i class="material-icons">mode_edit</i>
                                                </button>
                                                <button class="btn tblDelBtn">
                                                    <a class="del" href="javascript:void(0)" data-url="<?php echo $urlBuilder->build('setting-home-faq/delete') ?>" data-value="<?php echo $homefaqDomain->getId() ?>" data-text="Anda yakin akan menghapus data?" data-placement="bottom" data-original-title="Hapus"><i class="material-icons">delete</i>
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