<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'store-categories' }" class="btn btn-primary">Tambah Kategori</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Kategori</a></li>
              <li class="breadcrumb-item active">Semua Kategori</li>
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
              <h3 class="card-title">List Kategori</h3>
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
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="category in searchData" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td v-if="category.status == 0"><span class="badge bg-danger">Non Aktif</span></td>
                    <td v-if="category.status == 1"><span class="badge bg-success">Aktif</span></td>
                    <td>
                      <router-link :to="{name: 'edit-categories', params:{id:category.id}}" class="btn btn-success">Edit</router-link>
                      <a @click="deleteCategory(category.id)" class="btn btn-danger"><font color="#fffff">Delete</font></a>
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
    this.getCategory()
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data(){
    return{
      categories: [],
      searchTxt: ''
    }
  },
  computed: {
    searchData(){
      return this.categories.filter(category => {
        return category.name.match(this.searchTxt)
      })
    }
  },
  methods:{
    getCategory(){
      axios.get('/api/categories')
        .then(res => {
          this.categories = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    deleteCategory(id){
      Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/categories/'+id)
            .then(res => {
              this.categories = this.categories.filter(category => {
                return category.id != id
              })
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              console.log(res.body)
            })
            .catch(err => {
              this.$router.push({name: 'show-categories'})
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