<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-coffee"></i>   <?php echo $title; ?></div>
        <div class="card-body">
          <div class="demo-grid" style="padding:20px">
            <?php if($this->session->flashdata('success')){
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
            <div class="row mb40">
            <div class="col-md-6">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($kategori)) {
                  foreach ($kategori as $kategori) { ?>
                <tr>
                  <td><?php echo $kategori['namaKategori'] ?></td>
                  <td><a href="<?php echo site_url('admin/Dashboard/deleteCategory/'. $kategori['id'])?>" style="width: auto" class="btn btn-danger"
                      onclick="javascript:confirmationDelete($(this));return false;">Delete</a></td>
                </tr>
                <?php }
              }?>
              </tbody>
            </table>
            </div>
            <div class="col-md-6">
            <form action="<?php echo base_url()?>admin/Dashboard/addCategory" method="POST" enctype="multipart/form-data">
              <table style="font-size: 12px" width="100%">
                <tr>
                  Add Category
                </tr>
                <tr>
                  <td style="padding: 5px"><input class="form-control" type="text" name="newcategory" placeholder="Enter new category here!" required /></td>
                </tr>
                <tr style="padding: 5px">
                  <td style="padding: 5px" colspan="1"><input class="btn btn-success" type="submit" name="submit" value="Add Category" /></td>
                </tr>
              </table>
            </form>
            </div>
          </div>
          </div>
          </div>
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