<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'show-stocks' }" class="btn btn-primary">Back</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Stok</a></li>
              <li class="breadcrumb-item active">Add Stok</li>
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
            <h3 class="card-title">Form Add Stok</h3>
          </div>
          
          <form role="form" @submit.prevent="addStock()">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-5">
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <img id="showimage" :src="'/'+form.image" alt="" style="height: 100px; width: 100px;">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" v-model="form.name" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" v-model="form.barcode" class="form-control" readonly>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Tambah Kuantitas</label>
                <input type="text" v-model="form.qty" class="form-control">
                <small class="text-danger" v-if="errors.qty">{{ errors.qty[0] }}</small>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </form>
        </div>
        </div>
  
      </div>
    </section>
  </div>
</template>

<script>

export default {
  mounted() {
    this.$Progress.finish()
  },
  created() {
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
    this.getData()
  },
  data() {
    return {
      id: this.$route.params.id,
      errors: {},
      form: {
        name: '',
        barcode: '',
        image: '',
        qty: ''
      }
    }
  },
  methods: {
    getData(){
      axios.get('/api/stocks/'+this.id)
        .then(res => {
          this.form = res.data
        })
        .catch(err => {
          console.log(err.response.data)
        })
    },
    addStock(){
      axios.put('/api/stocks/'+this.id, this.form)
        .then(res => {
          this.$router.push({ name: 'show-stocks' })
          Notification.success(res.data.msg)
        })
        .catch(err => {
          Notification.error('Terjadi kesalahan input data')
          this.errors = err.response.data.errors
        })
    }
  }
}
</script>

<style>

</style>