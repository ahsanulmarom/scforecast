<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>   List of Menu</div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
              if($this->session->flashdata('success')){
                echo '<div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> '.$this->session->flashdata('success').'.
              </div>';
            } ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($menu)) {
                  foreach ($menu as $m) { ?>
                <tr>
                  <td><img src="<?php echo base_url().$m['image']?>" id='image-load' ?>
                    <br>
                  <?php echo $m['kode'] ?></td>
                  <td><?php echo $m['nama'] ?>
                    <br>
                    <br>
                    <?php echo $m['deskripsi']; ?>
                  </td>
                  <td><?php echo $m['kategori']; ?></td>
                  <td>Rp <?php echo $m['harga']; ?></td>
                  <td>
                    <p><a href="<?php echo site_url('admin/Dashboard/editmenu/'.$m['kode'])?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit menu</a></p>
                    <p><a href="<?php echo site_url('admin/Dashboard/deletemenu/'.$m['kode'])?>" onclick="javascript:confirmationDelete($(this));return false;"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus menu</a></p>
                  </td>
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
          <small>Copyright © Baleni 2017</small>
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