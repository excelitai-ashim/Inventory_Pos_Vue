 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Category</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-8 card_center">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Category Update
            <router-link
              :to="{ name: 'viewAllCategory' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              All Category</router-link
            >
          </div>
          <div class="card-body">
            <form
              @submit.prevent="categoryUpdate"
              enctype="multipart/form-data"
            >
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-8 card_center">
                    <div class="form-label-group">
                      <input
                        type="text"
                        v-model="form.category_name"
                        class="form-control"
                        required=""
                      />

                      <small class="text-danger" v-if="errors.category_name">{{
                        errors.category_name[0]
                      }}</small>
                      <label for="firstName">Category Name</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-success card_center">
                  Update
                </button>
              </div>
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
        category_name: "",
      },
      errors: {},
    };
  },
  mounted() {
    let id = this.$route.params.id;

    axios
      .get("/api/category/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
  },
  methods: {
    categoryUpdate() {
      let id = this.$route.params.id;
      let formData = new FormData();
      for (let i in this.form) {
        formData.append(i, this.form[i]);
      }

      axios
        .post("/api/category/" + id + "/update/", formData)

        .then(() => {
          Notification.success();
          this.$router.push({ name: "viewAllCategory" });
        })
        .catch((error) => {
          console.log(error.response);
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