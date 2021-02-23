<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT;?>">
            <i class="fa fa-dollar-sign"> </i> e-budgeting
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto w-100 ">
                <?php if(!isset($_SESSION['user_id'])) :?>
                <li class="nav-item">
                    <a class="nav-link fa fa-home" aria-current="page" href="<?php echo URLROOT;?>"> Home</a>
                </li>
                <?php endif; ?>
                <?php if(isset($_SESSION['user_id'])) :?>

                    <li class="nav-item">
                        <a class="nav-link fa fa-hand-paper " href="<?php echo URLROOT; ?>/anggarans/index"> Aju Anggaran</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fa fa-chart-line " href="<?php echo URLROOT; ?>/anggarans/index"> Report </a>
                    </li>
                <?php endif; ?>

                <!-- untuk dirut dan staff anggaran -->
                <?php if(isset($_SESSION['user_id'])&&($_SESSION['user_role']=='Direktur Utama')) :?>
                <li class="nav-item">
                    <a class="nav-link fa fa-check " href="<?php echo URLROOT; ?>/anggarans/index"> Persetujuan Anggaran</a>
                </li>
                <?php endif; ?>
                <?php if(!isset($_SESSION['user_id'])) :?>
                <li class="nav-item">
                    <a class="nav-link fa fa-address-book" href="<?php echo URLROOT; ?>/pages/about"> About</a>
                </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ml-auto w-100">
                <!-- buat session pengguna membedakan navbar, user id dari penggunas create session -->
                <?php if(isset($_SESSION['user_id'])) :?>
                <!-- bagian kiri -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT;?>/pages/index">Welcome <?php echo $_SESSION['user_name'];?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo URLROOT;?>/penggunas/logout">Logout</a>
                    </li>
                <!-- bagian kanan -->
                <?php else :  ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo URLROOT;?>/penggunas/register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT;?>/penggunas/login">Login</a>
                    </li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
