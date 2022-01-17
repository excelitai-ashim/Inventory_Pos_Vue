<template>
    <div>
        <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form @submit.prevent="login">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" v-model="form.email" id="inputEmail" class="form-control" placeholder="Email address" autofocus="autofocus" required="required">
              <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" v-model="form.password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>


              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="text-center">
              <router-link  class="d-block small mt-3" to="register">Register an Account</router-link>
              <router-link class="d-block small" to="forgetPas">Forgot Password?</router-link>

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
            password:null
        },
     errors:{}
        
    }
},
methods:{
    login(){
        axios.post('/api/auth/login',this.form)
        // .then(response=>console.log(response.data))

        .then(res=>{
          User.responseAfterLogin(res)
          
          Toast.fire({
                     icon: 'success',
                     title: 'Signed in successfully'
                   })
          this.$router.push({name:'home'})
        
        })

        .catch(error=>{
              if(error.response.status === 422){
                  this.errors= error.response.data.errors
                  // console.log(error.response.data.errors)
              }

               Toast.fire({
                     icon: 'warning',
                     title: 'Invalid email or pasword! Please try again'
                   })

   
          })
    }
  }
}
</script>

<style type="text/css">

</style>