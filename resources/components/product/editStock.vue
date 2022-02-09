 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Stock</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row container">
      <div class="card col-lg-12">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Stock Quantity Update
          <router-link
            :to="{ name: 'stock' }"
            class="btn btn-sm btn-info"
            id="add_new"
          >
            All Stock</router-link
          >
        </div>
        <div class="card-body">
          <form @submit.prevent="StockUpdate" enctype="multipart/form-data">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-2">
                  <div class="form-label-group">
                    <img
                      :src="form.image"
                      style="height: 120px; width: 120px"
                    />
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-label-group">
                    <input
                      type="text"
                      v-model="form.product_name"
                      class="form-control"
                      required=""
                    />
                    <small class="text-danger" v-if="errors.product_name">{{
                      errors.product_name[0]
                    }}</small>
                    <label for="firstName">Product Name</label>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-label-group">
                    <input
                      type="text"
                      v-model="form.product_quantity"
                      class="form-control"
                      required=""
                    />
                    <label for="phone">Quantity </label>
                    <small class="text-danger" v-if="errors.product_quantity">{{
                      errors.product_quantity[0]
                    }}</small>
                  </div>
                </div>
              </div>
            </div>
            <br />

            <button type="submit" class="btn btn-success">Update</button>
          </form>
        </div>
        <div class="card-footer small text-muted">
          Updated yesterday at 11:59 PM
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
        product_name: "",
        image: "",
        product_quantity: "",
      },

      errors: {},
    };
  },
  mounted() {
    let id = this.$route.params.id;
    axios
      .get("/api/product/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
  },
  methods: {
    StockUpdate() {
      let id = this.$route.params.id;
      let formData = new FormData();
      for (let i in this.form) {
        formData.append(i, this.form[i]);
      }

      axios
        .post("/api/stock/update/" + id, formData)
        .then(() => {
          Notification.success();
          this.$router.push({ name: "stock" });
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
.card {
  margin: 0 auto; /* Added */
  float: none; /* Added */
  margin-bottom: 5px; /* Added */
}
</style>