<?php
    foreach($data['detail'] as $det){
        $date = date_create($det->tanggal_dibuat);
        $tgl = date_format($date, 'd/m/Y G:i A');
        $field[] = [
            "id" => $det->id_artikel,
            "judul" => $det->judul,
            "kategori" => $det->kategori,
            "tanggal_dibuat" => $tgl ,
            "konten" => $det->konten     
        ];
    }

    echo json_encode($field);
?>