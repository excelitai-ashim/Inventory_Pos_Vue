 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Search Order</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row container">
      <div class="card col-lg-12">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Search Orders
          <router-link
            :to="{ name: 'orders' }"
            class="btn btn-sm btn-info"
            id="add_new"
          >
            Today Order</router-link
          >
        </div>
        <div class="row">
          <div class="col-lg-6">
            <form @submit.prevent="searchDate">
              <div class="card-body">
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleFormControlSelect2"
                          >Search By Date</label
                        >
                        <input
                          type="date"
                          required=""
                          class="form-control"
                          v-model="form.date"
                        />
                      </div>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-success">
                      Search
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-6">
            <form @submit.prevent="searchMonth">
              <div class="card-body">
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleFormControlSelect2"
                          >Search By Month</label
                        >
                        <select
                          class="form-control"
                          id="exampleFormControlSelect2"
                          v-model="form.month"
                        >
                          <option value="January">January</option>
                          <option value="February">February</option>
                          <option value="March">March</option>
                          <option value="April">April</option>
                          <option value="May">May</option>
                          <option value="june">june</option>
                          <option value="July">July</option>
                          <option value="August">August</option>
                          <option value="September">September</option>
                          <option value="October">October</option>
                          <option value="November">November</option>
                          <option value="December">December</option>
                        </select>
                      </div>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-success">
                      Search
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-footer small text-muted">
        Updated yesterday at 11:59 PM
      </div>
    </div>

    <!-- ########################################### -->
    <br />
    <div class="row container">
      <div class="card col-lg-12">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Order Details
        </div>
        <div class="card-body">
          <div class="row">
            <div class="table-responsive">
              <label>Search</label>
              <br />
              <table
                class="table table-bordered"
                id=""
                width="100%"
                cellspacing="0"
              >
                <thead>
                  <tr>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Quentity</th>
                    <th>Subtutal</th>
                    <th>Vat</th>
                    <th>Total</th>
                    <th>Pay</th>
                    <th>Due</th>
                    <!-- <th>Acction</th> -->
                  </tr>
                </thead>

                <tbody v-if="Object.keys(orders).length">
                  <tr v-for="order in orders" :key="order.id">
                    <td>{{ order.customer.name }}</td>
                    <td>{{ order.order_details.product.product_name }}</td>
                    <td>{{ order.qty }}</td>
                    <td>{{ order.sub_total }}</td>
                    <td>{{ order.vat }} %</td>
                    <td>{{ order.total }}</td>
                    <td>{{ order.pay }}</td>
                    <td>{{ order.due }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card-footer small text-muted">
          Updated yesterday at 11:59 PM
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
      form: {
        date: "",
        month: "",
      },
      errors: {},
      orders: {},
    };
  },

  methods: {
    searchDate() {
      let date = { date: this.form.date };
      axios
        .post("/api/search/date", date)
        .then(({ data }) => {
          this.orders = data;
        })

        .catch((error) => (this.errors = error.response.data.errors));
    },
    searchMonth() {
      let month = { month: this.form.month };
      axios
        .post("/api/search/month", month)
        .then(({ data }) => {
          this.orders = data;
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>

<style>
#add_new {
  float: right;
}
</style>