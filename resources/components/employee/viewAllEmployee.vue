 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">All Employee</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            All Employee
            <router-link
              :to="{ name: 'addEmployee' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              Add Employee</router-link
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
                      <th>Joining Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="employee in employees" :key="employee.id">
                      <td>{{ employee.name }}</td>
                      <td>
                        <img :src="employee.photo" id="e_photo" />
                      </td>
                      <td>{{ employee.phone }}</td>
                      <td>{{ employee.salary }}</td>
                      <td>{{ employee.joining_date }}</td>
                      <td>
                        <router-link
                          :to="{
                            name: 'editEmployee',
                            params: { id: employee.id },
                          }"
                          class="btn btn-info btn-sm"
                        >
                          Edit</router-link
                        >
                        <router-link to="/view" class="btn btn-warning btn-sm">
                          View</router-link
                        >
                        <a
                          @click="deletEmployee(employee.id)"
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
      employees: {},
    };
  },
  methods: {
    async allEmployes() {
      this.employees = {};
      await axios
        .get("/api/employee/")
        .then(({ data }) => (this.employees = data))
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