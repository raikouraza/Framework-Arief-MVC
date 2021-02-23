<?php
    class Anggarans extends Controller{

        public function __construct()
        {
            //yang bisa membuka halaman pengajuan hanya akun yang sudah login sehingga akun yang blm login tidak dapat melihat isinya
            //methodnya ada di session helper
            if(!isLoggedIn()){
                redirect('penggunas/login');
            }
            //manggil model anggaran (berhub dgn db)
            $this->anggaranModel = $this->model('Anggaran');
            $this->userModel = $this->model('Pengguna');
        }

        public function show($id){
            $anggaran = $this->anggaranModel->getAnggaranById($id);

            $pengguna = $this->userModel->getUserById($anggaran->anggaran_pihak_mengajukan);

            $data =['anggarans'=>$anggaran,
                    'penggunas'=>$pengguna];
            $this->view('anggarans/show',$data);


        }
        public function index(){
            //get anggarans
            $anggarans = $this->anggaranModel->getAnggarans();
            //ngambil data anggaran dari db dan ditampilin di index anggarans
            $data= [
                'anggarans'=>$anggarans
            ];
            $this->view('anggarans/index',$data);

        }
        //untuk mengajukan anggaran baru
        public function add(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //sanitize the post
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'judul_anggaran'=>trim($_POST['judul_anggaran']),
                    'deskripsi_anggaran'=>trim($_POST['deskripsi_anggaran']),
                    'nominal_diajukan'=>trim($_POST['nominal_diajukan']),
                    'user_id' =>$_SESSION['user_id'],
                    'judul_anggaran_error'=>'',
                    'deskripsi_anggaran_error'=>'',
                    'nominal_diajukan_error'=>''
                    ];

                //validate title
                if(empty($data['judul_anggaran'])){
                    $data['judul_anggaran_error']='Tolong Masukan Judul Anggaran';
                }
                if(empty($data['deskripsi_anggaran'])){
                    $data['deskripsi_anggaran_error']='Tolong Masukan deskripsi Anggaran';
                }
                if(empty($data['nominal_diajukan'])){
                    $data['nominal_diajukan_error']='Tolong Masukan nominal Anggaran';
                }

                //make sure no errors
                if(empty($data['judul_anggaran_error'])&& empty($data['deskripsi_anggaran_error']) && empty($data['nominal_diajukan_error'])){
                    if($this->anggaranModel->addAnggaran($data)){
                        flash('post_added, Anggaran Baru Berhasil Diajukan');
                        redirect('anggarans');
                    }else{
                        die('ada yang salah');
                    }
                }else{
                    //load view with error
                    $this->view('anggarans/add',$data);
                }
            }else{
                $data= [
                    'judul_anggaran'=>'',
                    'deskripsi_anggaran'=>'',
                    'nominal_diajukan'=>'',

                ];
                $this->view('anggarans/add',$data);

            }
        }
        public function delete($id){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //check apakah yang akan menghapus itu yang mengajukan, apabila tidak maka akan di redirect ke anggarans
                $anggaran = $this->anggaranModel->getAnggaranById($id);
                if(($anggaran->anggaran_pihak_mengajukan) != ($_SESSION['user_id'])){
                    redirect('anggarans');
                }
                if($this->anggaranModel->deleteAnggaran($id)){
                    flash('anggaran_message','Anggaran berhasil dihapus');
                    redirect('anggarans');
                }else{
                    die('Something Went Wrong');
                }
            }

        }
        public function update($id){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //sanitize the post
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'id'=>$id,
                    'judul_anggaran'=>trim($_POST['judul_anggaran']),
                    'deskripsi_anggaran'=>trim($_POST['deskripsi_anggaran']),
                    'nominal_diajukan'=>trim($_POST['nominal_diajukan']),
                    'user_id' =>$_SESSION['user_id'],
                    'judul_anggaran_error'=>'',
                    'deskripsi_anggaran_error'=>'',
                    'nominal_diajukan_error'=>''
                ];

                //validate title
                if(empty($data['judul_anggaran'])){
                    $data['judul_anggaran_error']='Tolong Masukan Judul Anggaran';
                }
                if(empty($data['deskripsi_anggaran'])){
                    $data['deskripsi_anggaran_error']='Tolong Masukan deskripsi Anggaran';
                }
                if(empty($data['nominal_diajukan'])){
                    $data['nominal_diajukan_error']='Tolong Masukan nominal Anggaran';
                }

                //make sure no errors
                if(empty($data['judul_anggaran_error'])&& empty($data['deskripsi_anggaran_error']) && empty($data['nominal_diajukan_error'])){
                    if($this->anggaranModel->updateAnggaran($data)){
                        flash('anggaran_message',' Anggaran yang diajukan berhasil diperbaharui');
                        redirect('anggarans');
                    }else{
                        die('ada yang salah');
                    }
                }else{
                    //load view with error
                    $this->view('anggarans/update',$data);
                }
            }else{
                //supaya yang mengajukan yang bisa mengubah apa yang diajukan
                $anggaran = $this->anggaranModel->getAnggaranById($id);

                if(($anggaran->anggaran_pihak_mengajukan) != ($_SESSION['user_id'])){
                    redirect('anggarans');
                }

                $data= [
                    'id'=>$id,
                    'judul_anggaran'=>$anggaran->anggaran_judul,
                    'deskripsi_anggaran'=>$anggaran->anggaran_deskripsi,
                    'nominal_diajukan'=>$anggaran->anggaran_nominal_mengajukan,

                ];
                $this->view('anggarans/update',$data);

            }
        }

    }