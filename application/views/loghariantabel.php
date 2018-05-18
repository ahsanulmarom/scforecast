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
                  <th><center>Tanggal</center></th>
                  <th><center>Kode Barang</center></th>
                  <th><center>Nama Barang</center></th>
                  <th><center>Demand</center></th>
                  <th><center>Biaya yang Dikeluarkan</center></th>
                  <th><center>Lead time</center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($log)) {
                  foreach ($log as $d) { ?>
                <tr>
                  <td><?php echo $d['tanggal']; ?></td>
                  <td><?php echo $d['kodebarang']; ?></td>
                  <td><?php echo $d['namabarang']; ?></td>
                  <td><?php echo $d['demand']; ?></td>
                  <td><?php echo $d['cost']; ?></td>
                  <td><?php echo $d['leadtime']; ?></td>
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