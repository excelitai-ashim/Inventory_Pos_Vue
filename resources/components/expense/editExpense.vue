 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Expense</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Expense Update
            <router-link
              :to="{ name: 'TodayExpense' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              All Expense</router-link
            >
          </div>
          <div class="card-body">
            <form @submit.prevent="expenseUpdate" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1"
                          >Details Of Expense</label
                        >
                        <textarea
                          class="form-control"
                          id="exampleFormControlTextarea1"
                          rows="3"
                          v-model="form.details"
                        ></textarea>
                        <small class="text-danger" v-if="errors.details">{{
                          errors.details[0]
                        }}</small>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-label-group">
                        <input
                          type="text"
                          v-model="form.amount"
                          class="form-control"
                        />
                        <small class="text-danger" v-if="errors.amount">{{
                          errors.amount[0]
                        }}</small>
                        <label for="firstName">Expense Amount</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-success">Update</button>
            </form>
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
    // console.log(User);
    if (!User.loggedin()) {
      this.$router.push({ name: "/" });
    }
  },
  data() {
    return {
      form: {
        details: "",
        amount: "",
      },

      errors: {},
    };
  },
  mounted() {
    let id = this.$route.params.id;

    axios
      .get("/api/expense/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
  },
  methods: {
    expenseUpdate() {
      let id = this.$route.params.id;
      let formData = new FormData();
      for (let i in this.form) {
        formData.append(i, this.form[i]);
      }

      axios
        .post("/api/expense/" + id + "/update", formData)
        .then(() => {
          Notification.success();
          this.$router.push({ name: "TodayExpense" });
        })
        .catch((error) => {
          console.log(error);
          if (error.response.status === 422) {
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