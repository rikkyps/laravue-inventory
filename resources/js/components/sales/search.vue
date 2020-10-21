<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'today-sales' }" class="btn btn-primary">Data Penjualan Hari Ini</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Penjualan</a></li>
              <li class="breadcrumb-item active">Search Penjualan</li>
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
            <h3 class="card-title">Search Penjualan</h3>
          </div>
          
          <form @submit.prevent="searchSale">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="" class="control-label">Cari Berdasarkan Tanggal</label>
                    <input type="date" class="form-control" v-model="date" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Cari</button>
            </div>
          </form>
        </div>
        </div>
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-body">
               <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Grand Total</th>
                    <th>Jenis Pembayaran</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="sale in sales" :key="sale.id">
                      <td>{{ sale.orderDate }}</td>
                      <td>{{ sale.customer.name }}</td>
                      <td>{{ sale.grandTotal }}</td>
                      <td v-if="sale.payMethod == 'cash'"><span class="badge badge-success">{{ sale.payMethod }}</span></td>
                      <td v-else><span class="badge badge-danger">{{ sale.payMethod }}</span></td>
                      <td><router-link :to="{name: 'view-sales', params: {id: sale.id}}" class="btn btn-success">View</router-link></td>
                  </tr>
                  <tr v-if="!sales.length">
                    <td colspan="5" align="center">Data kosong</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
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
      date: '',
      sales: []
    }
  },
  methods: {
    searchSale(){
      axios.post('/api/sales/search', {date: this.date})
        .then(res => {
          this.sales = res.data
        })
        .catch(err => {
          Swal.fire({
            title: err.response.data.msg,
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Cari lagi'
          })
          this.sales = ''
        })
    }
  }
}
</script>

<style>

</style>