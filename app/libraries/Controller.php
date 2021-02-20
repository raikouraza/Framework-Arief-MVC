<?php
//base controller load model load view
    class Controller{
        public function model($model){
            require_once '../app/models/' .$model .'.php';
            return new $model();


        }
        //load view
        public function view($view,$data=[]){
            //data disini untuk mengirim data baik dari mana saja
            //check for the view file

            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            }else{
                die('view does not exist');
            }
        }

    }
