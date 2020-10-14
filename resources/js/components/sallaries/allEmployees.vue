<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'all-sallaries' }" class="btn btn-primary">Lihat Detail Pembayaran Gaji</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Gaji</a></li>
              <li class="breadcrumb-item active">Pembayaran Gaji</li>
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
              <h3 class="card-title">Pembayaran Gaji Karyawan</h3>
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
                    <th>KTP</th>
                    <th>Phone</th>
                    <th>Bergabung</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="employee in searchData" :key="employee.id">
                    <td>{{ employee.id }}</td>
                    <td>{{ employee.name }}</td>
                    <td><img :src="'/'+employee.photo" alt="" class="custom"></td>
                    <td>{{ employee.ktp }}</td>
                    <td>{{ employee.phone }}</td>
                    <td>{{ employee.joindate }}</td>
                    <td>
                      <router-link :to="{name: 'pay-sallaries', params:{id:employee.id}}" class="btn btn-success">Pay Sallary</router-link>
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
      employees: [],
      searchTxt: ''
    }
  },
  computed: {
    searchData(){
      return this.employees.filter(employee => {
        return employee.name.match(this.searchTxt)
      })
    }
  },
  methods:{
    getEmployee(){
      axios.get('/api/employees')
        .then(res => {
          this.employees = res.data
          console.log(this.employees)
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    deleteEmployee(id){
      Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/employees/'+id)
            .then(res => {
              this.employees = this.employees.filter(employee => {
                return employee.id != id
              })
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            })
            .catch(err => {
              this.$router.push({name: 'show-employees'})
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