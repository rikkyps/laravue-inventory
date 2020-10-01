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
            <p class="login-box-msg">Mohon login terlebih dahulu!</p>

            <form @submit.prevent="login()">
              <div class="input-group mb-3">
                <input type="email" class="form-control" v-model="form.email" placeholder="Email"
                :class="{ 'is-invalid': form.errors.has('email') }">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
                <has-error :form="form" field="email"></has-error>
              </div>

              <div class="input-group mb-3">
                <input type="password" class="form-control" v-model="form.password" placeholder="Password"
                :class="{ 'is-invalid' : form.errors.has('password') }">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                <has-error :form="form" field="password"></has-error>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                      Remember Me
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button :disabled="form.busy" type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <p class="mb-1">
              <router-link to="/forget">Lupa password</router-link>
            </p>
            <p class="mb-0">
              <router-link to="/register">Daftar baru</router-link>
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
export default {
  mounted () {
  //  [App.vue specific] When App.vue is finish loading finish the progress bar
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
        username: '',
        password: '',
      }),
    }
  },
  methods: {
    login() {
      this.$Progress.start()
      this.form.post('api/auth/login')
      .then(res => {
        User.responseAfterLogin(res)
        Toast.fire({
          icon: 'success',
          title: 'Login berhasil!'
        })
        this.$router.push({ name: 'home' })
        this.$Progress.finish()
      })
      .catch(err => {
        Toast.fire({
          icon: 'warning',
          title: 'Email atau Password salah!'
        })
        this.$Progress.fail()
      })
    }
  }
}
</script>

<style type="text/css">

</style>