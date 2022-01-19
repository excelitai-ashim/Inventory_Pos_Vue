<template>
    <div>
        <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Forget password</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" v-model="form.email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Existing email address</label>
            </div>
          </div>
         
          
          <a class="btn btn-primary btn-block">Reset account</a>
        </form>
        <div class="text-center">
           <router-link class="d-block small mt-3" to="/">back to login </router-link>

           <router-link  class="d-block small mt-3" to="register">Register an Account</router-link>
        </div>
      </div>
    </div>
  </div>
    </div>
</template>

<script type="text/javascript">
export default{
mounted(){
  if(User.loggedin()){
    this.$router.push({name:'home'})

  }

},

data()
{
    return{
        form:{
            email:null,
        },
     errors:{}
        
    }
},

}
</script>

<style type="text/css">

</style>