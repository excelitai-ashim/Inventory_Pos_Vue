 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">All Suppliers</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            All Employee
            <router-link
              :to="{ name: 'addSupplier' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              Add Supplier</router-link
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
                      <th>Shop Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="Supplier in Suppliers" :key="Supplier.id">
                      <td>{{ Supplier.name }}</td>
                      <td>
                        <img :src="Supplier.photo" id="s_photo" />
                      </td>
                      <td>{{ Supplier.phone }}</td>
                      <td>{{ Supplier.email }}</td>
                      <td>{{ Supplier.shopName }}</td>
                      <td>
                        <router-link
                          :to="{
                            name: 'editSupplier',
                            params: { id: Supplier.id },
                          }"
                          class="btn btn-info btn-sm"
                        >
                          Edit</router-link
                        >
                        <router-link to="#" class="btn btn-warning btn-sm">
                          View</router-link
                        >
                        <a
                          @click="deleteSupplier(Supplier.id)"
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
      Suppliers: {},
    };
  },
  methods: {
    async allSuppliers() {
      this.Suppliers = {};
      await axios
        .get("/api/supplier")
        .then(({ data }) => (this.Suppliers = data))
        .catch();
      $(document).ready(function () {
        $("#dataTable").DataTable();
      });
    },

    deleteSupplier(id) {
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
            .delete("api/supplier/" + id)
            .then(() => {
              //  this.employees=this.employees.filter(employee=>{
              //    return employee.id !=id
              //  })

              this.allSuppliers();

              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            })

            .catch(() => {
              this.$route.push({ name: vewAllEmployee });
            });
        }
      });
    },
  },

  created() {
    this.allSuppliers();
  },
};
</script>

<style>
#s_photo {
  height: 80px;
  width: 100px;
}
</style>