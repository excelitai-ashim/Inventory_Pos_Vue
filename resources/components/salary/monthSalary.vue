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
            Employee Salary Details
            <router-link
              :to="{ name: 'allSalary' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              All Salary</router-link
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
                      <th>Month</th>
                      <th>Amount</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="salary in salaryes" :key="salary.id">
                      <td>{{ salary.employee.name }}</td>
                      <td>{{ salary.salary_month }}</td>
                      <td>{{ salary.amount }}</td>
                      <td>{{ salary.salary_date }}</td>
                      <td>
                        <router-link
                          :to="{
                            name: 'editSalary',
                            params: { id: salary.id },
                          }"
                          class="btn btn-sm btn-info"
                          >Edit Salary</router-link
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
      salaryes: {},
    };
  },
  methods: {
    async allEmployes() {
      let id = this.$route.params.id;
      await axios
        .get("/api/monthSalary/" + id)
        .then(({ data }) => (this.salaryes = data))
        .catch((err) => console.log(err));
      $(document).ready(function () {
        $("#dataTable").DataTable();
      });
    },

    deletEmployee(id) {
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
            .delete("api/employee/" + id)
            .then(() => {
              //  this.employees=this.employees.filter(employee=>{
              //    return employee.id !=id
              //  })
              this.allEmployes();

              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            })
            .catch(() => {
              this.$route.push({ name: "vewAllEmployee" });
            });
        }
      });
    },
  },

  created() {
    this.allEmployes();
  },
};
</script>

<style>
#e_photo {
  height: 80px;
  width: 100px;
}
</style>