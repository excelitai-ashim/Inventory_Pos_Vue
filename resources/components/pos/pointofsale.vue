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
            Expense Insert 
            <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal" id="add_new"> Add Customer</a>
          </div>
          <div class="card-body">
          	
                                              <!-- ######################################################################### -->
                                                <!--customer add modal--> 
             <!-- Modal -->
             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
               <div class="modal-dialog" role="document">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">             
                    <form @submit.prevent="customerInsert" enctype="multipart/form-data">
                      <div class="form-group">
                      <div class="form-row">
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="text" v-model="form.name" class="form-control"   required="">
                          <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                          <label for="firstName">Full Name</label>
                        </div>
                       </div>
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="text" v-model="form.email" class="form-control" >
                          <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                          <label for="lastName">Email Address</label>
                        </div>
                       </div>
                     </div>
                  </div>
                  <div class="form-group">
                      <div class="form-row">
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="text" v-model="form.address" class="form-control"  required="">
                          <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                          <label for="firstName">Address</label>
                        </div>
                       </div>
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="text" v-model="form.phone" class="form-control"  required="">
                          <label for="lastName">Phone</label>
                          <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                        </div>
                       </div>
                     </div>
                  </div>
                     <div class="form-group">
                      <div class="form-row">
                       <div class="col-md-6">
                        <div class="form-label-group">
                         <input type="file" class="btn" @change="onFileselected">
                          <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                        </div>
                       </div>
                        <div class="col-md-6">
                          <img :src="form.photo" style="height:40px; width: 40px;">
                        </div>
                     </div>
                  </div>
                <button type="submit" class="btn btn-success">Submit</button>
               
                  </form>
          
                   </div>
                 </div>
               </div>
             </div>
             <!--end customer modal-->
            




                                             <!-- ######################################################################### -->

          
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
          </div><br>
                 <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                  </li>
                 
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
               <div class="card-body">
             	<div class="card-body">
              <input type="text" v-model="searchTerm" class="form-control" placeholder="search"><br>

              <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filtersearch" :key="product.id">
                        <a href="#">
                      <div class="card" style="width: 10rem;">
                       <img :src="product.image" id="e_photo" class="card-img-top" >
                       <div class="card-body">
                       <h5 class="card-title">{{product.product_name}}</h5><br>

                       <span  v-if="product.product_quantity>=10" class="badge badge-success">Availble {{product.product_quantity}}</span>
                       <span  v-else-if="product.product_quantity>0" class="badge badge-warning">Stock Low {{product.product_quantity}}</span>
                       <span v-else class="badge badge-danger">Stock Out {{product.product_quantity}}</span>
                       </div>
                     </div>
                    </a>
                    </div>          
            </div>
          </div>
          </div>
                  </div>
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">.2..</div>
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
        created(){
         this.allProduct();
        },
        data(){
          return{
            form:{
              details :'',
              amount:'',
              name :'',
              email :'',
              address:'',
              photo :'',
              phone:'',
            },
            errors:{},
            products:[],
            searchTerm:'',         
          }
        },
       computed:{
         filtersearch(){
          return this.products.filter(product => {
             return product.product_name.match(this.searchTerm)
           })
         }
       },
        methods:{
          allProduct(){
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch()
          },
          onFileselected(event){
            
          }
       
        },
      
    }
     
  
</script>

<style>
	#e_photo{
   height: 100px;
  width: 90px;
  }

  .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 5px; /* Added */
}

</style>