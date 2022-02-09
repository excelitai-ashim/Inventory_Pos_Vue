 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">All Products</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            All Products
            <router-link
              :to="{ name: 'addProduct' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              Add Product</router-link
            >
          </div>
          <div class="card-body">
            <!-- ######################################################################### -->

            <div class="card-body">
              <div class="table-responsive">
                <table
                  class="table table-bordered"
                  id="dataTable"
                  width="100%"
                  cellspacing="0"
                >
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Category</th>
                      <th>Buying Price</th>
                      <th>Selling Price</th>
                      <th>Root</th>
                      <th>Supplier</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="product in products" :key="product.id">
                      <td>{{ product.product_name }}</td>
                      <td>
                        <img
                          :src="product.image"
                          id="e_photo"
                          class="card-img-top"
                        />
                      </td>
                      <td>{{ product.category_name }}</td>
                      <td>{{ product.buying_price }}</td>
                      <td>{{ product.selling_price }}</td>
                      <td>{{ product.root }}</td>
                      <td>{{ product.supplier_name }}</td>
                      <td>
                        <router-link
                          :to="{
                            name: 'editProduct',
                            params: { id: product.id },
                          }"
                          class="btn btn-info btn-sm"
                        >
                          Edit</router-link
                        >
                        <router-link to="#" class="btn btn-warning btn-sm">
                          View</router-link
                        >
                        <a
                          @click="deletproduct(product.id)"
                          class="btn btn-danger btn-sm"
                        >
                          Delete</a
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- ######################################################################### -->
          </div>
          <div class="card-footer small text-muted">
            Updated yesterday at 11:59 PM
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    if (!User.loggedin()) {
      this.$router.push({ name: "/" });
    }
  },
  data() {
    return {
      products: {},
    };
  },
  methods: {
    async allProducts() {
      this.products = {};
      await axios
        .get("/api/product/")
        .then(({ data }) => (this.products = data))
        .catch((err) => console.log(err));
      $(document).ready(function () {
        $("#dataTable").DataTable();
      });
    },

    deletproduct(id) {
      console.log(id);
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("api/product/" + id)
            .then(() => {
              //  this.employees=this.employees.filter(employee=>{
              //    return employee.id !=id
              //  })
              this.allProducts();

              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            })
            .catch(() => {
              this.$route.push({ name: "viewAllProduct" });
            });
        }
      });
    },
  },

  created() {
    this.allProducts();
  },
};
</script>

<style>
#e_photo {
  height: 80px;
  width: 100px;
}

.card {
  margin: 0 auto; /* Added */
  float: none; /* Added */
  margin-bottom: 5px; /* Added */
}
</style>