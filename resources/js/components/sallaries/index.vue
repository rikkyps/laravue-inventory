<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'given-sallaries' }" class="btn btn-primary">Bayar Gaji</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Gaji</a></li>
              <li class="breadcrumb-item active">Detail Pembayaran Gaji</li>
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
              <h3 class="card-title">List Detail Pembayaran Gaji</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
              <input v-model="searchTxt" type="text" class="form-control" placeholder="Seach By Name Here!" style="width: 200px;">
              </div>
              <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th>Nama Bulan</th>
                    <th>Details</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="sallary in searchData" :key="sallary.id">
                    <td>{{ sallary.sallaryMonth }}</td>
                    <td>
                      <router-link :to="{name: 'view-sallaries', params:{id:sallary.sallaryMonth}}" class="btn btn-success">Detail Sallary</router-link>
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
    this.getSallary()
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
        return sallary.sallaryMonth.match(this.searchTxt)
      })
    }
  },
  methods:{
    getSallary(){
      axios.get('/api/sallaries')
        .then(res => {
          this.sallaries = res.data
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