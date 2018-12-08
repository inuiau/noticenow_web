<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<header id="main-header" class="py-2 bg-warning text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fa fa-gear"></i> Dashboard</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- Actions -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="<?php echo URLROOT;?>/pengumumans/add" class="btn btn-primary btn-block">
            <i class="fa fa-plus"></i> Tambah Pengumuman
          </a>
        </div>
        <!-- <div class="col-md-3">
          <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#addCategoryModal">
            <i class="fa fa-plus"></i> Tambah Kategori
          </a>
        </div> -->
      </div>
    </div>
  </section>

  <!-- Pengumuman -->
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              <h4>Pengumuman Terbaru</h4>
            </div>
            <table class="table table-striped">
              <thead class="thead-inverse">
                <tr>
                  <th>#</th>
                  <th>Judul</th>
                  <th>kategori</th>
                  <th>Tanggal Dibuat</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($data['pengumuman'] as $peng) : ?>
                <tr>
                  <td><?php echo $peng->id_artikel; ?></td>
                  <td><?php echo $peng->judul; ?></td>
                  <td><?php echo $peng->kategori; ?></td>
                  <td><?php echo $peng->tanggal_dibuat; ?></td>
                  <td>
                    <a href="<?php echo URLROOT;?>/pengumumans/edit/<?php echo $peng->id_artikel; ?>">
                      <i class="fa fa-pencil"></i>Edit</a> |
                    <a href="<?php echo URLROOT;?>/pengumumans/delete/<?php echo $peng->id_artikel; ?>" class="delete" data-confirm="Anda Yakin Menghapus Pengumuman?">
                      <i class="fa fa-trash-o"></i>Delete</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center bg-primary text-white mb-3">
            <div class="card-body">
              <h3>Jumlah Seluruh Pengumuman</h3>
              <h1 class="display-4">
                <i class="fa fa-pencil"></i><?php echo $data['jumpeng']->banyak; ?>
              </h1>
              <a href="<?php echo URLROOT;?>/pengumumans/index" class="btn btn-outline-light btn-sm">Lihat</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php require APPROOT . '/views/inc/modal.php'; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<?php  ?>