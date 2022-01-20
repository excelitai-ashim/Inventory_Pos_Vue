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

                          <!-- ######################################################################### -->



          	  <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>Salary</th>
                    <th>Joining Date</th>
                     <th>Acction</th>


                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>Salary</th>
                    <th>Joining Date</th>
                     <th>Acction</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr v-for="employee in employees" :key="employee.id">
                    <td>{{employee.name}}</td>
                    <td>System Architect</td>
                    <td>{{employee.phone}}</td>
                    <td>{{employee.salary}}</td>
                    <td>{{employee.joining_date}}</td>
                    <td>$320,800</td>
                   
                  </tr>
            
              
                  
                </tbody>
              </table>
            </div>
          </div>

                       <!-- ######################################################################### -->
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
       date(){
         return{
           employees:{}
         }
       },
       methods:{
         allEmployes(){
           axios.get('/api/employee/')
           .then(({date})=>(this.employees = date))
           .catch()

         }
       },
       created(){
         this.allEmployes();
       }
      
    }
  
</script>

<style>
	

</style>