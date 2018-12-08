<?php
    class Api extends Controller {
        public function __construct(){
            $this->postModel = $this->model('Apis');
        }

        public function index(){ 
            $pengumuman = $this->postModel->getPengumuman();
                
            $data = [
                'title' => 'NoticeNow Admin Area',
                'description' => '',
                'pengumuman' => $pengumuman
            ];           

            $this->view('api/index', $data);
            
        }

        public function detail($id){
            $detail = $this->postModel->getPengumumanDet($id);
            
            $data = [
                'title' => 'NoticeNow Admin Area',
                'description' => '',
                'detail' => $detail
            ];           

            $this->view('api/detail', $data);
        }

        public function kategori($id){
            $kategori = $this->postModel->getByKategori($id);
            
            $data = [
                'title' => 'NoticeNow Admin Area',
                'description' => '',
                'kategori' => $kategori
            ];           

            $this->view('api/kategori', $data);
        }
    }