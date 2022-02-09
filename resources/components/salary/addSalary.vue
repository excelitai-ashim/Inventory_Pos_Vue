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
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            All Salaries
            <router-link
              :to="{ name: 'allSalary' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              AllSalary</router-link
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
                      <th>Phone</th>
                      <th>Salary</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="employee in employees" :key="employee.id">
                      <td>{{ employee.name }}</td>
                      <td><img :src="employee.photo" id="em_photo" /></td>
                      <td>{{ employee.phone }}</td>
                      <td>{{ employee.salary }}</td>
                      <td>
                        <router-link
                          :to="{
                            name: 'createSalary',
                            params: { id: employee.id },
                          }"
                          class="btn btn-sm btn-info"
                          >Pay Salary</router-link
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
    console.log(this.employees);
  },
  created() {
    this.allEmployee();
  },
  data() {
    return {
      employees: [],
    };
  },

  methods: {
    async allEmployee() {
      await axios
        .get("/api/employee/")
        .then(({ data }) => (this.employees = data))
        .catch();
      $(document).ready(function () {
        $("#dataTable").DataTable();
      });
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