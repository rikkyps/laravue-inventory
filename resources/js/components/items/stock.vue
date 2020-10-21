<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Stok</a></li>
              <li class="breadcrumb-item active">Semua Stok Produk</li>
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
              <h3 class="card-title">List Stok Produk</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
              <input v-model="searchTxt" type="text" class="form-control" placeholder="Seach By Name Here!" style="width: 200px;">
              </div>
              <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama Produk</th>
                    <th>Barcode</th>
                    <th>Photo</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Status</th>
                    <th>Qty</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in searchData" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.barcode }}</td>
                    <td><img :src="item.image" alt="" class="custom"></td>
                    <td>{{ item.category.name }}</td>
                    <td>{{ item.buyPrice }}</td>
                    <td v-if="item.qty >= 1"><span class="badge badge-success">Available</span></td>
                    <td v-else><span class="badge badge-danger">Stok Out</span></td>

                    <td>{{ item.qty }}</td>
                    <td>
                      <router-link :to="{name: 'add-stocks', params:{id:item.id}}" class="btn btn-success">Add Stock</router-link>
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
    this.getItems()
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data(){
    return{
      items: [],
      searchTxt: ''
    }
  },
  computed: {
    searchData(){
      return this.items.filter(item => {
        return item.name.match(this.searchTxt)
      })
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
  }
}
</script>

<style>
.custom{
  height: 40px;
  width: 40px;
}
</style>