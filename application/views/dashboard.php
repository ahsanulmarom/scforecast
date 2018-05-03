     <!-- Icon Cards-->
       <div class="row">

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user"></i>
              </div>
              <div class="mr-5">
                <?php $num1 = $this->db->count_all_results('user');
              if(empty($num1)) {
                echo '0';
              } else {
                echo $num1;
              } ?> User Terdaftar
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php base_url()?>Dashboard/manageUser">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">
              <?php $num1 = $this->db->count_all_results('menu');
              if(empty($num1)) {
                echo '0';
              } else {
                echo $num1;
              } ?> Menu Terdaftarkan
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php base_url()?>Dashboard/manageMenu">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5">
                <?php $num1 = $this->db->count_all_results('order');
              if(empty($num1)) {
                echo '0';
              } else {
                echo $num1;
              } ?> Pesanan Diterima
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php base_url()?>Dashboard/manageOrders">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-coffee"></i>
              </div>
              <div class="mr-5">
                <?php 
            $query = $this->db->select_sum('kuantitas', 'Kuantitas');
            $query = $this->db->get('detil_order');
            $result = $query->result();
              if(empty($result[0]->Kuantitas)) {
                echo '0';
              } else {
                echo $result[0]->Kuantitas;
              } ?> Menu Terjual
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php base_url()?>Dashboard/manageOrders">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

      </div>

      <div class="row mb40">
      <div class="col-md-6 chit-chat-layer1-left">
               <div class="work-progres">
                            <div class="chit-chat-heading">
                                 <div class="card-header"><i class="fa fa-coffee"></i> Top 5 Menus </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Menu</th>
                                      <th>Total Order</th>                                                                  
                                      <th>Prosentase</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php if(!empty($topmenu)) {
                                    foreach ($topmenu as $tp) { ?>
                                <tr>
                                  <td>#</td>
                                  <td><?php echo $tp['nama']; ?></td>
                                  <td style="text-align: center"><?php echo $tp['sum(kuantitas)']; ?></td>
                                  <td><span class="badge badge-info">
                                    <?php echo number_format((($tp['sum(kuantitas)']/$total)*100),2) . '%'; ?>
                                  </span></td>
                              </tr>
                              <?php }
                                }?>
                          </tbody>
                      </table>
                  </div>
             </div>
      </div>

      <div class="col-md-6 chit-chat-layer1-left">
               <div class="work-progres">
                            <div class="chit-chat-heading">
                                 <div class="card-header"><i class="fa fa-shopping-cart"></i> Order Stats </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Status</th>
                                      <th>Total Order</th>                                                                  
                                      <th>Prosentase</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>Menunggu Pembayaran</td>
                                  <td style="text-align: center"><?php echo $this->db->where('status','Menunggu Pembayaran')->count_all_results('order')?></td>
                                  <td><span class="badge badge-info">
                                    <?php
                                    $num = $this->db->where('status','Menunggu Pembayaran')->count_all_results('order');
                                    $total = $this->db->count_all_results('order');
                                    if (empty($total)) {
                                      echo '0' . '%';
                                    } else {
                                      echo number_format((($num/$total)*100),2) . '%';
                                    }
                                    ?>
                                  </span></td>
                              </tr>
                              <tr>
                                  <td>2</td>
                                  <td>Pembayaran Telah Dilakukan</td>
                                  <td style="text-align: center"><?php echo $this->db->where('status','Pembayaran Telah Dilakukan')->count_all_results('order')?></td>
                                  <td><span class="badge badge-info">
                                    <?php
                                    $num = $this->db->where('status','Pembayaran Telah Dilakukan')->count_all_results('order');
                                    $total = $this->db->count_all_results('order');
                                    if (empty($total)) {
                                      echo '0' . '%';
                                    } else {
                                      echo number_format((($num/$total)*100),2) . '%';
                                    }
                                    ?>
                                  </span></td>
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>Pesanan Dalam Proses</td>
                                  <td style="text-align: center"><?php echo $this->db->where('status','Pesanan Dalam Proses')->count_all_results('order')?></td>
                                  <td><span class="badge badge-info">
                                    <?php
                                    $num = $this->db->where('status','Pesanan Dalam Proses')->count_all_results('order');
                                    $total = $this->db->count_all_results('order');
                                    if (empty($total)) {
                                      echo '0' . '%';
                                    } else {
                                      echo number_format((($num/$total)*100),2) . '%';
                                    }
                                    ?>
                                  </span></td>
                              <tr>
                              <td>4</td>
                                <td>Pesanan Telah Selesai</td>
                                <td style="text-align: center"><?php echo $this->db->where('status','Pesanan Telah Selesai')->count_all_results('order')?></td>
                                  <td><span class="badge badge-info">
                                    <?php
                                    $num = $this->db->where('status','Pesanan Telah Selesai')->count_all_results('order');
                                    $total = $this->db->count_all_results('order');
                                    if (empty($total)) {
                                      echo '0' . '%';
                                    } else {
                                      echo number_format((($num/$total)*100),2) . '%';
                                    }
                                    ?>
                                  </span></td>
                              </tr>
                              <td>5</td>
                                <td>Pesanan Ditolak/Dibatalkan</td>
                                <td style="text-align: center"><?php echo $this->db->where('status','Pesanan Ditolak/Dibatalkan')->count_all_results('order')?></td>
                                  <td><span class="badge badge-info">
                                    <?php
                                    $num = $this->db->where('status','Pesanan Ditolak/Dibatalkan')->count_all_results('order');
                                    $total = $this->db->count_all_results('order');
                                    if (empty($total)) {
                                      echo '0' . '%';
                                    } else {
                                      echo number_format((($num/$total)*100),2) . '%';
                                    }
                                    ?>
                                  </span></td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
             </div>
      </div>
    </div>


    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Baleni 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
