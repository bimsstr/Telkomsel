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
                                <h4 class="page-title">Inbox</h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body">
                            <div id="mail-nav">
                                <ul class="" id="mail-folders">
                                    <li class="active">
                                        <a title="Inbox">Inbox
                                            <span class="pull-right badge" style="background-color: white">
                                                <?php echo $unreademailcountArray;?>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="boxs mail_listing">
                            <div class="inbox-center table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th style="text-align: center;"> Mail </th>
                                            <th> Title </th>
                                            <th style="text-align: center;"> Status </th>
                                            <th style="text-align: center;"> Date Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($messageDomainArray) == 0) : ?>
                                            <tr><td style="text-align:center" colspan="7"><h5>No data.</h5></td></tr>
                                        <?php endif; ?>
                                        <?php foreach($messageDomainArray as $messageDomain) :?>
                                        <tr style="background-color: <?php echo $messageDomain->getStatus() == "unread" ? "#F0F0F0;" : "" ?>;" class="pt-100">
                                            <td style="text-align: center;"><?php echo ++$No ?></td>
                                            <td class="hidden-xs"><?php echo $messageDomain->getEmail();?></td>
                                            <td class="max-texts"><?php echo $messageDomain->getTitle();?></td>
                                            <td style="text-align:center"><?php echo $messageDomain->getStatus() == 'read' ? '<span class="label label-success">Read</span>' : '<span class="label label-danger">Unread</span>'; ?>
                                            </td>
                                            <td class="text-center"><?php echo date("l, d-m-Y", strtotime($messageDomain->getCreatedDate()));?> </td>
                                            <td class="t-detail-agent" style="width: 150px; text-align: center">
                                                <button type ="submit" class="btn tblEditBtn" name="process" value="edit_status">
                                                    <a href="<?php echo $urlBuilder->build('message/read', 'id='.$messageDomain->getId(), TRUE) ?>" data-placement="bottom" data-original-title="Edit" ><i class="material-icons">folder</i>
                                                </button>
                                                <button class="btn tblDelBtn">
                                                    <a class="del" href="javascript:void(0)" data-url="<?php echo $urlBuilder->build('message/delete') ?>" data-value="<?php echo $messageDomain->getId() ?>" data-text="Anda yakin akan menghapus data?" data-placement="bottom" data-original-title="Hapus"><i class="material-icons">delete</i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo $messageSession ?>
<?php echo $htmlFooter; ?>