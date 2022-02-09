 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">All Category</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-8">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            All Employee
            <router-link
              :to="{ name: 'addCategory' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              Add Category</router-link
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
                      <th>Category Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="category in categorys" :key="category.id">
                      <td>{{ category.category_name }}</td>

                      <td>
                        <router-link
                          :to="{
                            name: 'editCategory',
                            params: { id: category.id },
                          }"
                          class="btn btn-info btn-sm"
                        >
                          Edit</router-link
                        >
                        <a
                          @click="deletCategory(category.id)"
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
      categorys: {},
    };
  },
  methods: {
    async allCategorys() {
      this.categorys = {};
      await axios
        .get("/api/category/")
        .then(({ data }) => (this.categorys = data))
        .catch((err) => console.log(err));
      $(document).ready(function () {
        $("#dataTable").DataTable();
      });
    },

    deletCategory(id) {
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
            .delete("api/category/" + id)
            .then(() => {
              //  this.employees=this.employees.filter(employee=>{
              //    return employee.id !=id
              //  })
              this.allCategorys();

              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            })
            .catch(() => {
              this.$route.push({ name: "viewAllCategory" });
            });
        }
      });
    },
  },

  created() {
    this.allCategorys();
  },
};
</script>

<style>
#e_photo {
  height: 80px;
  width: 100px;
}
.card {
  margin: 0 auto; /* Added */
  float: none; /* Added */
  margin-bottom: 5px; /* Added */
}
</style>