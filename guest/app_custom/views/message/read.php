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
                                <h4 class="page-title">Read Mail</h4>
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
                                        <a href="inbox.html" title="Inbox">Inbox
                                            <span class="pull-right badge bg-orange"><?php echo $unreademailcountArray;?> </span>
                                        </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <?php if (count($messageDomainArray) == 0) : ?>
                        <h5>No data.</h5>
                    <?php endif; ?>
                    <?php foreach($messageDomainArray as $messageDomain) :?>
                    <div class="card" style="padding-bottom: 30px">
                        <div class="boxs mail_listing">
                            <div class="inbox-body no-pad">
                                <section class="mail-list">
                                    <div class="mail-sender">
                                        <div class="mail-heading">
                                            <h4 class="vew-mail-header">
                                                <b><?php echo $messageDomain->getTitle();?></b>
                                            </h4>
                                        </div>
                                        <hr>
                                        <div class="media">
                                            <div class="media-body">
                                                <span class="date pull-right"><?php echo $messageDomain->getCreatedDate();?></span>
                                                <h4 class="text-primary"><?php echo $messageDomain->getName();?></h4>
                                                <small class="text-muted">From: <?php echo $messageDomain->getEmail();?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-mail">
                                        <p style="text-align: justify;"><?php echo $messageDomain->getMessage();?></p>
                                    </div>
                                    <form method="POST" action="" autocomplete="OFF" class="form-horizontal" enctype="multipart/form-data">
                                        <div class="row clearfix">
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <input type="checkbox" id="remember_me_4" class="filled-in">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="process" value="edit_mailstatus">MARK AS UNREAD </button>
                                            </div>
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <!-- #END# Horizontal Layout -->
        </div>
    </section>
	<?php echo $messageSession ?>
<?php echo $htmlFooter; ?>