<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'show-items' }" class="btn btn-primary">Semua Produk</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Produk</a></li>
              <li class="breadcrumb-item active">Add Produk</li>
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
            <h3 class="card-title">Create Produk</h3>
          </div>
          
          <form role="form" @submit.prevent="addProduct()" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-5">
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <img id="showimage" :src="form.image" alt="" style="height: 100px; width: 100px;">
                  </div>
                </div>
              </div>
              <div class="form row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Nama Produk</label>
                    <input type="text" class="form-control" v-model="form.name"
                    :class="{ 'is-invalid' : form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Kategori Produk</label>
                    <select v-model="form.category_id" class="form-control" :class="{ 'is-invalid' : form.errors.has('category_id') }">
                      <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
                    </select>
                    <has-error :form="form" field="category_id"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Nama Supplier</label>
                    <select v-model="form.supplier_id" class="form-control" :class="{ 'is-invalid' : form.errors.has('supplier_id') }">
                      <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id">{{ supplier.shopname }}</option>
                    </select>
                    <has-error :form="form" field="category_id"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Root Produk</label>
                    <input type="text" v-model="form.root" class="form-control"
                    :class="{ 'is-invalid' : form.errors.has('root') }">
                    <has-error :form="form" field="root"></has-error>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Harga Beli</label>
                    <input type="number" v-model="form.buyPrice" class="form-control"
                    :class="{ 'is-invalid' : form.errors.has('buyPrice') }">
                    <has-error :form="form" field="buyPrice"></has-error>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Harga Jual</label>
                    <input type="number" v-model="form.sellPrice" class="form-control"
                    :class="{ 'is-invalid' : form.errors.has('sellPrice') }">
                    <has-error :form="form" field="sellPrice"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Tanggal Pembelian</label><br>
                    <date-picker v-model="form.buyDate" type="date" placeholder="Tanggal Beli" input-class="form-control" format="YYYY-MM-DD" value-type="format"
                    :class="{ 'is-invalid' : form.errors.has('buyDate') }"></date-picker>
                    <has-error :form="form" field="buyDate"></has-error>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Stok Barang</label>
                    <input type="number" class="form-control" v-model="form.qty"
                    :class="{ 'is-invalid' : form.errors.has('qty') }">
                    <has-error :form="form" field="qty"></has-error>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" @change="onFileSelected"
                        :class="{ 'is-invalid': form.errors.has('image') }">
                        <has-error :form="form" field="image"></has-error>
                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                      </div>
                    </div>
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
    this.getData();
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
        name: null,
        category_id: null,
        supplier_id: null,
        root: null,
        buyPrice: null,
        sellPrice: null,
        buyDate: null,
        image: null,
        qty: null
      }),
      categories: {},
      suppliers: {}
    }
  },
  methods: {
    addProduct(){
      this.form.post('/api/items')
        .then(res => {
          Notification.success(res.data.msg)
          this.$router.push({name: 'show-items'})
        })
        .catch(err => {
          Notification.error('Ada kelasahan input!')
          console.log(err)
        })
    },
    onFileSelected(event){
      let file = event.target.files[0]
      if(file.size > 1048770) {
        Notification.imageValidation()
      } else {
        let reader = new FileReader()
        reader.onload = event => {
          this.form.image = event.target.result
        }
        reader.readAsDataURL(file)
      }
    },
    getData(){
      axios.get('/api/categories')
        .then(res => {
          this.categories = res.data
        })
      
      axios.get('/api/suppliers')
        .then(res => {
          this.suppliers = res.data
        })
    }
  }

}
</script>

<style>

</style>