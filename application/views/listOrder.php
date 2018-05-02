<!-- Example DataTables Card-->
<script src="<?php echo base_url()?>assets/js/order.js"></script> 
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>   List of Order</div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
              if($this->session->flashdata('success')){
                echo '<div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> '.$this->session->flashdata('success').'.
              </div>';
            } elseif ($this->session->flashdata('error')) {
                echo '<div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Waduh!</strong> '.$this->session->flashdata('error').'.
              </div>';
            } ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Kode Pesan</th>
                  <th>Pemesan</th>
                  <th>Tanggal Pesan</th>
                  <th>Alamat Kirim</th>
                  <th>Tanggal Kirim</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($orderan)) {
                  foreach ($orderan as $o) { ?>
                <tr>
                  <td><?php echo $o->kode_order ?></td>
                  <td><?php echo $o->usercustomer ?></td>
                  <td><?php echo $o->tanggalorder ?></td>
                  <td><?php echo $o->alamat ?></td>
                  <td><?php echo $o->tanggalkirim ?></td>
                  <form method="POST" action="<?php echo base_url()."admin/Dashboard/updateStatus/"."$o->kode_order"?>">
                      <td>
                        <select class="input-group" name="status">
                          <option <?php if('Menunggu Pembayaran' == $o->status){ echo 'selected="selected"'; } ?> value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                          <option <?php if('Pembayaran Telah Dilakukan' == $o->status){ echo 'selected="selected"'; } ?> value="Pembayaran Telah Dilakukan"> Pembayaran Telah Dilakukan</option>
                          <option <?php if('Pesanan Dalam Proses' == $o->status){ echo 'selected="selected"'; } ?> value="Pesanan Dalam Proses">Pesanan Dalam Proses</option>
                          <option <?php if('Pesanan Telah Selesai' == $o->status){ echo 'selected="selected"'; } ?> value="Pesanan Telah Selesai">Pesanan Telah Selesai</option>
                          <option style="color: #FF0000" <?php if('Pesanan Ditolak/Dibatalkan' == $o->status){ echo 'selected="selected"'; } ?> value="Pesanan Ditolak/Dibatalkan">Pesanan Ditolak/Dibatalkan</option>
                        </select>
                        <input style="width: auto" class="btn btn-primary" type="submit" name="submit" value="Ubah Status">
                        </td>
                      </form>
                  <td><a data-toggle="modal" data-target="#detilorder" class="btn btn-primary" href="#" onclick="barang_more('<?php echo $o->kode_order?>')" >View More</a></td>
                <?php 
                  }
                }
                ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
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

<script type="text/javascript">
  function confirmationTerima(anchor){
   var conf = confirm('Are you sure want to accept this order?');
   if(conf)
      window.location=anchor.attr("href");
  }
</script>

<script type="text/javascript">
  function confirmationTolak(anchor){
   var conf = confirm('Are you sure want to reject this order?');
   if(conf)
      window.location=anchor.attr("href");
  }
</script>

<script type="text/javascript">
  function confirmationDelete(anchor){
   var conf = confirm('Are you sure want to delete this record?');
   if(conf)
      window.location=anchor.attr("href");
  }
</script>

<!-- Modal Edit SLIDER -->
<div id="detilorder" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detil Order</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="headeratas">

        </div>
        <div>
            <table class="table">
                    <thead>
                        <tr>
                        <th>Kuantitas</th>
                        <th>Barang</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody  id="ket_barang">
                        
                    </tbody>
                        <tr> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Kode Unik</th>
                            <td id="kodeunik"></td>
                        </tr>
                        <tr> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Total</th>
                            <td id="total"></td>
                        </tr>
                        <tr> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Sudah Bayar</th>
                            <td id="sudahbayar"></td>
                        </tr>
                        <tr> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Sisa</th>
                            <td id="sisabayar"></td>
                        </tr>
            </table>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>