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
              <li class="breadcrumb-item active">Add Pengeluaran</li>
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
            <h3 class="card-title">Create Pengeluaran</h3>
          </div>
          
          <form role="form" @submit.prevent="addExpense()">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea v-model="form.detail" type="text" class="form-control" placeholder="Detail Pengeluaran"
                    :class="{ 'is-invalid': form.errors.has('detail') }"></textarea>
                    <has-error :form="form" field="detail"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="number" v-model="form.amount" class="form-control" placeholder="Nilai Pengeluaran" 
                    :class="{ 'is-invalid' : form.errors.has('amount') }">
                    <has-error :form="form" field="amount"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <date-picker v-model="form.date" type="date" placeholder="Tanggal Pengeluaran" input-class="form-control" format="YYYY-MM-DD" value-type="format" 
                    :class="{ 'is-invalid' : form.errors.has('date') }"></date-picker>
                    <has-error :form="form" field="date"></has-error>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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
  mounted(){
    this.$Progress.finish()
  },
  created(){
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data(){
    return{
      form: new Form({
        detail: null,
        amount: null,
        date: null,
      })
    }
  },
  methods: {
    addExpense(){
      this.form.post('/api/expenses')
        .then(res => {
          Notification.success(res.data.msg)
          this.$router.push({name: 'show-expenses'})
        })
        .catch(err => {
          Notification.error('Terjadi kesalahan, proses gagal!')
        })
    }
  }
}
</script>

<style>

</style>