      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
        
        <li class="nav-item">
           <a href="<?php echo base_url()?>admin/Dashboard/myprofile" class="nav-link"> Hi, <?php echo $this->session->userdata('loggedin')['name']?> </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url()?>Home/logout" class="nav-link">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
    <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url()?>Dashboard">SC Page</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $title; ?></li>
      </ol>