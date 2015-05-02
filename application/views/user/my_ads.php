
<?php $this->load->view('include/header'); ?>
<div class="wrapper">
    <div class="row clearfix">
        <div class="main-wrap">
            <div class="user-content">
                <h2 class="form-header-user">My ADs</h2>
                <div id="contact" class="form-user" role="form">
                    <div class="row myads">
                        <div class="col-xs-4 form-group">
                            <img class="dp-img img-responsive" src="<?= base_url() . UPLOAD_PATH . $user->image_url; ?>" alt="" >
                        </div>
                        <h1> <?= $user->name; ?></h1>
                        <h3> <?= $user->email; ?> </h3>
                        <h4><?= $user->phone ?></h4>
                        <h4><?= $user->city ?> , <?= $user->country ?></h4>
                        <h4><?= $user->address ?></h4>
                    </div>
                    
                    <br />
                </div>
            </div>
            <?php $this->load->view('user/side-bar'); ?>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer'); ?>
