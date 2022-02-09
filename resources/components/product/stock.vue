 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Products</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Stock Products
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
                      <th>Code</th>
                      <th>Photo</th>
                      <th>Category</th>
                      <th>Buying Price</th>
                      <th>Status</th>
                      <th>Quantity</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="product in products" :key="product.id">
                      <td>{{ product.product_name }}</td>
                      <td>{{ product.product_code }}</td>
                      <td>
                        <img :src="product.image" id="e_photo" />
                      </td>
                      <td>{{ product.category_name }}</td>
                      <td>{{ product.buying_price }}</td>
                      <td v-if="product.product_quantity >= 10">
                        <span class="badge badge-success">Availble</span>
                      </td>
                      <td v-else-if="product.product_quantity > 0">
                        <span class="badge badge-warning">Stock Low</span>
                      </td>
                      <td v-else>
                        <span class="badge badge-danger">Stock Out</span>
                      </td>
                      <td>{{ product.product_quantity }}</td>
                      <td>
                        <router-link
                          :to="{
                            name: 'editStock',
                            params: { id: product.id },
                          }"
                          class="btn btn-info btn-sm"
                        >
                          Edit</router-link
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