<?php
    foreach($data['kategori'] as $pn){
        $date = date_create($pn->tanggal_dibuat);
        $tgl = date_format($date, 'd/m/Y G:i A');
        $field[] = [
            "id" => $pn->id_artikel,
            "judul" => $pn->judul,
            "kategori" => $pn->kategori,
            "tanggal_dibuat" => $tgl      
        ];
    }

    echo json_encode($field);
?>