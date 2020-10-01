<template>
  
</template>

<script>
export default {
  created() {
    this.$Progress.start()
    User.clear()
    Toast.fire({
      icon: 'success',
      title: 'Logout berhasil!'
    })
    this.$router.push({name: 'login'})
  }
}
</script>

<style>

</style>