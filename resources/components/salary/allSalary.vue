 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Salaries</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            All Salaries
            <router-link
              :to="{ name: 'addSalary' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              Pay Salary</router-link
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
                      <th>Month Name</th>
                      <th>Year</th>
                      <th>Details</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="salary in salaries" :key="salary.salary_month">
                      <td>{{ salary.salary_month }}</td>
                      <td>{{ salary.salary_year }}</td>
                      <td>
                        <router-link
                          :to="{
                            name: 'monthSalary',
                            params: { id: salary.salary_month },
                          }"
                          class="btn btn-info btn-sm"
                        >
                          View Salary</router-link
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
      salaries: {},
    };
  },
  methods: {
    async allSalaries() {
      await axios
        .get("/api/allSalary")
        .then(({ data }) => {
          this.salaries = data;
          console.log(data);
        })
        .catch((err) => console.log(err));
      $(document).ready(function () {
        $("#dataTable").DataTable();
      });
    },
  },

  created() {
    this.allSalaries();
  },
};
</script>

<style>
#e_photo {
  height: 80px;
  width: 100px;
}
</style>