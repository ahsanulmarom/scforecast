<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>   <?php echo $title; ?></div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
              if($this->session->flashdata('success')){
                echo '<div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> '.$this->session->flashdata('success').'.
              </div>';
            } ?>
          </br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><center>Bulan</center></th>
                  <th><center>Kode Barang</center></th>
                  <th><center>Nama Barang</center></th>
                  <th><center>Rata-rata Demand</center></th>
                  <th><center>Standar Deviasi</center></th>
                  <th><center>Rata-rata Lead time</center></th>
                  <th><center>Standar Deviasi</center></th>
                  <th><center>Safety Stok</center></th>
                  <th><center>Reorder Point</center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($rop)) {
                  foreach ($rop as $d) { ?>
                <tr>
                  <td><?php 
                  if($d['bulan'] == 1) {
                    echo "Januari " . $d['tahun'];
                  } else if($d['bulan'] == 2) {
                    echo "Februari " . $d['tahun'];
                  } else if($d['bulan'] == 3) {
                    echo "Maret " . $d['tahun'];
                  } else if($d['bulan'] == 4) {
                    echo "April " . $d['tahun'];
                  } else if($d['bulan'] == 5) {
                    echo "Mei " . $d['tahun'];
                  } else if($d['bulan'] == 6) {
                    echo "Juni " . $d['tahun'];
                  } else if($d['bulan'] == 7) {
                    echo "Juli " . $d['tahun'];
                  } else if($d['bulan'] == 8) {
                    echo "Agustus " . $d['tahun'];
                  } else if($d['bulan'] == 9) {
                    echo "September " . $d['tahun'];
                  } else if($d['bulan'] == 10) {
                    echo "Oktober " . $d['tahun'];
                  } else if($d['bulan'] == 11) {
                    echo "November " . $d['tahun'];
                  } else if($d['bulan'] == 12) {
                    echo "Desember " . $d['tahun'];
                  }
                  ?></td>
                  <td><?php echo $d['kodebarang']; ?></td>
                  <td><?php echo $d['namabarang']; ?></td>
                  <td><?php echo $d['demandbulan']; ?></td>
                  <td><?php echo $d['sd']; ?></td>
                  <td><?php echo $d['lead']; ?></td>
                  <td><?php echo $d['sl']; ?></td>
                  <td><?php echo $d['ss']; ?></td>
                  <td><?php echo $d['ROP']; ?></td>
                </tr>
                <?php }
              }?>
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
          <small>Copyright © CV Ihtiar Jaya 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <script type="text/javascript">
  function confirmationDelete(anchor){
   var conf = confirm('Are you sure want to delete this record?');
   if(conf)
      window.location=anchor.attr("href");
  }
</script>