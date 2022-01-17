<template>
    <div>
       <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form  @submit.prevent="signUp">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" v-model="form.firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                   <small class="text-danger" v-if="errors.firstName">{{errors.firstName[0]}}</small>
                  <label for="firstName">First name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" v-model="form.lastName" class="form-control" placeholder="Last name" required="required">
                    <small class="text-danger" v-if="errors.lastName">{{errors.lastName[0]}}</small>
                  <label for="lastName">Last name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" v-model="form.email" class="form-control" placeholder="Email address" required="required">
              <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" v-model="form.password" class="form-control" placeholder="Password" required="required">
                  <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" v-model="form.password_confirm" class="form-control" placeholder="Confirm password" required="required">
                    <small class="text-danger" v-if="errors.password_confirm">{{errors.password_confirm[0]}}</small>
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
           <button type="submit" class="btn btn-primary btn-block">Register</button>

        </form>
        <div class="text-center">
            <router-link  class="d-block small mt-3" to="/">Login Page</router-link>

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
          
            firstName:null,
            lastName:null,
            email:null,
            password:null,
            password_confirm:null,
            
        },
     errors:{}
        
    }
},
methods:{
    signUp(){
        axios.post('/api/auth/signup',this.form)
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

   
          })
    }
  }
}
</script>

<style type="text/css">

</style>