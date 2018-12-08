<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="<?php echo URLROOT;?>" class="navbar-brand">NoticeNow</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <?php foreach($data['navbar'] as $nav) : ?>
        <li class="nav-item px-2">
            <a href="<?php echo URLROOT.$nav->path?>" class="nav-link
            <?php if($nav->id_menu == $data['navid']){
              echo 'active';
            }?>
            "><?php echo $nav->title; ?></a>
          </li>   
        <?php endforeach; ?>
          <!-- <li class="nav-item px-2">
            <a href="pesan.html" class="nav-link">pesan</a>
          </li> -->
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mr-3">
            <a href="#" class="nav-link">
              <i class="fa fa-user"></i> Selamat Datang <?php echo $_SESSION['username']; ?>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT;?>/users/logout" class="nav-link">
              <i class="fa fa-user-times"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>