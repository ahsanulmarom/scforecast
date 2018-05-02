    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Our Menus</h1>
                    
                </div>
            </div>
        </div>
    </section>

    <section class="breakfast-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <?php if(!empty($menu)) { 
                        foreach ($menu as $m) { ?>
                    <div class="breakfast-menu-content">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="left-image">
                                    <img src="<?php echo base_url() . $m['image']; ?>" alt="$m['nama']">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <h2><?php echo $m['nama']; ?></h2>
                                <div id="owl-breakfast" class="owl-carousel owl-theme">
                                </div>
                                
                    <form method="post" action="<?php echo base_url()?>Order/add">
                                <table width="400px">
                                <tr>
                                    <td>Harga</td>
                                    <td><span class="badge badge-info"><?php echo 'Rp ' . number_format($m['harga'],2)?></span></td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td><?php echo $m['kategori']?></td>
                                </tr>
                                <tr>
                                    <td>Deskripsi </td>
                                    <td><?php echo $m['deskripsi']?></td>
                                </tr>
                            <tr>
                                <input type="hidden" name="name" value="<?php echo $m['nama']?>">
                                <input type="hidden" name="price" value="<?php echo $m['harga']?>">
                                <input type="hidden" name="id" value="<?php echo $m['kode']?>">

                                <td>Banyaknya</td>
                                <td style="padding: 5px"><input type="number" min="0" max="1000" placeholder="min. 15 box " class="form-control" name="qty"></td>
                            </tr>
                            <tr>
                                <td>Pesan</td>
                                <td style="padding: 5px"><textarea name="deskripsi" type="text" class="form-control" placeholder="Tuliskan request khusus anda, ex: Pedas, Cabai 3"></textarea></td>
                            </tr>
                            <tr>
                                <div class="chute chute-center text-center">
                                <td></td>
                                <td style="padding: 5px"><input type="submit" class="btn btn-primary" name="submit" value="Add to Cart Now"></td>
                                </div>
                            </tr>
                        </table>
                    </form>

                            </div>
                        </div>
                    </div>
                    <br>
                    <?php }
                }?>
                </div>
            </div>
        </div>
    </section>
    <br> <br> <br>

   