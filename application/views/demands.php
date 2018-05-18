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
     <form method="POST" action="<?php echo site_url('Dashboard/insertdemand') ?>"enctype="multipart/form-data">
                        <table style="font-size: 12px" width="100%">
                          <tr>
                            <td style="padding: 5px">Tanggal</td>
                            <td style="padding: 5px">
                                <input class="form-control" type="date" name="tanggal" placeholder="Tanggal" required/>
                              </td>
                          </tr>
                          <tr>
                              <td style="padding: 5px">Kode Barang</td>
                            <td style="padding: 5px"><input class="form-control" type="text" name="kodebarang" placeholder="Kode Barang" required/></td>
                          </tr>
                         <tr>
                              <td style="padding: 5px">Nama Barang</td>
                            <td style="padding: 5px"><input class="form-control" type="text" name="namabarang" placeholder="Nama Barang" required/></td>
                              
                          </tr>
                            <tr>
                              <td style="padding: 5px">Biaya Pengeluaran Barang</td>
                            <td style="padding: 5px"><input class="form-control" type="number" name="cost" placeholder="Biaya yang dikeluarkan" required/></td>
                              
                          </tr>    
                          <tr>
                              <td style="padding: 5px">Jumlah Demand</td>
                            <td style="padding: 5px"><input class="form-control" type="number" name="demand" placeholder="Jumlah Permintaan hari input" required/></td>
                              
                           </tr>
                          <tr>
                              <td style="padding: 5px">Waktu Produksi</td>
                            <td style="padding: 5px"><input class="form-control" type="number" name="leadtime" placeholder="Waktu Produksi barang dalam hari" required/></td>
                              
                          </tr> 
                          <tr style="padding: 5px">
                            <td></td>
                            <td style="padding: 5px" colspan="1"><input class="btn btn-primary" type="submit" value="Insert" /></td>
                          </tr>
                        </table>
                      </form>


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
