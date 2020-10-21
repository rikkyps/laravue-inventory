<template>
  <div>
    <section class="content">
      <div class="container-fluid">      
        <div class="row">
          <div class="col-md-5">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Pembelian</h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link btn btn-success" href="#" data-toggle="tab"><font color="#fffff">Input Pelanggan</font></a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nama Produk</th>
                      <th>Stok</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="cart in carts" :key="cart.id">
                      <td>{{ cart.name }}</td>
                      <td>{{ cart.item.qty }}</td>
                      <td>{{ cart.price }}</td>
                      <td>
                        <button class="btn btn-success" v-if="cart.qty >= cart.item.qty" disabled>+</button>
                        <button class="btn btn-success" @click.prevent="addQty(cart.id)" v-else>+</button>
                        <input type="text" style="width: 25px" :value="cart.qty" readonly>
                        <button class="btn btn-danger" @click.prevent="delQty(cart.id)">-</button>
                      </td>
                      <td>{{ cart.subTotal }}</td>
                      <td><button class="btn btn-danger" @click="deleteItem(cart.id)">x</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">Qty <strong>{{ sumQty }}</strong></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total: <strong>Rp. {{ subTotal }}</strong></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">PPN <strong>{{ vats.vat }} %</strong></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Grand Total <strong>Rp. {{ subTotal + subTotal*vats.vat / 100 }}</strong></li>
                </ul>
                <br>
                <form @submit.prevent="addOrder">
                  <div class="form-group">
                    <label for="" class="control-label">Nama Pelanggan</label>
                    <select class="form-control" v-model="customer_id">
                      <option value="">-Pilih-</option>
                      <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{ customer.name }}</option>
                    </select>
                    <small class="text-danger" v-if="errors.customer_id">{{ errors.customer_id[0] }}</small>
                  </div>
                  <div class="form-group">
                    <label for="" class="control-label">Nominal Pembayaran</label>
                    <input type="number" class="form-control" v-model="amount">
                    <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                  </div>
                  <div class="form-group">
                    <label for="" class="control-label">Jatuh Tempo</label>
                    <input type="text" class="form-control" v-model="due">
                    <small class="text-danger" v-if="errors.due">{{ errors.due[0] }}</small>
                  </div>
                  <div class="form-group">
                    <label for="" class="control-label">Jenis Pembayaran</label>
                    <select v-model="payMethod" class="form-control">
                      <option value="">-Pilih-</option>
                      <option value="cash">Cash</option>
                    </select>
                    <small class="text-danger" v-if="errors.payMethod">{{ errors.payMethod[0] }}</small>
                  </div>
                  <button type="submit" class="btn btn-primary">Bayar</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  <h3 class="card-title">List Produk</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Semua Produk</a>
                    </li>
                    <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="getItemByCategory(category.id)">{{ category.name }}</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">

                    <!-- Tab semua produk -->
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <input v-model="searchTxt" type="text" class="form-control" placeholder="Cari produk!">
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="item in searchData" :key="item.id">
                            <button class="btn btn-sm" @click.prevent="addToCart(item.id)">
                              <div class="card" style="width: 8.5rem;">
                                <img :src="item.image" class="card-img-top" id="">
                                <div class="card-body">
                                  <h5 class="card-title">{{ item.name }}</h5><br>
                                  <span class="badge badge-success" v-if="item.qty>= 1">Available {{ item.qty }}</span>
                                  <span class="badge badge-success" v-else>Stock Out</span>
                                </div>
                              </div>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End tab semua produk -->

                    <!-- Tab produk berdasarkan kategori -->
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <input v-model="searchTxtByCategory" type="text" class="form-control" placeholder="Cari produk!">
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="itemByCategory in searchData2" :key="itemByCategory.id">
                            <button class="btn btn-sm" @click.prevent="addToCart(itemByCategory.id)">
                              <div class="card" style="width: 8.5rem;">
                                <img :src="itemByCategory.image" class="card-img-top" id="">
                                <div class="card-body">
                                  <h5 class="card-title">{{ itemByCategory.name }}</h5><br>
                                  <span class="badge badge-success" v-if="itemByCategory.qty>= 1">Available {{ itemByCategory.qty }}</span>
                                  <span class="badge badge-success" v-else>Stock Out</span>
                                </div>
                              </div>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End tab produk berdasarkan kategori -->

                  </div>
                </div>
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
  mounted(){
    this.$Progress.finish()
  },
  created(){
    this.getVat()
    this.getCart()
    this.getCategory()
    this.getItems()
    this.getCustomer()
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data(){
    return{
      items: [],
      categories: [],
      itemByCategories: [],
      searchTxt: '',
      searchTxtByCategory: '',
      customers: [],
      carts: [],
      vats: [],

      amount: '',
      due: '',
      customer_id: '',
      payMethod: '',

      errors: []
    }
  },
  computed: {
    searchData(){
      return this.items.filter(item => {
        return item.name.match(this.searchTxt)
      })
    },
    searchData2(){
      return this.itemByCategories.filter(itemByCategory => {
        return itemByCategory.name.match(this.searchTxtByCategory)
      })
    },
    sumQty(){
      let sum = 0
      for (let i = 0; i < this.carts.length; i++){
        sum += (parseInt(this.carts[i].qty))
      }
      return sum;
    },
    subTotal(){
      let subTotal = 0
      for(let i = 0; i < this.carts.length; i++){
        subTotal += (parseInt(this.carts[i].qty) * parseInt(this.carts[i].price))
      }
      return subTotal
    }
  },
  methods:{
    getItems(){
      axios.get('/api/items')
        .then(res => {
          this.items = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    getCategory(){
      axios.get('/api/pos/categories')
        .then(res => {
          this.categories = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    getItemByCategory(id){
      axios.get('/api/pos/categories/'+id)
        .then(res => {
          this.itemByCategories = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    getCustomer(){
      axios.get('/api/customers')
        .then(res => {
          this.customers = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    addToCart(id){
      axios.get('/api/addtocart/'+id)
        .then(res => {
          Notification.success(res.data.msg)
          this.getCart()
        })
        .catch(err => {
          console.log(err.response.data)
          Notification.error(err.response.data.msg)
        })
    },
    getCart(){
      axios.get('/api/cart')
        .then(res => {
          this.carts = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    deleteItem(id){
      axios.delete('/api/cart/'+id)
        .then(res => {
          Notification.success(res.data.msg)
          this.getCart()
        })
        .catch(err => {
          Notification.error('Terjadi kesalahan pada sistem')
          console.log(err.response.data)
        })
    },
    addQty(id){
      axios.get('/api/cart/addqty/'+id)
        .then(res => {
          this.getCart()
        })
    },
    delQty(id){
      axios.get('/api/cart/delqty/'+id)
        .then(res => {
          this.getCart()
        })
    },
    getVat(){
      axios.get('/api/cart/vats')
        .then(res => {
          this.vats = res.data
        })
    },
    addOrder(){
      let grandTotal = this.subTotal + this.subTotal* this.vats.vat / 100
      let data = { grandTotal : grandTotal, amount: this.amount, due: this.due, payMethod: this.payMethod,
                    customer_id: this.customer_id, vat: this.vats.vat, qty: this.sumQty, subTotal: this.subTotal
                  }
      if(grandTotal <= 0){
        Swal.fire({
          title: 'Pilih produk terlebih dahulu',
          icon: 'warning',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Oke'
        })
      } else {
        axios.post('/api/pos/addsales', data)
          .then(res => {
            Notification.success(res.data.msg)
            this.getCart()
        })
          .catch(err => {
          this.errors = err.response.data.errors
          Notification.error('Terjadi kesalahan input!')
        })
      }
    }
  }
}
</script>

<style scoped>
.custom{
  height: 40px;
  width: 40px;
}

#photo{
  height: 100px;
  width: 100px;
}
</style>