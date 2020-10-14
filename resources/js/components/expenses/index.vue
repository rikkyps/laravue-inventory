<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'store-expenses' }" class="btn btn-primary">Tambah Pengeluaran</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pengeluaran</a></li>
              <li class="breadcrumb-item active">Semua Pengeluaran</li>
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
              <h3 class="card-title">List Pengeluaran</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
              <input v-model="searchTxt" type="text" class="form-control" placeholder="Seach By Name Here!" style="width: 200px;">
              </div>
              <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Tanggal</th>
                    <th>Detail Pengeluaran</th>
                    <th>Nilai Pengeluaran</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="expense in searchData" :key="expense.id">
                    <td>{{ expense.id }}</td>
                    <td>{{ expense.date }}</td>
                    <td>{{ expense.detail }}</td>
                    <td>{{ expense.amount }}</td>
                    <td>
                      <router-link :to="{name: 'edit-expenses', params:{id:expense.id}}" class="btn btn-success">Edit</router-link>
                      <a @click="deleteExpense(expense.id)" class="btn btn-danger"><font color="#fffff">Delete</font></a>
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
    this.getExpense()
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data(){
    return{
      expenses: [],
      searchTxt: ''
    }
  },
  computed: {
    searchData(){
      return this.expenses.filter(expense => {
        return expense.detail.match(this.searchTxt)
      })
    }
  },
  methods:{
    getExpense(){
      axios.get('/api/expenses')
        .then(res => {
          this.expenses = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    deleteExpense(id){
      Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/expenses/'+id)
            .then(res => {
              this.expenses = this.expenses.filter(expense => {
                return expense.id != id
              })
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              console.log(res.data)
            })
            .catch(err => {
              this.$router.push({name: 'show-expense'})
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