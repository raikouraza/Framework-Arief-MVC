<?php
    class Anggaran{
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAnggarans(){
            $this->db->query('
                                 SELECT *, tbanggaran.id as anggaranId, tbpengguna.id as penggunaId
                                    

                                 FROM tbanggaran 
                                 INNER JOIN tbpengguna
                                 ON tbanggaran.anggaran_pihak_mengajukan = tbpengguna.id
                                 ORDER BY tbanggaran.anggaran_tanggal_mengajukan DESC
                                 ');
            $results = $this->db->resultSet();
            return $results;

        }
        public function addAnggaran($data){
            $this->db->query('INSERT INTO tbanggaran(anggaran_judul,anggaran_deskripsi,anggaran_pihak_mengajukan,anggaran_nominal_mengajukan, anggaran_tanggal_mengajukan) 
                                    VALUES (:anggaran_judul, :anggaran_deskripsi, :anggaran_pihak_mengajukan, :anggaran_nominal_mengajukan, CURRENT_TIMESTAMP )');
            //binding values
            $this->db->bind(':anggaran_judul', $data['judul_anggaran']);
            $this->db->bind(':anggaran_deskripsi', $data['deskripsi_anggaran']);
            $this->db->bind(':anggaran_pihak_mengajukan', $data['user_id']);
            $this->db->bind(':anggaran_nominal_mengajukan', $data['nominal_diajukan']);

            //execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        public function getAnggaranById($id){
            $this->db->query('SELECT * FROM tbanggaran WHERE id = :id');
            $this->db->bind(':id',$id);
            $row=$this->db->single();
            return $row;
        }

        public function updateAnggaran($data){
            $this->db->query('UPDATE tbanggaran SET anggaran_judul = :anggaran_judul, anggaran_deskripsi = :anggaran_deskripsi, anggaran_nominal_mengajukan =:anggaran_nominal_mengajukan WHERE id = :id');
            //binding values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':anggaran_judul', $data['judul_anggaran']);
            $this->db->bind(':anggaran_deskripsi', $data['deskripsi_anggaran']);
            $this->db->bind(':anggaran_nominal_mengajukan', $data['nominal_diajukan']);

            //execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function deleteAnggaran($id){
            $this->db->query('DELETE FROM tbanggaran WHERE id = :id');
            $this->db->bind(':id', $id);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }