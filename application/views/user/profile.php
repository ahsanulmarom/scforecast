<script type="text/javascript">
    var BASE_URL = '<?= base_url()?>';
</script>
<link href="<?php echo base_url()?>assets/css/profileuser.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url()?>assets/css/animate-custom.css" rel="stylesheet" type="text/css" media="all">

<div class="container" style="min-height: 91vh">
<div class="inner-block">
    <div class="cols-grids panel-widget">
    <div class="chute chute-center text-center">
    	<h2>My Profile</h2>
    </div>
    	
                        <?php
                            if ($this->session->flashdata('error')) {
                                echo '<div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Oops!</strong> '.$this->session->flashdata('error').'
</div>';
                             }elseif($this->session->flashdata('success')){
                                echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> '.$this->session->flashdata('success').'.
</div>';
                                } ?>
                    <div class="wrapper">
                        <div id="gen" class=" form">
                            <table>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $username; ?></td>
                                </tr>
                                <tr>
                                    <td>email</td>
                                    <td><?php echo $email; ?></td>
                                </tr>
                                <tr>
                                    <td>alamat</td>
                                    <td><?php echo $alamat; ?><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>nama</td>
                                    <td><?php echo $nama; ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><a class="btn btn-primary" id="cpro" href="#" />Edit Profile</a></td>
                                </tr>
                            </table>
                        </div> <!-- general  -->

                        <div id="ch" class=" form" style="display: none;">
                            <form action="<?php echo base_url()?>Home_dashboard/chgpass/<?php echo $username;?>" method="POST">
                            <table>
                                <tr>
                                    <td>Username</td>
                                    <td><input class="input-group" type="text" value="<?php echo $username; ?>" name="usern" disabled /></td>
                                </tr>
                                <tr>
                                    <td>Old Password</td>
                                    <td><input class="input-group" type="password" name="opassword"/></td>
                                </tr>
                                <tr>
                                    <td>New Password</td>
                                    <td><input class="input-group" type="password" name="npassword"  /></td>
                                </tr>
                                <tr>
                                    <td>Confirm New Password</td>
                                    <td><input class="input-group" type="password" name="cpassword"  /></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input class="btn btn-primary" type="submit" name="submitchange" value="Submit" /> <a id="gp1" href="#" type="button" class="btn btn-danger">Cancel</a></td>
                                </tr>
                            </table>
                            </form>
                        </div> <!-- change -->

                        <div id="gan" class=" form" style="display: none;">
                            <form action="<?php echo base_url() ?>Home_dashboard/chgProfile" method="POST" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td>Username</td>
                                    <td><input class="input-group" type="text" value="<?php echo $username; ?>" name="uname" disabled /></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td><input class="input-group" value="<?php echo $nama?>" type="text" name="nama" required/></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input class="input-group" value="<?php echo $email?>" type="email" name="email" required/></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td><input class="input-group" value="<?php echo $alamat?>" type="text" name="alamat" placeholder="Isi nama Jalan" required/></td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td><select class='input-group' id='provinsi' name='prop' required>
                                        <option value='0'>-- Pilih Propinsi --</option>
                                    <?php 
                                        foreach ($provinsi as $prov) {
                                            echo "<option value='".$prov[id]."'>".$prov[name]."</option>";
                                        }
                                    ?>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Kota</td>
                                    <td><select class='input-group' id='kabupaten-kota' name='kotkab' required>
                                        <option value='0'>-- Pilih Kota --</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td><select class='input-group' id='kecamatan' name='kec'>
                                        <option value='0'>-- Pilih Kecamatan --</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Kode Pos</td>
                                    <td><input class="input-group" value="<?php echo $kodepos?>" type="text" name="kodepos" required/></td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td><input class="input-group" value="<?php echo $notelp?>" type="text" name="notelp" required/></td>
                                </tr>
                                <tr>
                                    <td>Foto Profil</td>
                                    <td><input class="input-group" type="file" name="image" /></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input class="btn btn-primary" type="submit" name="submitedit" value="Submit Edit" /> <a id="gp1" href="#" type="button" class="btn btn-danger">Cancel</a></td>
                                </tr>
                            </table>
                            </form>
                        </div> <!-- ganti -->

                     <div id="or" class=" form" style="display: none;">
                            <h2 style="text-align: center">Riwayat Order</h2>
                        <div style="margin: 20px;">
                            <h4>Ready Stok Order</h4>
                        </div>
                        <div class="table-responsive">
                          <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Total Pembayaran</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($order1)) { ?>
                              <?php $i=0; foreach ($order1 as $o1) { $i++;?>
                                <tr >
                                    <td><?= $i;?></td>
                                    <td><a  data-toggle="modal" data-target="#detilorder" href="#" onclick="detil_order('<?= $o1->id ?>')"><?php echo $o1->kode_order ?></a></td>
                                    <td><?php echo $o1->date ?></td>
                                    <td><?php echo ($o1->subtotal)+($o1->biaya) ?></td>
                                    <td><?php echo $o1->status_bayar ?></td>
                                    <td>                    

                    <?php if($o1->status_bayar == "Belum Dibayar") {
                        echo '<a href="'.base_url()."Home/confirm/".$o1->kode_order.'">Konfirmasi Pembayaran</a>';
                    } else if($o1->status_bayar == "Telah Dikirm") {
                        echo '<a href="'.base_url()."Home/sudahditerima1/".$o1->kode_order.'">Konfirmasi Pembayaran</a>';      
                    } else {
                        echo '';
                    }?>
                        
                    </td>
                                </tr>
                                <?php } ?>
                            <?php } else {
                                echo " ";
                            } ?>
                            </tbody>
                          </table>
                        </div> 

                         <div style="margin: 20px;">
                            <h4>Custom Order</h4>
                        </div>
                        <div class="table-responsive">
                          <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Order</th>
                                    <th>Tanggal</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($order)) { ?>
                              <?php $i=0; foreach ($order as $o) { $i++;?>
                                <tr >
                                    <td><?= $i;?></td>
                                    <td><a  data-toggle="modal" data-target="#modalJasa" href="#" onclick="jasa_more('<?= $o->kode ?>')"><?php echo $o->kode ?></td>
                                    <td><?php echo $o->tanggal ?></td>
                                    <td><?php echo $o->total ?></td>
                                    <td><?php echo $o->statusorder ?></td>
                                    <td>
                    <?php if($o->statusorder == "Belum Dibayar") {
                        echo '<a href="'.base_url()."Home/confirm/".$o1->kode_order.'">Konfirmasi Pembayaran</a>';
                    } else if($o->statusorder == "Telah Dikirm") {
                        echo '<a href="'.base_url()."Home/sudahditerima/".$o1->kode_order.'">Konfirmasi Pembayaran</a>';      
                    } else {
                        echo '';
                    }?>
                                    </td>
                                </tr>
                                <?php } ?>
                            <?php } else {
                                echo " ";
                            } ?>
                            </tbody>
                          </table>
                        </div> 
                        </div> <!-- order -->


                    </div>
                </div>
            </div>
    </div>
</div>
</div>
</div>


<!-- <?php $this->load->view('home/footer'); ?> -->


<!-- Modal Edit SLIDER -->
<div id="detilorder" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detil Order</h4>
      </div>
      <div class="modal-body">
        <div id="ket_atas">

        </div>
        <div>
            <table class="table">
                    <thead>
                        <tr>
                        <th>Kuantitas</th>
                        <th>Barang</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody  id="ket_barang">
                        
                    </tbody>
                    <tr> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Subtotal</th>
                            <td id="foot_order2"></td>
                        </tr>
                        <tr> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Ongkir</th>
                            <td id="foot_order1"></td>
                        </tr>
                        <tr> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Total</th>
                            <td id="foot_order"></td>
                        </tr>
            </table>
        </div>
      <div class="modal-footer">
      <a id="cekinv" class="btn btn-primary" href="">Cek Invoice</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>

<!-- Modal -->
<div id="modalJasa" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Order</h4>
      </div>
      <div class="modal-body" id="modalorder">
      </div>
      <div class="modal-footer">
      <a id="cekinv1" class="btn btn-primary" href="">Cek Invoice</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript" src="<?= base_url()?>assets/js/autoNumeric.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/js/user.js"></script>

<script type="text/javascript">
     $(document).ready(function(){
        $('#table').DataTable();
        $('#table1').DataTable();
    });
</script>

                        <script type="text/javascript">
                        $(function(){
                            $.ajaxSetup({
                                type:"POST",
                                url: "<?php echo base_url()?>Home_dashboard/ambil_data",
                                cache: false,
                            });

                            $("#provinsi").change(function(){
                                var value=$(this).val();
                                if(value>0){
                                    $.ajax({
                                        data:{modul:'kabupaten',id:value},
                                        success: function(respond){
                                            $("#kabupaten-kota").html(respond);
                                        }
                                    })
                                }
                            })

                            $("#kabupaten-kota").change(function(){
                                var value=$(this).val();
                                if(value>0){
                                    $.ajax({
                                        data:{modul:'kecamatan',id:value},
                                        success: function(respond){
                                            $("#kecamatan").html(respond);
                                        }
                                    })
                                }
                            })

                            $("#kecamatan").change(function(){

                            });
                        });
                        </script>


