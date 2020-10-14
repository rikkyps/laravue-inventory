<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'show-expenses' }" class="btn btn-primary">Semua Pengeluaran</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pengeluaran</a></li>
              <li class="breadcrumb-item active">Edit Pengeluaran</li>
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
            <h3 class="card-title">Edit Pengeluaran</h3>
          </div>
          
          <form role="form" @submit.prevent="updateExpense()">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea v-model="form.detail" type="text" class="form-control" placeholder="Detail Pengeluaran"></textarea>
                    <small class="text-danger" v-if="errors.detail">{{ errors.detail[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="number" v-model="form.amount" class="form-control" placeholder="Nilai Pengeluaran">
                    <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <date-picker v-model="form.date" type="date" placeholder="Tanggal Pengeluaran" input-class="form-control" format="YYYY-MM-DD" value-type="format"></date-picker><br>
                    <small class="text-danger" v-if="errors.date">{{ errors.date[0] }}</small>
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

import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

export default {
  components: { DatePicker },
  mounted() {
    this.$Progress.finish()
  },
  created() {
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
    axios.get('/api/expenses/'+this.id)
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
        detail: '',
        date: '',
        amount: ''
      }
    }
  },
  methods: {
    updateExpense() {
      axios.put('/api/expenses/'+this.id, this.form)
        .then(res => {
          this.$router.push({name: 'show-expenses'})
          Notification.success(res.data.msg)
        })
        .catch(err => {
          this.errors = err.response.data.errors
          Notification.error('Terjadi kesalahan, proses gagal!')
        })
    },
  }
}
</script>

<style>

</style>