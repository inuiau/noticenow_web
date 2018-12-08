<?php
    class Apis {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getPengumuman(){
            $this->db->query('SELECT id_artikel, judul, kategori.nama_kategori as kategori, tanggal_dibuat 
                                FROM pengumuman 
                                INNER JOIN kategori
                                on pengumuman.kategori = kategori.id_kategori
                                ORDER BY tanggal_dibuat DESC;
            ');

            $results = $this->db->resultSet();

            return $results;
        }

        public function getPengumumanDet($id){
            $this->db->query('SELECT id_artikel, judul, kategori.nama_kategori as kategori, tanggal_dibuat, konten 
                                FROM pengumuman 
                                INNER JOIN kategori
                                on pengumuman.kategori = kategori.id_kategori
                                WHERE id_artikel = :id
            ');
            $this->db->bind(':id',$id);

            $results = $this->db->resultSet();

            return $results;
        }

        public function getByKategori($id){
            $this->db->query('SELECT id_artikel, judul, kategori.nama_kategori as kategori, tanggal_dibuat 
                                FROM pengumuman 
                                INNER JOIN kategori
                                on pengumuman.kategori = kategori.id_kategori
                                WHERE kategori.id_kategori = :id
                                ORDER BY tanggal_dibuat DESC
            ');
            $this->db->bind(':id',$id);
            
            $results = $this->db->resultSet();

            return $results;
        }
    }
?>