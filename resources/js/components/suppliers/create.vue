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
              <li class="breadcrumb-item active">Add Supplier</li>
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
            <h3 class="card-title">Create Supplier</h3>
          </div>
          
          <form role="form" @submit.prevent="addSupplier()" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.name" type="text" class="form-control" placeholder="Nama Lengkap"
                    :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" v-model="form.shopname" placeholder="Nama Toko" class="form-control"
                    :class="{ 'is-invalid' : form.errors.has('shopname') }">
                    <has-error :form="form" field="shopname"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.email" type="email" class="form-control" placeholder="Email"
                    :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.phone" type="text" class="form-control" placeholder="Nomor Telepon"
                    :class="{ 'is-invalid': form.errors.has('phone') }">
                    <has-error :form="form" field="phone"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                 <div class="form-group">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" @change="onFileSelected"
                      :class="{ 'is-invalid': form.errors.has('photo') }">
                      <has-error :form="form" field="photo"></has-error>
                      <label class="custom-file-label" for="exampleInputFile">Photo</label>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <img :src="form.photo" alt="" style="width: 40px; height: 40px;">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <textarea v-model="form.address" class="form-control" cols="15" rows="5" placeholder="Alamat" :class="{ 'is-invalid': form.errors.has('address') }"></textarea>
                <has-error :form="form" field="address"></has-error>
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
        shopname: null,
        phone: null,
        photo: null,
        address: null
      })
    }
  },
  methods: {
    addSupplier(){
      this.form.post('/api/suppliers')
        .then(res => {
          Notification.success('Data supplier berhasil ditambahkan!')
          this.$router.push({name: 'show-suppliers'})
          console.log(res.data.msg)
        })
        .catch(err => {
          Notification.error('Ada kelasahan input!')
          console.log(err.response.body)
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
          console.log(event.target.result)
        }
        reader.readAsDataURL(file)
      }
    }
  }
}
</script>

<style>

</style>