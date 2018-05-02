<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-coffee"></i>   <?php echo $title; ?></div>
        <div class="card-body">
          <div class="demo-grid" style="padding:20px">
            <form action="<?php echo base_url()?>admin/Dashboard/insertMenu" method="POST" enctype="multipart/form-data">

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
              Foto Menu
              <td rowspan="6"><img id="image-preview" alt="image preview"/>
              <br/>
              <input type="file" id="image-source" name="previewimage" required onchange="previewImage();"/></td>
                  <td style="padding: 5px">Kode Menu</td>
                  <td style="padding: 5px"><input class="form-control" type="text" name="kodemenu" placeholder="Kode Makanan harus berbeda dengan yang lain" required /></td>
                </tr>
                <tr>
                  <td style="padding: 5px">Nama Menu</td>
                  <td style="padding: 5px"><input class="form-control" type="text" name="namamenu" placeholder="Masukkan nama menu makanan" required/></td>
                </tr>
                <tr>
                  <td style="padding: 5px">Kategori</td>
                  <td style="padding: 5px"><select class="form-control" name="kategorimenu" title="namaKategori">
                    <?php foreach($namakategori as $k){?>
                    <option value="<?php echo $k['namaKategori']?>"><?php echo $k['namaKategori']; ?></option>
                    <?php }?>
                  </select></td>
                </tr>
                <tr>
                  <td style="padding: 5px">Harga</td>
                  <td style="padding: 5px"><input class="form-control" type="number" min=0 name="hargamenu" placeholder="Hanya angka" required/></td>
                </tr>
                <tr>
                  <td style="padding: 5px">Deskripsi</td>
                  <td style="padding: 5px"><textarea class="form-control" name="deskripmenu" required></textarea></td>
                </tr>
                <tr style="padding: 5px">
                  <td></td>
                  <td style="padding: 5px" colspan="1"><input class="btn btn-primary" type="submit" name="submit" value="Add Menu" /></td>
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

    <script type="text/javascript">
    function previewImage() {
      document.getElementById("image-preview").style.display = "block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview").src = oFREvent.target.result;
      };
    };
    </script>