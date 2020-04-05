<?php
if (isset($_GET['id'])){
  $kode=$_GET['id'];
  extract(ArrayData($mysqli,"tb_bunga","idbunga='$kode'"));

}else{
  $idbunga=KodeOtomatis($mysqli,"tb_bunga","idbunga","B","1","2");
  $lamapinjam="";
  $bunga="";
}
?>

<!-- Main content -->
<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Olah Data Bunga</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="quickForm" action="bunga_proses.php" method="post">
          
            <div class="card-body">
              <div class="form-group">
                <label for="nama">Kode Bunga</label>
                <input type="text" name="kode" class="form-control" value="<?=$idbunga?>" placeholder="Inputkan Kode Bunga" readonly required="">
              </div>

              <div class="form-group">
                <label for="nama">Lama Pinjam /Bulan</label>
                <input type="number" name="lamapinjam" class="form-control" value="<?=$lamapinjam?>" placeholder="Inputkan Lama Pinjam" required="">
              </div>

              <div class="form-group">
                <label for="nama">Bunga /Persen</label>
                <input type="number" name="bunga" class="form-control" value="<?=$bunga?>" placeholder="Inputkan Bunga" required="">
              </div>

            </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <input type="submit" name="<?=isset($_GET['id'])?'ubah':'tambah';?>" 
              class="btn btn-primary" value="Simpan">
              <a href="?hal=bunga" class="btn btn-default">
                Batal
              </a>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->