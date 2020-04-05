<?php
if (isset($_GET['id'])){
  $kode=$_GET['id'];
  extract(ArrayData($mysqli,"tb_kelompok","idkelompok='$kode'"));

}else{
  $idkelompok=KodeOtomatis($mysqli,"tb_kelompok","idkelompok","K","1","2");
  $kelompok="";
  $keterangan="";
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
            <h3 class="card-title">Olah Data Kelompok Usia</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="quickForm" action="kelompok_proses.php" method="post">
          
            <div class="card-body">
              <div class="form-group">
                <label for="nama">Kode Kelompok</label>
                <input type="text" name="kode" class="form-control" value="<?=$idkelompok?>" placeholder="Inputkan Kelompok" readonly required="">
              </div>

              <div class="form-group">
                <label for="nama">Kelompok Usia</label>
                <input type="text" name="kelompok" class="form-control" value="<?=$kelompok?>" placeholder="Inputkan Kelompok Usia" required="">
              </div>

              <div class="form-group">
                <label for="nama">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" value="<?=$keterangan?>" placeholder="Inputkan Keterangan" required="">
              </div>

            </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <input type="submit" name="<?=isset($_GET['id'])?'ubah':'tambah';?>" 
              class="btn btn-primary" value="Simpan">
              <a href="?hal=keterangan" class="btn btn-default">
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