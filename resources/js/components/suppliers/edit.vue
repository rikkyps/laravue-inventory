<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'show-suppliers' }" class="btn btn-primary">Semua Supplier</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Supplier</a></li>
              <li class="breadcrumb-item active">Edit Supplier</li>
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
            <h3 class="card-title">Edit Supplier</h3>
          </div>
          
          <form role="form" @submit.prevent="updateSupplier()" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.name" type="text" class="form-control" placeholder="Nama Lengkap">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" v-model="form.shopname" placeholder="Nama Toko" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.email" type="email" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.phone" type="text" class="form-control" placeholder="Nomor Telepon">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                 <div class="form-group">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" @change="onFileSelected">
                      <label class="custom-file-label" for="exampleInputFile">Photo</label>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <img :src="form.newphoto" alt="" style="width: 40px; height: 40px;">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <textarea v-model="form.address" class="form-control" cols="15" rows="5" placeholder="Alamat"></textarea>
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
  mounted() {
    this.$Progress.finish()
  },
  created() {
    this.$Progress.start()
    if(!User.loggedIn()){
      this.$router.push({name: 'login'})
    }
    axios.get('/api/suppliers/'+this.id)
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
        shopname: '',
        email: '',
        phone: '',
        photo: '',
        newphoto: '',
        address: ''
      }
    }
  },
  methods: {
    updateSupplier() {
      axios.put('/api/suppliers/'+this.id, this.form)
        .then(res => {
          this.$router.push({name: 'show-suppliers'})
          Notification.success('Data berhasil diubah!')
        })
        .catch(err => {
          this.errors = err.response.data.errors
        })
    },
    onFileSelected(event){
      let file = event.target.files[0]
      if(file.size > 1048770) {
        Notification.imageValidation()
      } else {
        let reader = new FileReader()
        reader.onload = event => {
          this.form.newphoto = event.target.result
        }
        reader.readAsDataURL(file)
      }
    }
  }
}
</script>

<style>

</style>