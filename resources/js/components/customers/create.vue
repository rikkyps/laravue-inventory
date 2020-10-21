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
              <li class="breadcrumb-item active">Add Pelanggan</li>
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
            <h3 class="card-title">Create Pelanggan</h3>
          </div>
          
          <form role="form" @submit.prevent="addCustomer()" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-5">
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <img id="showimage" :src="form.photo" alt="" style="height: 100px; width: 100px;">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Nama</label>
                    <input type="text" v-model="form.name" class="form-control"
                    :class="{ 'is-invalid' : form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="" class="control-label">Telepon</label>
                    <input type="text" v-model="form.phone" class="form-control"
                    :class="{ 'is-invalid' : form.errors.has('phone') }">
                    <has-error :form="form" field="phone"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Email</label>
                    <input type="email" v-model="form.email" class="form-control"
                    :class="{ 'is-invalid' : form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="" class="control-label">Photo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" @change="onFileSelected"
                        :class="{ 'is-invalid': form.errors.has('photo') }">
                        <has-error :form="form" field="photo"></has-error>
                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea v-model="form.address" cols="30" rows="5" placeholder="Alamat" class="form-control" 
                    :class="{ 'is-invalid' : form.errors.has('address') }"></textarea>
                    <has-error :form="form" field="address"></has-error>
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
        email: null,
        phone: null,
        address: null,
        photo: null,
      }),
    }
  },
  methods: {
    addCustomer(){
      this.form.post('/api/customers')
        .then(res => {
          this.$router.push({ name: 'show-customers'})
          Notification.success(res.data.msg)
        })
        .catch(err => {
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
          this.form.photo = event.target.result
        }
        reader.readAsDataURL(file)
      }
    },
  }
}
</script>

<style>

</style>