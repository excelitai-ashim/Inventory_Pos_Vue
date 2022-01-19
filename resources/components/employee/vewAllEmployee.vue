 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> All Employee</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            All Employee 
            <router-link to="/addEmployee" class="btn btn-sm btn-info" id="add_new"> Add Employee</router-link>
          </div>
          <div class="card-body">
          	  <h1>vue All Employee</h1>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
         </div>
       </div>
   </div>
</template>

<script>
    export default {
    	mounted(){
            if (!User.loggedin()) {
               this.$router.push({ name:'/' })
            } 
        },
       
      
    }
  
</script>

<style>
	

</style>