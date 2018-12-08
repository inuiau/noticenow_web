<?php
    error_reporting(0);
    class Pengumumans extends Controller {
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }
            $this->postModel = $this->model('Pengumuman');
            date_default_timezone_set("Asia/Jakarta");
        }

        public function index($id){
            if(empty($id)){
                $pengumuman = $this->postModel->getPengumuman($_SESSION['status']);
                $id = '';
            }else{
                $pg = $id * 10;
                $pgn = $pg - 10;
                $pengumuman = $this->postModel->getPengumumanLim($pgn);
            }
            $kategori = $this->postModel->getKategori();
            $navbar = $this->postModel->getMenu();
            $jumpeng = $this->postModel->hitungPengumuman();
                           
            $data = [
                'title' => 'NoticeNow Admin Area',
                'description' => '',
                'pengumuman' => $pengumuman,
                'kategori' => $kategori,
                'navbar' => $navbar,
                'navid' => '2',
                'jum' => $jumpeng,
                'id' => $id
            ]; 

            $this->view('pengumumans/index', $data);
        }

        public function add(){
            $pengumuman = $this->postModel->getPengumuman();
            $kategori = $this->postModel->getKategori();
            $navbar = $this->postModel->getMenu();  

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'judul' => trim($_POST['judul']),
                    'kats' => trim($_POST['category']),
                    'konten' => $_POST['kon'],
                    'tanggal' => date("Y-m-d H:i:s"),
                    'postedby' => $_POST['posted'],
                    'title_err' => '',
                    'body_err' => '',
                    'pengumuman' => $pengumuman,
                    'kategori' => $kategori,
                    'navbar' => $navbar,
                    'navid' => '2'
                ]; 

                if(empty($data['judul'])){
                    $data['title_err'] = 'Masukkan Judul';
                }

                if(empty($data['konten'])){
                    $data['body_err'] = 'Masukkan Isi Pengumuman';
                }

                if(empty($data['title_err']) && empty($data['body_err'])){
                    if($this->postModel->tambahPengumuman($data)){
                        flash('post_added', 'Post Added');
						$maxid = $this->postModel->getMaxId();
                        $lastpost = $this->postModel->getLastPengumuman($maxid->id);
                        $message = array(
                                    "id" => $lastpost[0]->id,
                                    "judul" => $lastpost[0]->judul,
                                    "kategori" => $lastpost[0]->kategori,
                                    "tanggal" => $lastpost[0]->tanggal_dibuat,
                                    "postedby" => 'Posted By: '.$lastpost[0]->postedby
                                    );
                        // print_r($message);            				
                        send_notification($message,FIREBASE_KEY);
                        $filename = '../public/log/log.txt';
                        if (file_exists($filename)) {
                            $handle = fopen($filename, 'a') or die('Cannot open file:  '.$filename);
                            $data = "\n".$lastpost[0]->id." ".$lastpost[0]->judul." ".$lastpost[0]->kategori." ".$lastpost[0]->tanggal_dibuat." ".$lastpost[0]->postedby." Status : ADD";
                            fwrite($handle, $data);
                            fclose($handle);
                        } else {
                            echo "The file $filename does not exist";
                        }
                        redirect('pengumumans');
                    } else {
                        die('ada yang salah');
                    }
                } else {
                    // $this->postModel->tambahPengumuman($data);
                    $this->view('pengumumans/add', $data);
                }


            }else{

                $data = [
                    'title' => 'NoticeNow Admin Area',
                    'description' => '',
                    'kategori' => $kategori,
                    'navbar' => $navbar,
                    'navid' => '2'
                ]; 
    
                $this->view('pengumumans/add', $data);
            }
        }

        public function show($id){
            
        }

        public function edit($id){
            $pengumuman = $this->postModel->getPengumumanDet($id);
            $kategori = $this->postModel->getKategori();
            $navbar = $this->postModel->getMenu();
            $ids = $id;  

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $_POST['id'],
                    'judul' => trim($_POST['judul']),
                    'kats' => trim($_POST['category']),
                    'konten' => $_POST['kon'],
                    'postedby' => $_POST['posted'],
                    'tanggal' => date("Y-m-d H:i:s"),
                    'title_err' => '',
                    'body_err' => '',
                    'pengumuman' => $pengumuman,
                    'kategori' => $kategori,
                    'navbar' => $navbar,
                    'navid' => '2'
                ]; 

                if(empty($data['judul'])){
                    $data['title_err'] = 'Masukkan Judul';
                }

                if(empty($data['konten'])){
                    $data['body_err'] = 'Masukkan Isi Pengumuman';
                }

                if(empty($data['title_err']) && empty($data['body_err'])){
                    if($this->postModel->updatePengumuman($data)){
                        flash('post_added', 'Post Updated');
                        $post = $this->postModel->getPengumumanDet($data['id']);
                        // echo $post[0]->id_artikel;
                        // echo 'UPDATED:'.$post[0]->judul;
                        // echo $post[0]->kategori;
                        // echo $post[0]->tanggal_dibuat;			
                        $message = array(
                            "id" => $post[0]->id_artikel,
                            "judul" => 'UPDATED:'.$post[0]->judul,
                            "kategori" => $post[0]->kategori,
                            "tanggal" => $post[0]->tanggal_dibuat,
                            "postedby" => 'Updated by: '.$post[0]->postedby
                        );	
                        
                        //print_r($message);    
                        send_notification($message,FIREBASE_KEY);
                        $filename = '../public/log/log.txt';
                        if (file_exists($filename)) {
                            $handle = fopen($filename, 'a') or die('Cannot open file:  '.$filename);
                            $data = "\n".$post[0]->id_artikel." ".$post[0]->judul." ".$post[0]->kategori." ".$post[0]->tanggal_dibuat." ".$post[0]->postedby." Status : UPDATE";
                            fwrite($handle, $data);
                            fclose($handle);
                        } else {
                            echo "The file $filename does not exist";
                        }
                        redirect('pengumumans');
                    } else {
                        die('ada yang salah');
                    }
                } else {
                    // $this->postModel->tambahPengumuman($data);
                    $this->view('pengumumans/edit', $data);
                }


            }else{
                $data = [
                    'id' => $ids,
                    'judul' => trim($pengumuman[0]->judul),
                    'kats' => trim($pengumuman[0]->kategori),
                    'konten' => $pengumuman[0]->konten,
                    'postedby' => $pengumuman[0]->postedby,
                    'title_err' => '',
                    'body_err' => '',
                    'pengumuman' => $pengumuman,
                    'kategori' => $kategori,
                    'navbar' => $navbar,
                    'navid' => '2'
                ]; 
    
                $this->view('pengumumans/edit', $data);
            }
        }

        public function delete($id){
            $lastpost = $this->postModel->getLastPengumuman($id);
            $filename = '../public/log/log.txt';
            if (file_exists($filename)) {
                $handle = fopen($filename, 'a') or die('Cannot open file:  '.$filename);
                $data = "\n".$lastpost[0]->id." ".$lastpost[0]->judul." ".$lastpost[0]->kategori." ".$lastpost[0]->tanggal_dibuat." ".$lastpost[0]->postedby." Status : DELETE";
                fwrite($handle, $data);
                fclose($handle);
            } else {
                echo "The file $filename does not exist";
            }
            if($this->postModel->hapusPengumuman($id)){
                flash('post_added', 'Pengumuman telah dihapus');
                redirect('pengumumans');
            } else {
                die('ada yang salah');
            }
        }
    }

    


 