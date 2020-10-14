<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'all-sallaries' }" class="btn btn-primary">Back</router-link>
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
                    <th>Month</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="sallary in searchData" :key="sallary.id">
                    <td>{{ sallary.id }}</td>
                    <td>{{ sallary.employee.name }}</td>
                    <td>{{ sallary.sallaryMonth }}</td>
                    <td>{{ sallary.amount }}</td>
                    <td>{{ sallary.sallaryDate }}</td>
                    <td>
                      <router-link :to="{name: 'edit-sallaries', params:{id:sallary.id}}" class="btn btn-success">Edit</router-link>
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
    this.viewSallary()
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data(){
    return{
      sallaries: [],
      searchTxt: ''
    }
  },
  computed: {
    searchData(){
      return this.sallaries.filter(sallary => {
        return sallary.employee.name.match(this.searchTxt)
      })
    }
  },
  methods:{
    viewSallary(){
      let id = this.$route.params.id
      axios.get('/api/sallaries/'+id)
        .then(res => {
          this.sallaries = res.data
          console.log(res.data)
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