<?php
 class Penggunas extends Controller
 {
     public function __construct()
     {
        $this->userModel = $this->model('Pengguna');
     }

     public function register()
     {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             //ngeproses form
             //sanitiasi data post
             $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
             //init data
             $data=[
                 'nama'=>trim($_POST['nama']),
                 'email'=>trim($_POST['email']),
                 'nama_departemen'=>trim($_POST['nama_departemen']),
                 'role'=>trim($_POST['nama']),
                 'password'=>trim($_POST['password']),
                 'confirm_password'=>trim($_POST['confirm_password']),
                 'nama_error' => '',
                 'email_error' => '',
                 'nama_departemen_error' => '',
                 'role_error' => '',
                 'password_error' => '',
                 'confirm_password_error' => ''
             ];

             if(empty($data['nama'])){
                 $data['nama_error']='Masukkan nama anda';
             }
             if(empty($data['password'])){
                 $data['password_error']='Masukkan password anda';
             }elseif (strlen($data['password'])<6){
                 $data['password_error']='Password minimal 6 karakter';
             }
             if(empty($data['confirm_password'])){
                 $data['confirm_password_error']='Masukkan konfirmasi password anda';
             }else{
                 if ($data['password']!=$data['confirm_password']){
                     $data['confirm_password_error']='Konfirmasi Password tidak sama';
                 }
             }
             if(empty($data['role'])){
                 $data['role_error']='Masukkan role anda';
             }
             if(empty($data['nama_departemen'])){
                 $data['nama_departemen']='Masukkan nama departemen anda';
             }
             if(empty($data['email'])){
                 $data['email_error']='Masukkan email anda';
             }else{
                 //check email apakah sudah ada atau belum
                 if($this->userModel->findUserByEmail($data['email'])){
                     $data['email_error']='email sudah digunakan';
                 }
             }
            //pastikan tidak ada error
             if(empty($data['email_error'])&&empty($data['password_error'])&&empty($data['nama_error'])&&empty($data['nama_departemen_error'])&&empty($data['confirm_password_error'])&&empty($data['role_error'])){
                 //validated
                 //hash password
                 $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
                 //register user
                 if($this->userModel->register($data)){
                     flash('register_success','sekarang anda dapat melakukan login');
                    redirect('penggunas/login');
                 }else{
                    die('something went wrong');
                 }
             }else{
                 //load view
                 $this->view('penggunas/register',$data);
             }



         } else {
             //init data
             $data = [
                 'nama' => '',
                 'email' => '',
                 'nama_departemen' => '',
                 'role' => '',
                 'password' => '',
                 'confirm_password' => '',

                 'nama_error' => '',
                 'email_error' => '',
                 'nama_departemen_error' => '',
                 'role_error' => '',
                 'password_error' => '',
                 'confirm_password_error' => ''
             ];
             //load view
             $this->view('penggunas/register', $data);


         }
     }

     public function login()
     {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             //ngeproses form
             //sanitiasi data post
             $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
             //init data
             $data=[
                 'email'=>trim($_POST['email']),
                 'password'=>trim($_POST['password']),
                 'email_error' => '',
                 'password_error' => '',
             ];

             //validate email
             if(empty($data['email'])){
                 $data['email_error']='Masukkan email anda';
             }

             if(empty($data['password'])){
                 $data['password_error']='Masukkan password anda';
             }
             //ngecek email pake find user by email method
             if($this->userModel->findUserByEmail($data['email'])){
                 //user found

             }else{
                 $data['email_error'] = 'User tidak ditemukan';
             }


             //pastikan tidak ada error
             if(empty($data['email_error']) && empty($data['password_error'])){
                 //validated
                 //check dan set pengguna yang login
                 $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                 if($loggedInUser){
                    //create session
                     $this->createUserSession($loggedInUser);
                 }else{

                     $data['password_error']='password salah';

                     $this->view('penggunas/login',$data);
                 }
             }else{
                 //load view
                 $this->view('penggunas/login',$data);
             }

         } else {
             //init data
             $data = [

                 'email' => '',
                 'password' => '',
                 'email_error' => '',
                 'password_error' => '',

             ];
             //load view
             $this->view('penggunas/login', $data);
         }
     }
     public function createUserSession($user){
         $_SESSION['user_id'] = $user->id;
         $_SESSION['user_email'] = $user->pengguna_email;
         $_SESSION['user_role'] = $user->pengguna_role;
         $_SESSION['user_departemen'] = $user->pengguna_departemen;
         $_SESSION['user_name'] = $user->pengguna_nama;
         redirect('pages/index');
     }
     public function logout(){
        unset($_SESSION['user_id']);
         unset($_SESSION['user_email']);
         unset($_SESSION['user_role']);
         unset($_SESSION['user_departemen']);
         unset($_SESSION['user_name']);
         session_destroy();
         redirect('penggunas/login');

     }
     public function isLoggedIn(){
         if(isset($_SESSION['user_id'])){
             return true;
         }else{
             return false;
         }
     }

 }