 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
           <router-link to="/home"  id="home"> Dashboard</router-link>
          </li>
          <li class="breadcrumb-item active"> Point of sale</li>
        </ol>
        <div class="row">
            <div class="col-lg-5 col-md-5">

                 <div class="row card container">
         <div class="row" >
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Products 
          </div>
          <div class="card-body">
          	<div class="card-body">
                                              <!-- ######################################################################### -->
            




                                             <!-- ######################################################################### -->

          </div>
          </div>
         </div>
       </div>
       </div>

            </div>

            <div class="col-lg-7 col-md-7">

                  <!-- Icon Cards-->
       <div class="row card container">
         <div class="row" >
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Products 
          </div>
            <input type="text" v-model="searchTerm" class="form-control" placeholder="search"><br>

          <div class="card-body">
          	<div class="card-body">
            <div class="row">
                      <div class="col-lg-3 col-md-4 col-sm-6 col-6" v-for="product in filtersearch" :key="product.id">
                      <div class="card" style="width: 10rem;">
                       <img src="" class="card-img-top" >
                       <div class="card-body">
                       <h5 class="card-title">Card title</h5>
                       </div>
                    </div>
                </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                    <div class="card" style="width: 10rem;">
                       <img src="" class="card-img-top" >
                       <div class="card-body">
                       <h5 class="card-title">Card title</h5>
                       </div>
                    </div>
                </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                    <div class="card" style="width: 10rem;">
                       <img src="" class="card-img-top" >
                       <div class="card-body">
                       <h5 class="card-title">Card title</h5>
                       </div>
                    </div>
                </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                    <div class="card" style="width: 10rem;">
                       <img src="" class="card-img-top" >
                       <div class="card-body">
                       <h5 class="card-title">Card title</h5>
                       </div>
                    </div>
                </div>
            </div>

          </div>
          </div>
         </div>
       </div>
       </div>

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
       data(){
         return{
           products:{}
         }
       },
       methods:{
         async allProducts(){
           this.products={};
           await axios.get('/api/product/')
           .then(({data})=>(this.products = data))
           .catch(err=>console.log(err))
           $(document).ready(function() {
              $('#dataTable').DataTable();
            });
         },

         
       },
     
       created(){
         this.allProducts();
       }
      
    }
  
</script>

<style>
	#e_photo{
    height: 80px;
    width: 100px;
  }

  .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 5px; /* Added */
}

</style>