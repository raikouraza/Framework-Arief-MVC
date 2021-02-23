<?php   require APPROOT . '/views/inc/header.php'; ?>

    <!-- bar bar sedikit untuk nampilin list departemen -->
    <?php $departments = $this->userModel->getDepartments();
    //ngambil data anggaran dari db dan ditampilin di register
    $data2= [
        'departments'=>$departments
    ];
    $this->view('penggunas/register',$data2);?>
    <!-- bar bar sedikit untuk nampilin list departemen selesai -->
    <?php $roles = $this->userModel->getRoles();
    $data3 = [
        'roles'=>$roles
    ];
    $this->view('penggunas/register',$data3)
    ?>

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



                <!-- select nyoba -->
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Nama Departemen :</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <?php foreach($data2['departments'] as $department) : ?>
                            <option value="<?php echo $department->departemen_nama;?>"> <?php echo $department->departemen_nama;?> </option>
                        <?php endforeach;?>
                    </select>
                </div>
                <?php  ?>


                <!-- role pengguna  ada Direktur Utama, Direktur, Manager, Kepala Divisi -->

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Jabatan :</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <?php foreach($data3['roles'] as $role) : ?>
                            <option value="<?php echo $role->role_nama;?>"> <?php echo $role->role_nama;?> </option>
                        <?php endforeach;?>
                    </select>
                </div>
                <?php  ?>
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
