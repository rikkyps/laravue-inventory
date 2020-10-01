<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'store-suppliers' }" class="btn btn-primary">Tambah Supplier</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Supplier</a></li>
              <li class="breadcrumb-item active">Semua Supplier</li>
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
              <h3 class="card-title">List Supplier</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
              <input v-model="searchTxt" type="text" class="form-control" placeholder="Seach By Name Here!" style="width: 200px;">
              </div>
              <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Photo</th>
                    <th>Email</th>
                    <th>Nama Toko</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="supplier in searchData" :key="supplier.id">
                    <td>{{ supplier.id }}</td>
                    <td>{{ supplier.name }}</td>
                    <td><img :src="supplier.photo" alt="" class="custom"></td>
                    <td>{{ supplier.email }}</td>
                    <td>{{ supplier.shopname }}</td>
                    <td>{{ supplier.phone }}</td>
                    <td>
                      <router-link :to="{name: 'edit-suppliers', params:{id:supplier.id}}" class="btn btn-success">Edit</router-link>
                      <a @click="deleteSupplier(supplier.id)" class="btn btn-danger"><font color="#fffff">Delete</font></a>
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
    this.getSupplier()
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data(){
    return{
      suppliers: [],
      searchTxt: ''
    }
  },
  computed: {
    searchData(){
      return this.suppliers.filter(supplier => {
        return supplier.name.match(this.searchTxt)
      })
    }
  },
  methods:{
    getSupplier(){
      axios.get('/api/suppliers')
        .then(res => {
          this.suppliers = res.data
          console.log(this.suppliers)
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    deleteSupplier(id){
      Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/suppliers/'+id)
            .then(res => {
              this.suppliers = this.suppliers.filter(supplier => {
                return supplier.id != id
              })
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              console.log(res.body)
            })
            .catch(err => {
              this.$router.push({name: 'show-suppliers'})
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