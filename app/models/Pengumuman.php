<?php
    class Pengumuman {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getPengumuman($idkat){
            $this->db->query('SELECT id_artikel, judul, kategori.nama_kategori as kategori, tanggal_dibuat 
                                FROM pengumuman 
                                INNER JOIN kategori
                                on pengumuman.kategori = kategori.id_kategori
                                WHERE kategori.id_kategori = :idkat
                                ORDER BY id_artikel DESC Limit 0,10');
            $this->db->bind(':idkat', $idkat);
            $results = $this->db->resultSet();

            return $results;
        }

        public function getPengumumanLim($id){
            $this->db->query('SELECT id_artikel, judul, kategori.nama_kategori as kategori, tanggal_dibuat 
                                FROM pengumuman 
                                INNER JOIN kategori
                                on pengumuman.kategori = kategori.id_kategori
                                ORDER BY id_artikel DESC Limit :id,10');
            $this->db->bind(':id', $id);
            $results = $this->db->resultSet();

            return $results;
        }

        public function getPengumumanDash($idkat){
            $this->db->query('SELECT id_artikel, judul,kategori.id_kategori as id_kat, kategori.nama_kategori as kategori, tanggal_dibuat 
                                FROM pengumuman 
                                INNER JOIN kategori
                                on pengumuman.kategori = kategori.id_kategori
                                WHERE kategori.id_kategori = :idkat
                                ORDER BY id_artikel DESC limit 3;
            ');
            $this->db->bind(':idkat', $idkat);
            $results = $this->db->resultSet();

            return $results;
        }

        public function getLastPengumuman($id){
            $this->db->query('SELECT id_artikel as id, judul, kategori.nama_kategori as kategori, tanggal_dibuat, `status`.stat as postedby 
                                FROM pengumuman 
                                INNER JOIN kategori 
                                INNER JOIN `status` 
                                on pengumuman.kategori = kategori.id_kategori 
                                AND pengumuman.kategori = `status`.`id_stat` 
                                WHERE id_artikel = :id' 
								);
            $this->db->bind(':id', $id);
            $results = $this->db->resultSet();

            return $results;
        }

        public function getPengumumanDet($id){
            $this->db->query('SELECT id_artikel, judul, kategori.nama_kategori as kategori, tanggal_dibuat, konten, `status`.stat as postedby 
                                FROM pengumuman 
                                INNER JOIN kategori
                                INNER JOIN `status` 
                                on pengumuman.kategori = kategori.id_kategori
                                AND pengumuman.kategori = `status`.`id_stat`
                                WHERE id_artikel = :id
            ');
            $this->db->bind(':id',$id);

            $results = $this->db->resultSet();

            return $results;
        }
		
		public function getMaxId(){
			$this->db->query('SELECT MAX(id_artikel) as id FROM pengumuman'); 
            
            $results = $this->db->single();
            
            return $results;
		}

        public function getKategori(){
            $this->db->query('SELECT * FROM kategori');

            $results = $this->db->resultSet();

            return $results;
        }

        public function tambahPengumuman($data){
            $this->db->query('INSERT INTO pengumuman (judul, konten, kategori, tanggal_dibuat, postedby) VALUES(:judul, :konten, :kategori, :tanggal, :posted)');

            $this->db->bind(':judul', $data['judul']);
            $this->db->bind(':konten', $data['konten']);
            $this->db->bind(':kategori', $data['kats']);
            $this->db->bind(':tanggal', $data['tanggal']);
            $this->db->bind(':posted', $data['postedby']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        public function updatePengumuman($data){
            date_default_timezone_set("Asia/Jakarta");
            $this->db->query('UPDATE pengumuman SET judul = :judul, konten = :konten, tanggal_dibuat = :tanggal WHERE id_artikel = :id');

            $this->db->bind(':id', $data['id']);
            $this->db->bind(':judul', $data['judul']);
            $this->db->bind(':konten', $data['konten']);
            $this->db->bind(':tanggal', $data['tanggal']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        public function hapusPengumuman($id){
            $this->db->query('DELETE FROM pengumuman WHERE id_artikel = :id');

            $this->db->bind(':id', $id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getMenu(){
            $this->db->query('SELECT * FROM menu');

            $results = $this->db->resultSet();

            return $results;
        }

        public function hitungPengumuman(){
            $this->db->query('SELECT COUNT(id_artikel) as banyak FROM pengumuman'); 
            
            $results = $this->db->single();
            
            return $results;
        }
    }