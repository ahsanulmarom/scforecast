     <!-- Icon Cards-->
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
      <div class="row mb40">
      <div class="col-md-6 chit-chat-layer1-left">
               <div class="work-progres">
                            <div class="chit-chat-heading">
                                 <div class="card-header"><i class="fa fa-address-card"></i> My Account </div>
                            </div>
                            <div class="table-responsive">
                        <table style="font-size: 12px" width="100%">
                          <tr>
                            <td style="padding: 5px">Username</td>
                            <td style="padding: 5px"><?php echo $this->session->userdata('loggedin')['username']?></td>
                          </tr>
                          <tr>
                            <td style="padding: 5px">My Name</td>
                            <td style="padding: 5px"><?php echo $this->session->userdata('loggedin')['name']?></td>
                          </tr>
                          <tr>
                            <td style="padding: 5px">My Role</td>
                            <td style="padding: 5px">
                              <?php if($this->session->userdata('loggedin')['role'] == 1) {
                                echo 'Super Mimin';
                              } else {
                                echo 'Mimin';
                              }
                                ?>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding: 5px">Created on</td>
                            <td style="padding: 5px"><?php echo $this->session->userdata('loggedin')['created']?></td>
                          </tr>
                          <tr style="padding: 5px">
                            <td style="padding: 5px">Last Login</td>
                            <td style="padding: 5px"><?php echo $this->session->userdata('loggedin')['time']?></td>
                          </tr>
                        </table>
                  </div>
             </div>
      </div>

      <div class="col-md-6 chit-chat-layer1-left">
               <div class="work-progres">
                            <div class="chit-chat-heading">
                                 <div class="card-header"><i class="fa fa-user-secret"></i> Change Password </div>
                            </div>
                            <div class="table-responsive">
                        <form method="POST" action="<?php echo site_url('admin/Auth/ubahpass/' . $this->session->userdata('loggedin')['username']) ?>" enctype="multipart/form-data">
                        <table style="font-size: 12px" width="100%">
                          <tr>
                            <td style="padding: 5px">Old Password</td>
                            <td style="padding: 5px"><input class="form-control" type="password" name="opassword" required /></td>
                          </tr>
                          <tr>
                            <td style="padding: 5px">New Password</td>
                            <td style="padding: 5px"><input class="form-control" type="password" name="npassword" required/></td>
                          </tr>
                          <tr>
                            <td style="padding: 5px">Confirm New Password</td>
                            <td style="padding: 5px"><input class="form-control" type="password" name="cpassword" required/></td>
                          </tr>
                          <tr style="padding: 5px">
                            <td></td>
                            <td style="padding: 5px" colspan="1"><input class="btn btn-primary" type="submit" value="Change Password" /></td>
                          </tr>
                        </table>
                      </form>
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
