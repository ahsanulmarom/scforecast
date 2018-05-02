<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>   List of Admin</div>
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
                  <th>ID</th>
                  <th>email</th>
                  <th>Admin's Name</th>
                  <th>Admin's Role</th>
                  <th>Created On</th>
                  <th>Last Login</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($admin)) {
                  foreach ($admin as $adm) { ?>
                <tr>
                  <td><?php echo $adm['id'] ?></td>
                  <td><?php echo $adm['username'] ?></td>
                  <td><?php echo $adm['adminName'] ?></td>
                  <td><?php 
                    if($adm['role'] == 1) {
                      echo 'Super Mimin';
                    } else {
                    echo 'Mimin';
                    } ?></td>
                  <td><?php echo $adm['timeCreated']; ?></td>
                  <td><?php echo $adm['lastLogin']; ?></td>
                  <?php if($adm['id'] != $this->session->userdata('loggedin')['id']) { ?>
                    <td><a href="<?php echo site_url('admin/Dashboard/deleteAdmin/' . $adm['id'])?>" style="width: auto" class="btn btn-primary"
                      onclick="javascript:confirmationDelete($(this));return false;">Delete Admin</a></td>
                  <?php } else { ?>
                  <td></td>
                </tr>
                <?php  }
                }
              }
                ?>
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