<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'all-sallaries' }" class="btn btn-primary">Back</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Gaji</a></li>
              <li class="breadcrumb-item active">Edit Gaji</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="col-md-12">
          <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Update Gaji</h3>
          </div>
          
          <form role="form" @submit.prevent="updateSallary()">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.name" type="text" class="form-control" placeholder="Nama Lengkap" readonly>
                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.ktp" type="text" class="form-control" placeholder="No. KTP" readonly>
                    <small class="text-danger" v-if="errors.ktp">{{ errors.ktp[0] }}</small>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control" v-model="form.sallaryMonth">
                      <option value="" selected>-Pilih-</option>
                      <option value="Januari">Jan</option>
                      <option value="Februari">Feb</option>
                      <option value="Maret">Mar</option>
                      <option value="April">Apr</option>
                      <option value="Mei">Mei</option>
                      <option value="Juni">Jun</option>
                      <option value="Juli">Jul</option>
                      <option value="Agustus">Ags</option>
                      <option value="Septemger">Sep</option>
                      <option value="Oktober">Okt</option>
                      <option value="November">Nov</option>
                      <option value="Desember">Des</option>
                    </select>
                    <small class="text-danger" v-if="errors.sallaryMonth">{{ errors.sallaryMonth[0] }}</small>
                  </div>
                </div>
                <input type="hidden" v-model="form.employee_id">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="number" v-model="form.amount" placeholder="Besaran Gaji" class="form-control">
                    <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
        </div>
  
      </div>
    </section>
  </div>
</template>

<script>

export default {
  mounted() {
    this.$Progress.finish()
  },
  created() {
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
    axios.get('/api/sallaries/detail/'+this.id)

      .then(res => {
        this.form = res.data
      })
      .catch(err => {
        console.log(err.response.data)
      })

  },
  data() {
    return {
      id: this.$route.params.id,
      errors: {},
      form: {
        name: '',
        ktp: '',
        amount: '',
        sallaryMonth: '',
        sallaryYear: '',
        employee_id: ''
      }
    }
  },
  methods: {
    updateSallary() {
      axios.put('/api/sallaries/detail/edit/'+this.id, this.form)
        .then(res => {
          this.$router.push({name: 'all-sallaries'})
          Notification.success(res.data.msg)
        })
        .catch(err => {
          this.errors = err.response.data.errors
        })
    },
  }
}
</script>

<style>

</style>