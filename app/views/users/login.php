<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <center><h2>Sistem Notifikasi Pengumuman</h2></center>
        <br>
        <center><h2>NoticeNow</h2></center>
        <div class="card card-body bg-light mt-5">
            <h2>Login</h2>
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="form-group">
                    <label for="username">Username : </label>
                    <input type="text" name="username" class="form-control form-control-lg <?php echo (!empty($data['user_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['username']; ?>">
                    <span class="invalid-feedback"><?php echo $data['user_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password : </label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['pass_err']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>