<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pengeluaran</a></li>
              <li class="breadcrumb-item active">Semua Pengeluaran</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">      
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">List Pengeluaran</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
              <input v-model="searchTxt" type="text" class="form-control" placeholder="Seach By Name Here!" style="width: 200px;">
              </div>
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
                  <tr v-for="sale in searchData" :key="sale.id">
                    <td>{{ sale.orderDate }}</td>
                    <td>{{ sale.customer.name }}</td>
                    <td>Rp. {{ sale.grandTotal }}</td>
                    <td v-if="sale.payMethod == 'cash'"><span class="badge badge-success">{{ sale.payMethod }}</span></td>
                    <td v-else><span class="badge badge-danger">{{ sale.payMethod }}</span></td>
                    <td>
                      <router-link :to="{name: 'view-sales', params: {id: sale.id}}" class="btn btn-success">View</router-link>
                    </td>
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
    this.getSale()
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data(){
    return{
      sales: [],
      searchTxt: ''
    }
  },
  computed: {
    searchData(){
      return this.sales.filter(sale => {
        return sale.customer.name.match(this.searchTxt)
      })
    }
  },
  methods:{
    getSale(){
      axios.get('/api/sales')
        .then(res => {
          this.sales = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
  }
}
</script>

<style>
.custom{
  height: 40px;
  width: 40px;
}
</style>