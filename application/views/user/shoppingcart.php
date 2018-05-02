<section>
<div style="min-height: 80vh">
		<div class="container-fluid text-center" style="margin-top: 20px;">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url()?>Home_Dashboard/menu">Menu</a></li>
				<li class="active"><a href="#">Keranjang</a></li>
			</ol>
		</div>
		
		<div class="container text-center demo-grid-wht" style="padding: 15px;margin-bottom: 20px">

			<div class="col-md-7 col-sm-12 text-left" style="padding-right: 20px;padding-left: 5px">
			<div class="">
			<div>
				<?php 
				$cart_cek = $this->cart->contents();
				if (empty($cart_cek)) {
					echo 'Tidak ada produk di shopping cart!!';
				} ?>
			</div>

			<?php
			$cart = $this->cart->contents();
			 if ($cart) {?>

				<form method="post" action="<?php echo base_url()?>Order/update_cart">
				<table id="cart" class="table table-hover table-condensed">
					<tr>
						<td style="width:auto;">QTY</td>
						<td style="width:auto;">MENU</td>
						<td style="width:auto;">HARGA</td>
						<td style="width:auto;">TOTAL</td>
						<td style="width:auto;">Aksi</td>
					</tr>
					<?php
					$total = 0;
					 foreach ($cart as $c) {
						echo form_hidden('cart[' . $c['id'] . '][id]', $c['id']);
						echo form_hidden('cart[' . $c['id'] . '][rowid]', $c['rowid']);
						echo form_hidden('cart[' . $c['id'] . '][name]', $c['name']);
						echo form_hidden('cart[' . $c['id'] . '][price]', $c['price']);
						echo form_hidden('cart[' . $c['id'] . '][qty]', $c['qty']);
						echo form_hidden('cart[' . $c['id'] . '][deskripsi]', $c['deskripsi']);
						?>
					<tr>

						<td><input name="<?php echo 'cart['.$c['id'].'][qty]'?>" type="number" min='0' class="form-control text-center" value="<?php echo $c['qty'];?>" style="width: 80%;"></td>
						<td><?php echo $c['name'];?></td>
						<td>IDR <?php echo number_format($c['price'],2);?></td>
						<?php $total = $total+$c['subtotal'];?>
						<td style="color: #008dd2">IDR <?php echo number_format($c['subtotal'],2);?></td>
						<td><a href="<?php echo base_url()?>Order/remove/<?php echo $c['rowid'];?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
					</tr>
					<?php } ?>
					<tr>
						<td>
							<button type="submit" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
						</td>
						<td></td>
						<td>Total :</td>
						<td>IDR <?php echo number_format($total,2) ?></td>
					</tr>
				</table>
				</form>
				<?php } ?>
				
			</div>
			</div>

		<form method="POST" action="<?php echo base_url();?>Order/saveOrder">		
			<div class="col-md-5 col-sm-12">
			<input type="hidden" name="subtotal" value="<?= isset($total)? $total: ''; ?>">
			<div class="" style="margin-bottom: 20px;">
				<table>
					<tr>
						<td style="padding: 5px">Nama Penerima</td>
						<td style="padding: 10px"><input type="text" name="nama" value="<?php echo $detail->nama?>" readonly="" class="form-control"></td>
					</tr>
					<tr>
						<td style="padding: 5px">Alamat Penerima</td>
						<td style="padding: 10px"><input type="text" class="form-control" name="alamat" required="" placeholder="Nama Jalan dan Nomor Rumah"></td>
					</tr>
					<tr>
						<td style="padding: 5px">Kota</td>
						<td style="padding: 10px">
							<select name="kab" class="form-control" id="kabupaten">
								<option>-- Pilih Kota --</option>
								<?php foreach($kota as $prov){
									echo '<option value="'.$prov->id.'">'.$prov->nama.'</option>';
								} ?>
							</select>
						</td>
				    </tr>
				    <tr>
						<td style="padding: 5px">Kecamatan</td>
							<td style="padding: 10px">
							<select name="kec" class="form-control" id="kecamatan">
				    			<option>Pilih Kota Terlebih Dahulu</option>
				    		</select>
						</td>
					</tr>
					<tr>
						<td style="padding: 5px">Kelurahan</td>
							<td style="padding: 10px">
							<select name="des" class="form-control" id="desa">
				    			<option>Pilih Kecamatan Terlebih Dahulu</option>
				    		</select>
						</td>
					</tr>
					<tr>
						<td style="padding: 5px">No Telepon Penerima</td>
						<td style="padding: 10px"><input class="form-control" type="text" name="telp" required></td>
					</tr>
					<tr>
						<td style="padding: 5px">Tanggal Kirim</td>
						<td style="padding: 10px"><input class="form-control" type="datetime-local" name="tglkirim" placeholder="mm/dd/yyyy hh:mm" required></td>
					</tr>
				</table>
				

			<div style="margin: 10px">
				<table>
				<th><label>Total Bayar : </label></th>
				<td>IDR <?= isset($total)? number_format($total): '0'; ?></span></td>
				<td id="b_tot" style="width: 50%">

				</td>
				</table>
			</div>

				<div class="elemen">
					<a href="<?php echo base_url()?>Home_Dashboard/menu" class="btn btn-primary">Lanjut Belanja</a>
					<button class="btn btn-success" <?php if (empty($cart_cek)) {
					echo 'disabled';
				} ?> href="">Lanjut Bayar</button>
				</div>

			</div>
			</div>
		</form>
		</div>
</div>	
</section>