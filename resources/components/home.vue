<template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- Icon Cards-->
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-comments"></i>
            </div>
            <div class="mr-5" v-if="form.todaySell">
              {{ form.todaySell }} Taka
            </div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="#">
            <span class="float-left">Today Sell</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-list"></i>
            </div>
            <div class="mr-5" v-if="form.income">{{ form.income }} Taka</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="#">
            <span class="float-left">Today Income</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-shopping-cart"></i>
            </div>
            <div class="mr-5" v-if="form.due">{{ form.due }} Taka</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="#">
            <span class="float-left">Today Due</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-life-ring"></i>
            </div>
            <div class="mr-5" v-if="form.expense">{{ form.expense }} Taka</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="#">
            <span class="float-left">Today Expense</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
    </div>

    <!-- Area Chart Example-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-chart-area"></i>
        Stock Out Products
      </div>
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
                <th>Buying Price</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="product in form.products" :key="product.id">
                <td>{{ product.product_name }}</td>
                <td>{{ product.product_code }}</td>
                <td>
                  <img :src="product.image" id="e_photo" />
                </td>
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
                    :to="{ name: 'editStock', params: { id: product.id } }"
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
      <div class="card-footer small text-muted">
        Updated yesterday at 11:59 PM
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
export default {
  mounted() {
    if (!User.loggedin()) {
      this.$router.push({ name: "/" });
    }
  },
  data() {
    return {
      form: {
        todaySell: null,
        income: "",
        expense: "",
        supplier_id: "",
        due: "",
        products: "",
      },
      errors: {},
    };
  },
  created() {
    this.TodaySell();
    this.TodayIncome();
    this.TodayDue();
    this.TodayExpense();
    this.StockOut();
  },
  methods: {
    TodaySell() {
      axios
        .get("/api/today/sell/")
        .then(({ data }) => {
          this.form.todaySell = data;
          console.log(data);
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
    TodayIncome() {
      axios
        .get("/api/today/income/")
        .then(({ data }) => {
          this.form.income = data;
          console.log(data);
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
    TodayDue() {
      axios
        .get("/api/today/due/")
        .then(({ data }) => {
          this.form.due = data;
          console.log(data);
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
    TodayExpense() {
      axios
        .get("/api/today/expense/")
        .then(({ data }) => {
          this.form.expense = data;
          console.log(data);
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
    StockOut() {
      axios
        .get("/api/stockOutProducts/")
        .then(({ data }) => {
          this.form.products = data;
          console.log(data);
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>

<style type="text/css">
</style>