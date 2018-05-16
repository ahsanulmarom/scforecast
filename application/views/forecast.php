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
     <form method="POST" action="<?php echo site_url('Dashboard/forecastnow') ?>"enctype="multipart/form-data">
                        <table style="font-size: 12px" width="100%">
                          <tr>
                            <td style="padding: 5px">Bulan ini</td>
                            <td style="padding: 5px">
                              <select name="bulan">
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                  <input type="number" name="tahun" placeholder="Isi Tahun" value="2017" required/>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding: 5px">Actual Demand Bulan Lalu</td>
                            <td style="padding: 5px"><input class="form-control" type="number" name="demand" placeholder="Isi Actual Demand Bulan Lalu" required/></td>
                          </tr>
                          <tr>
                            <td style="padding: 5px">α (Alpha)</td>
                            <td style="padding: 5px"><input class="form-control" type="text" name="alpha" placeholder="Isi Angka 0 hingga 1 (Pisahkan dengan titik)" required/></td>
                          </tr>
                           <tr>
                            <td style="padding: 5px">Tipe</td>
                            <td style="padding: 5px">
                              <select name="tipe">
                                <option value="1">High Demand (Kursi Tamu, Dipan, Lemari)</option>
                                <option value="2">Medium Demand (Bufet, Lemari Pakaian)</option>
                                <option value="3">Low Demand (Nakas, Meja Rias, Meja Makan, Sofa)</option>
                              </select></td>
                          </tr>
                          <tr style="padding: 5px">
                            <td></td>
                            <td style="padding: 5px" colspan="1"><input class="btn btn-primary" type="submit" value="Forecast Now!!!" /></td>
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
