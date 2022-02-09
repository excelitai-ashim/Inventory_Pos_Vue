 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Today Order Table</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Order Table
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
                      <th>Customer Name</th>
                      <th>Total Amount</th>
                      <th>Pay</th>
                      <th>Due</th>
                      <th>PayBy</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="order in orders" :key="order.id">
                      <td>{{ order.customer.name }}</td>
                      <td>{{ order.total }}</td>
                      <td>{{ order.pay }}</td>
                      <td>{{ order.due }}</td>
                      <td>{{ order.payby }}</td>
                      <td>
                        <router-link
                          :to="{ name: 'viewOrder', params: { id: order.id } }"
                          class="btn btn-sm btn-info"
                          >view</router-link
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
  created() {
    this.allOrder();
  },
  data() {
    return {
      orders: [],
      expenses: {},
    };
  },

  methods: {
    async allOrder() {
      await axios
        .get("/api/orders/")
        .then(({ data }) => {
          console.log(this);
          this.orders = data;
        })
        .catch((error) => {
          console.log(error);
        });
      console.log(this.expenses);
      $("#dataTable").DataTable();
    },
  },
};
</script>

<style>
#add_new {
  float: right;
}
#em_photo {
  height: 80px;
  width: 80px;
}
</style>