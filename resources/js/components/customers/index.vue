<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'store-customers' }" class="btn btn-primary">Tambah Pelanggan</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pelanggan</a></li>
              <li class="breadcrumb-item active">Semua Pelanggan</li>
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
              <h3 class="card-title">List Pelanggan</h3>
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
                    <th>Telepon</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="customer in searchData" :key="customer.id">
                    <td>{{ customer.id }}</td>
                    <td>{{ customer.name }}</td>
                    <td><img :src="customer.photo" alt="" class="custom"></td>
                    <td>{{ customer.email }}</td>
                    <td>{{ customer.phone }}</td>
                    <td>
                      <router-link :to="{name: 'edit-customers', params:{id:customer.id}}" class="btn btn-success">Edit</router-link>
                      <a @click="deleteCustomer(customer.id)" class="btn btn-danger"><font color="#fffff">Delete</font></a>
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
    this.getEmployee()
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data(){
    return{
      customers: [],
      searchTxt: ''
    }
  },
  computed: {
    searchData(){
      return this.customers.filter(customer => {
        return customer.name.match(this.searchTxt)
      })
    }
  },
  methods:{
    getEmployee(){
      axios.get('/api/customers')
        .then(res => {
          this.customers = res.data
          console.log(this.customers)
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    deleteCustomer(id){
      Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/customers/'+id)
            .then(res => {
              this.customers = this.customers.filter(customer => {
                return customer.id != id
              })
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            })
            .catch(err => {
              this.$router.push({name: 'show-customers'})
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