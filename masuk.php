<div class="block-flat opacity-80">
        <form class="form-horizontal" action="cek_login.php" method="post">
          <div class="content">
            <h3 class="title text-center">Login Siswa</h3>
              <hr>


        <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user fa-1x"></i></span>
		          <input type="text" class="form-control" name="nis" id="em" placeholder="Nis" required>
            </div>
        </div>


        <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-unlock fa-1x"></i></span>
              <input type="password" class="form-control" name="pass" id='pa' placeholder="Password" required><br />
            </div>
        </div>

        <br>
        <p class="spacer text-center" data-toggle="modal" data-target="#mod-error" ><a href="#">Belum punya akun? Daftar sekarang !</a></p>
        <button class="btn btn-block btn-success btn-rad btn-lg" type="submit" name="submit" id='submit-login'>Masuk</button>
<br>
          </div>
        </form>
</div>

                <div class="modal fade" id="mod-error" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                      <div class="text-center">
                      <?php
                      $form = mysql_query("SELECT * FROM tb_set WHERE set_id = 1  AND status = 'off'");
                      if(mysql_num_rows($form) == 1){
                      echo "<div class='i-circle danger'><i class='fa fa-times'></i></div>
                        <h4>Pendaftaran Ditutup !</h4>
                        <p>Hubungi Admin untuk mendaftar.</p>
                        
                      </div>
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-xs btn-danger' data-dismiss='modal'>Keluar</button>
                    </div>";
                      }else{
                      ?>
                      <?php
                      include'daftar.php';
                      }
                      ?>  
                      </div>
                    </div>
                    </div>
                  </div>
                </div>