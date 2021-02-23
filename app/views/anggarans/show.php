<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT;?>/anggarans" class="btn btn-light"><i class="fa fa-backward"></i> Kembali </a>


<h1><?php echo $data['anggarans']->anggaran_judul;     ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Diajukan Oleh : <?php echo $data['penggunas']->pengguna_nama; ?> pada tanggal <?php echo $data['anggarans']->anggaran_created_at; ?>

</div>
<p><?php echo $data['anggarans']->anggaran_deskripsi;?></p>
<?php if($data['anggarans']->anggaran_pihak_mengajukan == $_SESSION['user_id']) : ?>
    <hr>
    <a href="<?php echo URLROOT;?>/anggarans/update/<?php echo $data['anggarans']->id;?>"  class="btn btn-dark"> Edit </a>

    <form class="fa-pull-right" action="<?php echo URLROOT; ?>/anggarans/delete/<?php echo $data['anggarans']->id;?>" method="post">
        <input type="submit" value="Delete" class="btn btn-danger">

    </form>
<?php endif;?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
