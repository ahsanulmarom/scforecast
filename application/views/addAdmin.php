<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-user"></i>   Add Admin</div>
        <div class="card-body">
          <div class="demo-grid" style="padding:20px">
            <form action="<?php echo base_url()?>admin/Dashboard/insertadmin" method="POST" enctype="multipart/form-data">
            <!-- huuu-->
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
              <table style="font-size: 12px" width="100%">
                <tr>
                  <td style="padding: 5px">Admin's Email</td>
                  <td style="padding: 5px"><input class="form-control" type="email" name="emailnewadmin" required /></td>
                </tr>
                <tr>
                  <td style="padding: 5px">Password</td>
                  <td style="padding: 5px"><input class="form-control" type="password" name="passwordnewadmin" required/></td>
                </tr>
                <tr>
                  <td style="padding: 5px">Admin's Name</td>
                  <td style="padding: 5px"><input class="form-control" type="text" name="namenewadmin" required/></td>
                </tr>
                <tr style="padding: 5px">
                  <td style="padding: 5px">Role</td>
                  <td style="padding: 5px">
                    <select name="rolenewadmin" class="form-control" required>
                      <option value="1">Super Mimin</option>
                      <option value="0">Mimin</option>
                    </select>
                  </td>
                </tr>
                <tr style="padding: 5px">
                  <td></td>
                  <td style="padding: 5px" colspan="1"><input class="btn btn-primary" type="submit" name="submit" value="Add Admin" /></td>
                </tr>
              </table>
            </form>
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