<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link :to="{ name: 'show-employees' }" class="btn btn-primary">Semua Karyawan</router-link>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Karyawan</a></li>
              <li class="breadcrumb-item active">Add Karyawan</li>
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
            <h3 class="card-title">Create Karyawan</h3>
          </div>
          
          <form role="form" @submit.prevent="addEmployees()" enctype="multipart/form-data">
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
              <div class="form-group">
                <input v-model="form.name" type="text" class="form-control" placeholder="Nama Lengkap"
                :class="{ 'is-invalid': form.errors.has('name') }">
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.ktp" type="text" class="form-control" placeholder="No. KTP"
                    :class="{ 'is-invalid': form.errors.has('ktp') }">
                    <has-error :form="form" field="ktp"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.sim" type="text" class="form-control" placeholder="No. SIM"
                    :class="{ 'is-invalid': form.errors.has('sim') }">
                    <has-error :form="form" field="sim"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <select value="form.gender" class="form-control" v-model="form.gender"
                    :class="{ 'is-invalid': form.errors.has('gender') }">
                      <option value="">-</option>
                      <option value="L">Pria</option>
                      <option value="P">Wanita</option>
                    </select>
                    <has-error :form="form" field="gender"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.umur" type="number" class="form-control" placeholder="Umur"
                    :class="{ 'is-invalid': form.errors.has('umur') }">
                    <has-error :form="form" field="umur"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.phone" type="text" class="form-control" placeholder="Nomor Telepon"
                    :class="{ 'is-invalid': form.errors.has('phone') }">
                    <has-error :form="form" field="phone"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.joindate" type="date" class="form-control" placeholder="Tanggal Bergabung"
                    :class="{ 'is-invalid': form.errors.has('joindate') }">
                    <has-error :form="form" field="joindate"></has-error>
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
        ktp: null,
        sim: null,
        gender: null,
        umur: null,
        phone: null,
        joindate: null,
        photo: null,
        address: null
      })
    }
  },
  methods: {
    addEmployees(){
      this.form.post('/api/employees')
        .then(res => {
          Notification.success('Data karyawan berhasil ditambahkan!')
          this.$router.push({name: 'show-employees'})
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