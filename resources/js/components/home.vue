<template>
  <div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  Dashboard
                </div>
              </div>
              <div class="card-body">
                <h1>Welcome {{ name }}</h1>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row (main row) -->
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Rp. {{ data.todaySaleAmount }}</h3>

                <p>Total Pendapatan Hari Ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Rp. {{ data.todayIncome }}</h3>

                <p>Omzet Hari Ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ data.todaySales }} Penjualan</h3>

                <p>Penjualan Hari Ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Rp. {{ data.todayExpenses }}</h3>

                <p>Total Pengeluaran Hari Ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Data Produk Kosong</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nama Produk</th>
                      <th>Barcode</th>
                      <th>Image</th>
                      <th>Kategori</th>
                      <th>Harga</th>
                      <th>Stok</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="!items.length">
                      <td colspan="7" align="center">Tidak ada produk kosong</td>
                    </tr>
                    <tr v-for="item in items" :key="item.id">
                      <td>{{ item.name }}</td>
                      <td>{{ item.barcode }}</td>
                      <td align="center"><img :src="'/'+item.image" style="width: 50px; height: 50px;"></td>
                      <td>{{ item.category.name }}</td>
                      <td>{{ item.sellPrice }}</td>
                      <td>{{ item.qty }}</td>
                      <td><span class="badge badge-danger">Stock Out</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
  mounted() {
    this.$Progress.finish()
  },
  created() {
    this.getItemStockOut()
    this.getTodaySales()
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
    this.name = User.name()
  },
  data() {
    return {
      name: '',
      items: [],
      data: {
        todaySaleAmount: '',
        todayIncome: '',
        todayExpenses: '',
        todaySales: ''
      }
    }
  },
  methods: {
    getTodaySales(){
      axios.get('/api/todaysales')
        .then(res => {
          this.data = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    getItemStockOut(){
      axios.get('/api/stockout')
        .then(res =>{
          this.items = res.data
        })
        .then(err => {
          console.log(err.response.data)
        })
    }
  }
}
</script>

<style>

</style>