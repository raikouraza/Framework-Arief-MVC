<?php   require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT;?>/anggarans" class="btn btn-light"><i class="fa fa-backward"></i> Kembali </a>
<div class="card card-body bg-light mt-5">

    <h2>Ajukan Anggaran Baru</h2>
    <p>Gunakan form berikut untuk mengajukan anggaran baru</p>
    <form action="<?php echo URLROOT;?>/anggarans/update/<?php echo $data['id']?>" method="post">
        <div class="form-group">
            <label for="judul">Judul Anggaran : <sup>*</sup></label>
            <input type="text" name="judul_anggaran" class="form-control form-control-lg <?php echo (!empty($data['judul_anggaran_error'])) ? 'is-invalid' : '';?> " value="<?php echo $data['judul_anggaran']; ?>">
            <span class="invalid-feedback"><?php echo $data['judul_anggaran_error'];?></span>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi Anggaran : <sup>*</sup></label>
            <textarea name="deskripsi_anggaran" class="form-control form-control-lg <?php echo (!empty($data['deskripsi_anggaran_error'])) ? 'is-invalid' : '';?> " ><?php echo $data['deskripsi_anggaran']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['deskripsi_anggaran_error'];?></span>
        </div>
        <div class="form-group">
            <label for="nominal">Anggaran Nominal yang diajukan : <sup>*</sup></label>
            <input type="text" name="nominal_diajukan" class="form-control form-control-lg <?php echo (!empty($data['nominal_diajukan_error'])) ? 'is-invalid' : '';?> " value="<?php echo $data['nominal_diajukan']; ?>">
            <span class="invalid-feedback"><?php echo $data['nominal_diajukan_error'];?></span>
        </div>
        <input type="submit" class="btn btn-success" value="Submit">
    </form>
</div>

<?php   require APPROOT . '/views/inc/footer.php'; ?>

