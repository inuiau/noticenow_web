<?php
    class Pages extends Controller {
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }
            $this->postModel = $this->model('Pengumuman');
        }

        public function index(){ 
            $pengumuman = $this->postModel->getPengumumanDash($_SESSION['status']);
            $kategori = $this->postModel->getKategori();
            $jumpeng = $this->postModel->hitungPengumuman();
            $navbar = $this->postModel->getMenu();  
                
            $data = [
                'title' => 'NoticeNow Admin Area',
                'description' => '',
                'pengumuman' => $pengumuman,
                'jumpeng' => $jumpeng,
                'kategori' => $kategori,
                'navbar' => $navbar,
                'navid' => '1'
            ];           

            $this->view('pages/index', $data);
            
        }
    }