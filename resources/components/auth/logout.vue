<template>
    <div>
        <h1>Logout</h1>
    </div>
</template>

<script type="text/javascript">
export default{
mounted(){
  if(! User.loggedin()){
    this.$router.push({name:'/'})

  }
    
    localStorage.removeItem('token')
    localStorage.removeItem('name')

  Toast.fire({
           icon: 'success',
            title: 'Successfully Logout'
         })
      this.$router.push({name: '/'})
 }

}
</script>

<style type="text/css">

</style>