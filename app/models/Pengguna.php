<?php

    class Pengguna{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }

        public function register($data){
            $this->db->query('INSERT INTO tbpengguna(pengguna_email, pengguna_nama, pengguna_departemen, pengguna_role, pengguna_password) 
                                    VALUES (:pengguna_email, :pengguna_nama, :pengguna_departemen, :pengguna_role, :pengguna_password)');
            //binding values
            $this->db->bind(':pengguna_email', $data['email']);
            $this->db->bind(':pengguna_nama', $data['nama']);
            $this->db->bind(':pengguna_password', $data['password']);
            $this->db->bind(':pengguna_departemen', $data['nama_departemen']);
            $this->db->bind(':pengguna_role', $data['role']);
            //execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //find user by email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM tbpengguna WHERE pengguna_email = :pengguna_email');
            //bind value
            $this->db->bind(':pengguna_email',$email);
            $row = $this->db->single();
            if($this->db->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }

        public function login($email, $password){
            $this->db->query('SELECT * FROM tbpengguna WHERE pengguna_email = :pengguna_email');
            $this->db->bind(':pengguna_email', $email);
            $row = $this->db->single();
            $hashed_password = $row->pengguna_password;
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }
    }