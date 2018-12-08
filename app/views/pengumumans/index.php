<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<header id="main-header" class="py-2 bg-warning text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fa fa-list-alt"></i> Pengumuman </h1>
        </div>
        <div class="col-md-6">
          <div class="pull-right">
            <a href="<?php echo URLROOT;?>/pengumumans/add" class="btn btn-primary btn-block">
              <i class="fa fa-plus"></i> Tambah Pengumuman
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Pengumuman -->
  
  <section id="posts">
    <div class="container">
          <div class="card">
          <?php flash('post_added'); ?>
          <?php flash('post_deleted'); ?>
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
                  <td><?php $date = date_create($peng->tanggal_dibuat); 
                            $tgl = date_format($date, 'd/m/Y G:i A');
                            echo $tgl;
                  ?></td>
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
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="<?php echo URLROOT;?>/pengumumans/index/<?php echo $data['id'] - 1; ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
            <?php 
              $jum = $data['jum']->banyak / 10;
              $jm = ceil($jum);
              for($i = 1; $i <= $jm; $i++){?>
              
                  <li class="page-item"><a class="page-link active" href="<?php echo URLROOT;?>/pengumumans/index/<?php echo $i; ?>"><?php echo $i; ?></a></li>
                  
            <?php
              } 
            ?>
            <li class="page-item">
                    <a class="page-link" href="<?php echo URLROOT;?>/pengumumans/index/<?php echo $data['id'] + 1; ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
      </div>
    </div>
  </section>  
    
<?php require APPROOT . '/views/inc/footer.php'; ?>