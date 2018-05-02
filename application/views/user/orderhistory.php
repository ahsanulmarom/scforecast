 <section class="breakfast-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breakfast-menu-content">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Order History</h2>
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
                                        <th style="text-align: center">Kode Pesan</th>
                                        <th style="text-align: center">Tanggal Pesan</th>
                                        <th style="text-align: center">Alamat Kirim</th>
                                        <th style="text-align: center">Tanggal Kirim</th>
                                        <th style="text-align: center">Harga Total</th>
                                        <th style="text-align: center">Status</th>
                                      </tr>
                                        </thead>
                                         <tbody>
                                            <?php
                                            if(!empty($orderan)) {
                                            foreach ($orderan as $o) { ?>
                              <tr>
                                <td style="width: 300px"><?php echo $o['kode_order']; ?>
                                  <br>
                                  <a href="<?php echo site_url('Home_Dashboard/review/' . $o['kode_order'])?>">Klik Here to See Invoice</a>
                                </td>
                                <td style="width: 300px"><?php echo $o['tanggalorder']; ?></td>
                                <td style="width: 300px"><?php echo $o['alamat']; ?></td>
                                <td style="width: 300px"><?php echo $o['tanggalkirim']; ?></td>
                                <td style="width: 300px"><?php echo 'Rp' . number_format($o['totalbayar']); ?></td>
                                <td style="width: 300px"><?php echo $o['status']; ?></td>
                              </tr>
                            </tbody>
                                <?php }
                                  }?>
                              </table>
                                    </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                </section><br><br><br><br><br><br>

