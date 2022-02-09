 <template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link :to="{ name: 'home' }" id="home"> Dashboard</router-link>
      </li>
      <li class="breadcrumb-item active">Supplier</li>
    </ol>
    <!-- Icon Cards-->
    <div class="container">
      <div class="row">
        <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Supplier Update
            <router-link
              :to="{ name: 'viewAllSupplier' }"
              class="btn btn-sm btn-info"
              id="add_new"
            >
              All Suppliers</router-link
            >
          </div>
          <div class="card-body">
            <form
              @submit.prevent="supplierUpdate"
              enctype="multipart/form-data"
            >
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input
                        type="text"
                        v-model="form.name"
                        class="form-control"
                        required=""
                      />
                      <small class="text-danger" v-if="errors.name">{{
                        errors.name[0]
                      }}</small>
                      <label for="firstName">Full Name</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input
                        type="text"
                        v-model="form.email"
                        class="form-control"
                      />
                      <small class="text-danger" v-if="errors.email">{{
                        errors.email[0]
                      }}</small>
                      <label for="lastName">Email Address</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
                    <div class="form-label-group">
                      <input
                        type="text"
                        v-model="form.address"
                        class="form-control"
                        required=""
                      />
                      <small class="text-danger" v-if="errors.address">{{
                        errors.address[0]
                      }}</small>
                      <label for="firstName">Address</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input
                        type="text"
                        v-model="form.shopName"
                        class="form-control"
                        required=""
                      />
                      <label for="nid">Shop Name</label>
                      <small class="text-danger" v-if="errors.shopName">{{
                        errors.shopName[0]
                      }}</small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input
                        type="text"
                        v-model="form.phone"
                        class="form-control"
                        required=""
                      />
                      <label for="phone">Phone Number</label>
                      <small class="text-danger" v-if="errors.phone">{{
                        errors.phone[0]
                      }}</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input
                        type="file"
                        class="btn btn-info"
                        @change="onFileselected"
                      />

                      <small class="text-danger" v-if="errors.photo">{{
                        errors.photo[0]
                      }}</small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <img
                      v-if="newImage"
                      :src="newImage"
                      style="height: 80px; width: 80px"
                    />
                    <img
                      v-else
                      :src="form.photo"
                      style="height: 80px; width: 80px"
                    />
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
        name: "",
        email: "",
        address: "",
        photo: "",
        phone: "",
        shopName: "",
      },
      newImage: "",
      errors: {},
    };
  },
  mounted() {
    let id = this.$route.params.id;

    axios
      .get("/api/supplier/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
  },
  methods: {
    onFileselected(event) {
      let file = event.target.files[0];
      this.form.photo = file;
      if (file.size > 1048770) {
        Notification.image_validation();
      } else {
        let reader = new FileReader();
        reader.onload = (event) => {
          this.newImage = event.target.result;
          console.log(event.target.result);
        };
        reader.readAsDataURL(file);
      }
    },
    supplierUpdate() {
      let id = this.$route.params.id;
      let formData = new FormData();
      for (let i in this.form) {
        formData.append(i, this.form[i]);
      }

      axios
        .post("/api/supplier/" + id + "/update", formData)
        .then(() => {
          Notification.success();
          this.$router.push({ name: "viewAllSupplier" });
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