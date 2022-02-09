 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Customer</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            All Customer
            <router-link
              :to="{ name: 'addCustomer' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              Add Customer</router-link
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
                      <th>Email</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="customer in customers" :key="customer.id">
                      <td>{{ customer.name }}</td>
                      <td>
                        <img :src="customer.photo" id="e_photo" />
                      </td>
                      <td>{{ customer.phone }}</td>
                      <td>{{ customer.email }}</td>
                      <td>{{ customer.address }}</td>
                      <td>
                        <router-link
                          :to="{
                            name: 'editCustomer',
                            params: { id: customer.id },
                          }"
                          class="btn btn-info btn-sm"
                        >
                          Edit</router-link
                        >
                        <a
                          @click="deletCustomer(customer.id)"
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
      customers: {},
    };
  },
  methods: {
    async allCustomer() {
      await axios
        .get("/api/customer/")
        .then(({ data }) => (this.customers = data))
        .catch((err) => console.log(err));
      $(document).ready(function () {
        $("#dataTable").DataTable();
      });
    },

    deletCustomer(id) {
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
            .delete("api/customer/" + id)
            .then(() => {
              //  this.employees=this.employees.filter(employee=>{
              //    return employee.id !=id
              //  })
              this.allCustomer();

              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            })
            .catch(() => {
              this.$route.push({ name: "viewAllCustomer" });
            });
        }
      });
    },
  },

  created() {
    this.allCustomer();
  },
};
</script>

<style>
#e_photo {
  height: 80px;
  width: 100px;
}
</style>