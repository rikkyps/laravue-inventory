<template>
  <div>
    <div class="row justify-content-center">
      <div class="login-box">
        <div class="login-logo">
          <a href="javascript:;"><b>PT. PSG</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Lupa Password</p>

            <form action="../../index3.html" method="post">
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Masukan email anda">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Verifikasi</button>
                </div>
              </div>
            </form>
            <p class="mb-0">
              <router-link to="/">Kembali ke halaman login</router-link>
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>