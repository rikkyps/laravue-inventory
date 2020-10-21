<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'show-customers' }" class="btn btn-primary">Semua Pelanggan</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pelanggan</a></li>
              <li class="breadcrumb-item active">Edit Pelanggan</li>
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
            <h3 class="card-title">Edit Pelanggan</h3>
          </div>
          
          <form role="form" @submit.prevent="updateCustomer()" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-5">
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <img id="showimage" :src="form.newphoto" alt="" style="height: 100px; width: 100px;">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Nama</label>
                    <input type="text" v-model="form.name" class="form-control">
                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                  </div>
                  <div class="form-group">
                    <label for="" class="control-label">Telepon</label>
                    <input type="text" v-model="form.phone" class="form-control">
                    <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Email</label>
                    <input type="email" v-model="form.email" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="" class="control-label">Photo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" @change="onFileSelected">
                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea v-model="form.address" cols="30" rows="5" placeholder="Alamat" class="form-control"></textarea>
                    <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
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
    axios.get('/api/customers/'+this.id)
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
        email: '',
        phone: '',
        address: '',
        photo: '',
        newphoto: ''
      }
    }
  },
  methods: {
    updateCustomer() {
      axios.patch('/api/customers/'+this.id, this.form)
        .then(res => {
          this.$router.push({name: 'show-customers'})
          Notification.success(res.data.msg)
        })
        .catch(err => {
          this.errors = err.response.data.errors
          Notification.error('Terjadi kesalahan input data')
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