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
              <li class="breadcrumb-item active">Add Kategori</li>
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
            <h3 class="card-title">Create Kategori</h3>
          </div>
          
          <form role="form" @submit.prevent="addCategory()">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.name" type="text" class="form-control" placeholder="Nama Kategori"
                    :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control" v-model="form.status"
                    :class="{ 'is-invalid' : form.errors.has('status') }">
                      <option value="" selected>-Pilih Status-</option>
                      <option value="0">Non Aktif</option>
                      <option value="1">Aktif</option>
                    </select>
                    <has-error :form="form" field="status"></has-error>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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
  mounted(){
    this.$Progress.finish()
  },
  created(){
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
  },
  data(){
    return{
      form: new Form({
        name: null,
        status: null
      })
    }
  },
  methods: {
    addCategory(){
      this.form.post('/api/categories')
        .then(res => {
          Notification.success(res.data.msg)
          this.$router.push({name: 'show-categories'})
        })
        .catch(err => {
          Notification.error('Terjadi kesalahan, proses gagal!')
        })
    }
  }
}
</script>

<style>

</style>