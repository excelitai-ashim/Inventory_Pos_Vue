 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Salary</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row container">
      <div class="card col-lg-12">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Create Salary
          <router-link
            :to="{ name: 'addSalary' }"
            class="btn btn-sm btn-info"
            id="add_new"
          >
            Pay Salary</router-link
          >
        </div>
        <div class="card-body">
          <form @submit.prevent="SalaryPaid">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input
                      type="text"
                      v-model="form.name"
                      class="form-control"
                      required=""
                    />
                    <small
                      class="text-danger"
                      v-if="Object.keys(errors) && errors.name"
                      >{{ errors.name[0] }}</small
                    >
                    <label for="firstName">Full Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input
                      type="text"
                      v-model="form.email"
                      class="form-control"
                    />
                    <small
                      class="text-danger"
                      v-if="Object.keys(errors) && errors.email"
                      >{{ errors.email[0] }}</small
                    >
                    <label for="lastName">Email Address</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <select
                      class="form-control"
                      id="exampleFormControlSelect1"
                      v-model="form.salary_month"
                    >
                      <option value="January">January</option>
                      <option value="February">February</option>
                      <option value="March">March</option>
                      <option value="April">April</option>
                      <option value="May">May</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                      <option value="September">September</option>
                      <option value="October">October</option>
                      <option value="November">November</option>
                      <option value="Devember">December</option>
                    </select>

                    <small
                      class="text-danger"
                      v-if="Object.keys(errors) && errors.salary_month"
                      >{{ errors.salary_month[0] }}</small
                    >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input
                      type="text"
                      v-model="form.salary"
                      class="form-control"
                      required=""
                    />
                    <label for="lastName">Salary</label>
                    <small
                      class="text-danger"
                      v-if="Object.keys(errors) && errors.salary"
                      >{{ errors.salary[0] }}</small
                    >
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success">Pay Now</button>
          </form>
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
  props: ["id"],
  mounted() {
    console.log(this.id);
    if (!User.loggedin()) {
      this.$router.push({ name: "/" });
    }
    let id = this.$route.params.id;
    console.log(id);
    axios
      .get("/api/employee/" + id)
      .then(({ data }) => (this.form = data))
      .catch();
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        salary: "",
        salary_month: "",
      },
      errors: {},
    };
  },

  methods: {
    SalaryPaid() {
      let id = this.$route.params.id;
      axios
        .post("/api/salary/paid/" + id, this.form)
        .then((res) => {
          let return_message = res.data;
          this.$router.push({ name: "addSalary" });
          if (return_message) {
            Notification.custom(return_message);
          } else {
            Notification.success();
          }
        })
        .catch((error) => {
          console.log(error.response);
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>

<style>
#add_new {
  float: right;
}
</style>
