<template>
  <div>
    <div class="row justify-content-center">
      <div class="register-box">
        <div class="register-logo">
          <a href="javascript:;"><b>PT. PSG</b></a>
        </div>

        <div class="card">
          <div class="card-body register-card-body">
            <p class="login-box-msg">Daftar akun baru</p>

            <form @submit.prevent="register()">

              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Full name"
                v-model="form.name" :class="{ 'is-invalid' : form.errors.has('name') }">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
                <has-error :form="form" field="name"></has-error>
              </div>

              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email"
                v-model="form.email" :class="{ 'is-invalid' : form.errors.has('email') }">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
                <has-error :form="form" field="email"></has-error>
              </div>

              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password"
                v-model="form.password" :class="{ 'is-invalid' : form.errors.has('password') }">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                <has-error :form="form" field="password"></has-error>
              </div>

              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Retype password"
                v-model="form.password_confirmation" :class="{ 'is-invalid' : form.errors.has('password_confirmation') }">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                <has-error :form="form" field="password_confirmation"></has-error>
              </div>

              <div class="row">
                <div class="col-4">
                  <button :disabled="form.busy" type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
            <br>
            <router-link to="/">Sudah punya akun?</router-link>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
    </div>
  </div>
</template>

<script type="text/javascript">
export default {
  mounted() {
    this.$Progress.finish()
  },
  created() {
    this.$Progress.start()
    if(User.loggedIn()){
      this.$router.push({name: 'home'})
    }
  },
  data() {
    return {
      form: new Form({
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      })
    }
  },
  methods: {
    register() {
      this.$Progress.start()
      this.form.post('api/auth/signup')
      .then(res => {
        User.responseAfterLogin(res)
        Toast.fire({
          icon: 'success',
          title: 'User berhasil didaftarkan!'
        })
        this.$router.push({ name: 'home' })
        this.$Progress.finish()
      })
      .catch(err => {
        Toast.fire({
        icon: 'warning',
        title: 'Registrasi gagal! periksa kembali'
      })
      this.$Progress.fail()
      })
    }
  }

}
</script>

<style type="text/css">

</style>