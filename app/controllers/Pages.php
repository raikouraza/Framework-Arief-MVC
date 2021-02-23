<?php
    class Pages extends Controller {
        public function __construct()
        {

        }
        public function index(){
            if(isLoggedIn()){
                redirect('anggarans');

            }
            $data = ['title'=>'Welcome',
                'description'=>'Welcome to the e-budgeting application'
               ];
            $this->view('pages/index',$data);


        }
        public function about(){

            $data = ['title'=>'About Us',
                'description'=>'Welcome to the e-budgeting application'];

            $this->view('pages/about',$data);
        }

    }