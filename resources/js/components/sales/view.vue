<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'today-sales' }" class="btn btn-primary">Back</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
              <li class="breadcrumb-item active">Detail Penjualan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Detail Penjualan</h3>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <li class="list-group-item"><b>Nama Pelanggan : </b>{{ sales.customer.name }}</li>
                <li class="list-group-item"><b>Nomor Telepon : </b>{{ sales.customer.phone }}</li>
                <li class="list-group-item"><b>Alamat : </b>{{ sales.customer.address }}</li>
                <li class="list-group-item"><b>Tanggal Pembelian : </b>{{ sales.orderDate }}</li>
                <li class="list-group-item"><b>Metode Pembayaran : </b>{{ sales.payMethod }}</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Detail Penjualan</h3>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <li class="list-group-item"><b>Sub Total : </b>{{ sales.subTotal }}</li>
                <li class="list-group-item"><b>PPH : </b>{{ sales.vat }}%</li>
                <li class="list-group-item"><b>Grand Total : </b>{{ sales.grandTotal }}</li>
                <li class="list-group-item"><b>Pembayaran : </b>{{ sales.amount }}</li>
              </ul>
            </div>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">List Produk</h3>
              </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Nama Produk</th>
                      <th>Barcode</th>
                      <th>Image</th>
                      <th>Qty</th>
                      <th>Harga Barang</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="detail in details.items" :key="detail.id">
                      <td>{{ detail.name }}</td>
                      <td>{{ detail.barcode }}</td>
                      <td><img :src="'/'+detail.image" alt="" style="width: 40px; height: 40px"></td>
                      <td>{{ detail.pivot.qty }}</td>
                      <td>Rp. {{ detail.pivot.price }}</td>
                      <td>Rp. {{ detail.pivot.subTotal }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
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
    this.getDataSales()
    this.getDataSalesDetail()
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data() {
    return {
      id: this.$route.params.id,
      sales: [],
      details: [],
    }
  },
  methods: {
    getDataSales(){
      axios.get('/api/sales/'+this.id)
        .then(res => {
          this.sales = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    getDataSalesDetail(){
      axios.get('/api/sales/detail/'+this.id)
        .then(res => {
          this.details = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    }
  }
}
</script>

<style>

</style>