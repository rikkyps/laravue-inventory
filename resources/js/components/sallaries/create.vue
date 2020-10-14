<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'given-sallaries' }" class="btn btn-primary">Semua Data Pemyaran Gaji</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Gaji</a></li>
              <li class="breadcrumb-item active">Bayar Gaji</li>
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
            <h3 class="card-title">Pembayaran Gaji</h3>
          </div>
          
          <form role="form" @submit.prevent="paySallary()">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.name" type="text" class="form-control" placeholder="Nama Lengkap">
                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.ktp" type="text" class="form-control" placeholder="No. KTP">
                    <small class="text-danger" v-if="errors.ktp">{{ errors.ktp[0] }}</small>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <month-picker-input v-model="form.sallaryMonth" :show-year="false" lang="id"></month-picker-input>
                    <small class="text-danger" v-if="errors.sallaryMonth">{{ errors.sallaryMonth[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="number" v-model="form.sallary" placeholder="Besaran Gaji" class="form-control">
                    <small class="text-danger" v-if="errors.sallary">{{ errors.sallary[0] }}</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Bayar</button>
            </div>
          </form>
        </div>
        </div>
  
      </div>
    </section>
  </div>
</template>

<script>

import { MonthPickerInput } from 'vue-month-picker'

export default {
  components: {
    MonthPickerInput
  },
  mounted() {
    this.$Progress.finish()
  },
  created() {
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
    axios.get('/api/employees/'+this.id)
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
        sallary: '',
        amount: '',
        sallaryMonth: '',
      }
    }
  },
  methods: {
    paySallary() {
      axios.post('/api/sallaries/paid/'+this.id, this.form)
        .then(res => {
          this.$router.push({name: 'given-sallaries'})
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