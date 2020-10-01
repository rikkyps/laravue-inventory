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
              <li class="breadcrumb-item active">Edit Karyawan</li>
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
            <h3 class="card-title">Edit Karyawan</h3>
          </div>
          
          <form role="form" @submit.prevent="updateEmployees()" enctype="multipart/form-data">
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
                <input v-model="form.name" type="text" class="form-control" placeholder="Nama Lengkap">
                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.ktp" type="text" class="form-control" placeholder="No. KTP">
                    <small class="text-danger" v-if="errors.ktp">{{ errors.ktp[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.sim" type="text" class="form-control" placeholder="No. SIM">
                    <small class="text-danger" v-if="errors.sim">{{ errors.sim[0] }}</small>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <select value="form.gender" class="form-control" v-model="form.gender">
                      <option value="">-</option>
                      <option value="L">Pria</option>
                      <option value="P">Wanita</option>
                    </select>
                    <small class="text-danger" v-if="errors.gender">{{ errors.gender[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.umur" type="number" class="form-control" placeholder="Umur">
                    <small class="text-danger" v-if="errors.umur">{{ errors.umur[0] }}</small>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.phone" type="text" class="form-control" placeholder="Nomor Telepon">
                    <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input v-model="form.joindate" type="date" class="form-control" placeholder="Tanggal Bergabung">
                    <small class="text-danger" v-if="errors.joindate">{{ errors.joindate[0] }}</small>
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
              </div>
              <div class="form-group">
                <textarea v-model="form.address" class="form-control" cols="15" rows="5" placeholder="Alamat"></textarea>
                <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
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
    axios.get('/api/employees/'+this.id)
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
        ktp: '',
        sim: '',
        umur: '',
        gender: '',
        phone: '',
        joindate: '',
        photo: '',
        newphoto: '',
        address: ''
      }
    }
  },
  methods: {
    updateEmployees() {
      axios.patch('/api/employees/'+this.id, this.form)
        .then(res => {
          this.$router.push({name: 'show-employees'})
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