<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'show-categories' }" class="btn btn-primary">Semua Kategori</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Kategori</a></li>
              <li class="breadcrumb-item active">Edit Kategori</li>
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
            <h3 class="card-title">Edit Kategori</h3>
          </div>
          
          <form role="form" @submit.prevent="updateCategory()">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.name" type="text" class="form-control" placeholder="Nama Kategori">
                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control" v-model="form.status">
                      <option value="" selected>-Pilih Status-</option>
                      <option value="0">Non Aktif</option>
                      <option value="1">Aktif</option>
                    </select>
                    <small class="text-danger" v-if="errors.status">{{ errors.status[0] }}</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update</button>
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
    axios.get('/api/categories/'+this.id)
      .then(res => {
        this.form = res.data
      })
      .catch(err => {
        console.log(err.response.data)
      })
  },
  data() {
    return {
      id: this.$route.params.id,
      errors: {},
      form: {
        name: '',
        status: '',
      }
    }
  },
  methods: {
    updateCategory() {
      axios.put('/api/categories/'+this.id, this.form)
        .then(res => {
          this.$router.push({name: 'show-categories'})
          Notification.success(res.data.msg)
        })
        .catch(err => {
          this.errors = err.response.data.errors
          Notification.error('Terjadi kesalahan, proses gagal!')
        })
    },
  }
}
</script>

<style>

</style>