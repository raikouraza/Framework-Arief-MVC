<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>
                Pengajuan Anggaran
            </h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT;?>/anggarans/add" class="btn btn-primary fa-pull-right">
                <i class="fa fa-pencil-alt"></i> Ajukan Anggaran Baru
            </a>
        </div>
    </div>
<?php flash('anggaran_message');?>
<!-- disini $data untuk manggil data dari database, alasan namanya anggarans karena supaya disesuaikan dengan yang ada dari controllers anggarans-->
<?php foreach($data['anggarans'] as $anggaran) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title">
            <!-- $anggaran itu manggil dari database, anggaran judul sesuai dari tabel tbanggaran -->
            <?php echo $anggaran->anggaran_judul; ?>
        </h4>
            <div class="bg-light p-2 mb-3">
                <!-- cara untuk manggil method dari database yang querynya sudah dibuat di models dan controllers-->
                diajukan oleh : <?php echo $anggaran->pengguna_nama; ?> pada tanggal <?php echo $anggaran->anggaran_tanggal_mengajukan; ?>
            </div>
            <p class="card-text"> <?php echo $anggaran->anggaran_deskripsi; ?> </p>
            <a href="<?php echo URLROOT?>/anggarans/show/<?php echo $anggaran->anggaranId;?>" class="btn btn-dark"> Detail Anggaran Yang Telah Diajukan </a>
    </div>
<?php endforeach ?>




<?php require APPROOT . '/views/inc/footer.php'; ?>