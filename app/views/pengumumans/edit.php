<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="container">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Edit Pengumuman</h5>
        </div>
        <div class="modal-body">
          <form action="<?php echo URLROOT; ?>/pengumumans/edit" method="post">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <div class="form-group">
              <label for="judul">Judul</label>
              <input name="judul" type="text" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['judul']; ?>">
              <span class="invalid-feedback"><?php echo $data['title_err']; ?> </span>
            </div>
            <div class="form-group">
              <label for="category">Kategori</label>
              <br>
              <?php
              $idk = "";
              $ktg = "";
              foreach($data['kategori'] as $kat) :
                if($_SESSION['status'] == $kat->id_kategori){
                    $idk = $kat->id_kategori;
                    $ktg = $kat->nama_kategori;
                }else{

                }
              endforeach;
              ?>
              <input type="radio" name="category" id="category" value="<?php echo $idk; ?>" checked><?php echo $ktg; ?>
            </div>
            <div class="form-group">
              <label for="kon">Konten</label>
              <textarea name="kon" class="form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['konten']; ?></textarea>
              <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
              <input type="hidden" name="posted" value="<?php echo $_SESSION['status'];?>">
            </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Update">
        </div>
        </form>
      </div>
      </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>