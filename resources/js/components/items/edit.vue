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
              <li class="breadcrumb-item active">Edit Produk</li>
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
            <h3 class="card-title">Edit Produk</h3>
          </div>
          
          <form role="form" @submit.prevent="updateProduct()" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-5">
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <img id="showimage" :src="form.new_image" alt="" style="height: 100px; width: 100px;">
                  </div>
                </div>
              </div>
              <div class="form row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Nama Produk</label>
                    <input type="text" class="form-control" v-model="form.name">
                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Kategori Produk</label>
                    <select v-model="form.category_id" class="form-control">
                      <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
                    </select>
                    <small class="text-danger" v-if="errors.category_id">{{ errors.nacategory_id[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Nama Supplier</label>
                    <select v-model="form.supplier_id" class="form-control">
                      <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id">{{ supplier.shopname }}</option>
                    </select>
                    <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Root Produk</label>
                    <input type="text" v-model="form.root" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Harga Beli</label>
                    <input type="number" v-model="form.buyPrice" class="form-control">
                    <small class="text-danger" v-if="errors.buyPrice">{{ errors.buyPrice[0] }}</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Harga Jual</label>
                    <input type="number" v-model="form.sellPrice" class="form-control">
                    <small class="text-danger" v-if="errors.sellPrice">{{ errors.sellPrice[0] }}</small>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Tanggal Pembelian</label><br>
                    <date-picker v-model="form.buyDate" type="date" placeholder="Tanggal Beli" input-class="form-control" format="YYYY-MM-DD" value-type="format"></date-picker><br>
                    <small class="text-danger" v-if="errors.buyDate">{{ errors.buyDate[0] }}</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Stok Barang</label>
                    <input type="number" class="form-control" v-model="form.qty">
                    <small class="text-danger" v-if="errors.qty">{{ errors.qty[0] }}</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control-label">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" @change="onFileSelected">
                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                      </div>
                    </div>
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
    this.getData()
    this.$Progress.finish()
  },
  created() {
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
    axios.get('/api/items/'+this.id)
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
      categories: {}, 
      suppliers: {},
      form: {
        name: '',
        category_id: '',
        supplier_id: '',
        root: '',
        buyPrice: '',
        sellPrice: '',
        buyDate: '',
        image: '',
        new_image: '',
        qty: ''
      }
    }
  },
  methods: {
    updateProduct() {
      axios.put('/api/items/'+this.id, this.form)
        .then(res => {
          this.$router.push({name: 'show-items'})
          Notification.success(res.data.msg)
        })
        .catch(err => {
          this.errors = err.response.data.errors
        })
    },
    onFileSelected(event){
      let file = event.target.files[0]
      if(file.size > 1048770) {
        Notification.imageValidation()
      } else {
        let reader = new FileReader()
        reader.onload = event => {
          this.form.new_image = event.target.result
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