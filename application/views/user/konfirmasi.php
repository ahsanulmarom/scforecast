<link href="<?php echo base_url()?>assets/css/profileuser.css" rel="stylesheet" type="text/css" media="all">
<section class="banner">
		<div class="container">
                <div id="konf1">
			     <div class="col-md-6 col-md-offset-3">		
			       <div class="demo-grid"">
                         <div id="konf">

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
            
                <h1 class="Konfirmasi h1">Konfirmasi Pembayaran</h1>
				<form action="<?php echo base_url()."Order/saveBayar"?>" method="POST" enctype="multipart/form-data">
                            <table class="konfirm">
                                <tr>
                                    <td>Kode Order</td>
                                    <td><input class="form-control" type="text" name="kode" value="<?php echo $kode ?>" readonly/></td>
                                </tr>
                                <tr>
                                    <td>Nama Pembayar</td>
                                    <td><input class="form-control" type="text" name="namabayar" required/></td>
                                </tr>
                                <tr>
                                    <td>Total Pembayaran</td>
                                    <td><input class="form-control" type="text" name="jumlahbayartotal" value="<?php echo 'Rp '.number_format($total,2) ?>" readonly/></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Bayar</td>
                                    <td><input class="form-control" type="text" name="jumlahbayar" required placeholder="Hanya Angka"/></td>
                                </tr>
                                <tr>
                                    <td>Bukti Bayar</td>
                                    <td><input type="file" name="buktibayar" required ></td>
                                </tr>
                                <tr>
                                	<td></td>
                                    <td colspan="2"><input class="btn btn-primary" type="submit" name="submit" value="Konfirmasikan" /></td>
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
    <div>
</section>