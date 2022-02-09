 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">All Expense</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            All Products
            <router-link
              :to="{ name: 'addExpense' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              Add Expense</router-link
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
                      <th>Amount</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="expense in expenses" :key="expense.id">
                      <td>{{ expense.details }}</td>
                      <td>{{ expense.amount }}</td>
                      <td>{{ expense.expenses_date }}</td>

                      <td>
                        <router-link
                          :to="{
                            name: 'editExpense',
                            params: { id: expense.id },
                          }"
                          class="btn btn-sm btn-info"
                          >Edit</router-link
                        >
                        <a
                          @click="deleteExpense(expense.id)"
                          class="btn btn-sm btn-danger"
                          >Delete</a
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
  created() {
    this.allExpense();
  },
  data() {
    return {
      expenses: {},
    };
  },

  methods: {
    async allExpense() {
      await axios
        .get("/api/expense/")
        .then(({ data }) => {
          console.log(this);
          this.expenses = data;
        })
        .catch((error) => {
          console.log(error);
        });
      console.log(this.expenses);
      $("#dataTable").DataTable();
    },
    deleteExpense(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/expense/" + id)
            .then(() => {
              this.allExpense();
            })
            .catch(() => {
              this.$router.push({ name: "expense" });
            });
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
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
#em_photo {
  height: 80px;
  width: 80px;
}
</style>