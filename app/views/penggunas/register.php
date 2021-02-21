<?php   require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create an Account</h2>
            <p>Please fill out this form to register with us</p>
            <form action="<?php echo URLROOT;?>/penggunas/register" method="POST">
                <div class="form-group">
                    <label for="nama">Name: <sup>*</sup></label>
                    <input type="text" name="nama" class="form-control form-control-lg  <?php echo (!empty($data['nama_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['nama']; ?>" required>
                    <span class="invalid-feedback"><?php echo $data['name_error'];?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['email']; ?>"required>
                    <span class="invalid-feedback"><?php echo $data['email_error'];?></span>
                </div>
                <!-- departemen ambil dari database tb department -->

                <div class="form-group">
                    <label for="nama_departemen">Departemen : <sup>*</sup></label>
                    <input type="text" name="nama_departemen" class="form-control form-control-lg <?php echo (!empty($data['nama_departemen_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['nama_departemen']; ?>"required>
                    <span class="invalid-feedback"><?php echo $data['nama_departemen_error'];?></span>
                </div>
                <!-- role pengguna  ada Direktur Utama, Direktur, Manager, Kepala Divisi -->
                <div class="form-group">
                    <label for="role">Role : <sup>*</sup></label>
                    <input type="text" name="role" class="form-control form-control-lg <?php echo (!empty($data['role_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['role']; ?>"required>
                    <span class="invalid-feedback"><?php echo $data['role_error'];?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['password']; ?>"required>
                    <span class="invalid-feedback"><?php echo $data['password_error'];?></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['confirm_password']; ?>"required>
                    <span class="invalid-feedback"><?php echo $data['confirm_password_error'];?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT;?>/penggunas/login" class="btn btn-light btn-block">Have an account? Login!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php   require APPROOT . '/views/inc/footer.php'; ?>
