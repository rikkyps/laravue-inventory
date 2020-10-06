<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'store-items' }" class="btn btn-primary">Tambah Produk</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Produk</a></li>
              <li class="breadcrumb-item active">Semua Produk</li>
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
              <h3 class="card-title">List Produk</h3>
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
                    <th>Harga Jual</th>
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
                    <td>{{ item.sellPrice }}</td>
                    <td>
                      <router-link :to="{name: 'edit-items', params:{id:item.id}}" class="btn btn-success">Edit</router-link>
                      <a @click="deleteItem(item.id)" class="btn btn-danger"><font color="#fffff">Delete</font></a>
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
    deleteItem(id){
      Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/items/'+id)
            .then(res => {
              this.items = this.items.filter(item => {
                return item.id != id
              })
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            })
            .catch(err => {
              this.$router.push({name: 'show-items'})
            })
        }
      })
    }
  }
}
</script>

<style>
.custom{
  height: 40px;
  width: 40px;
}
</style>