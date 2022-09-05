<template>
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row">
          <!-- body -->
          <div class="col-lg-12">
            <h1
              class="page-header"
              style="
                text-align: center;
                color: #2a789b;
                font-size: 40px;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial,
                  sans-serif;
                border-bottom: 1px solid #fff;
              "
            >
              EDIT POST
            </h1>
            <div class="col-xs-11">
              <form @submit.prevent="updatedPost" enctype="multipart/form-data">
                <div class="alert alert-danger mt-4" v-if="errors.length">
                  <ul class="mb-0">
                    <li v-for="(error, index) in errors" :key="index">
                      {{ error }}
                    </li>
                  </ul>
                </div>
                <div class="form-group">
                  <label for="title" style="color: black; font-weight: bold"
                    >Title</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    name="post_title"
                    v-model="post.post_title"
                  />
                </div>

                <div class="form-group">
                  <label
                    for="post_image"
                    style="color: black; font-weight: bold"
                    >Image</label
                  >
                  <br />
                  <img
                    class="img-responsive"
                    width="102"
                    v-bind:src="'../../' + post.post_image"
                    alt="image"
                  />
                  <input type="file" name="image" @change="onChange" />
                </div>

                <div class="form-group">
                  <label for="category" style="color: black; font-weight: bold"
                    >Category</label
                  >
                  <select
                    name="post_category"
                    id=""
                    v-model="post.post_category_id"
                    aria-label="Default selected category "
                  >
                    <!-- <option selected v-if="post.post_category_id" :value="post.post_category_id">{{ post.post_category_name }} </option> -->
                    <option
                      v-for="category in categories"
                      :key="category._id"
                      :value="category._id"
                    >
                      {{ category.cat_title }}
                    </option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="category" style="color: black; font-weight: bold"
                    >Status</label
                  >
                  <select name="post_status" id="" v-model="post.post_status">
                    <!-- <option disabled selected value>
                      -- select an option --
                    </option> -->
                    <option v-for="item in selectStatus" :value="item.id" :key="item.id">{{ item.name }}</option>
                    <!-- <option value="Publish">Publish</option> -->
                  </select>
                  <!-- <input type="text" class="form-control" name="post_author" v-model = "post.post_status"> -->
                </div>

                <div class="form-group">
                  <label for="title" style="color: black; font-weight: bold"
                    >Author</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    name="post_author"
                    v-model="post.post_author"
                  />
                </div>

                <div class="form-group">
                  <label for="title" style="color: black; font-weight: bold"
                    >Content</label
                  >
                  <textarea
                    class="form-control"
                    name="post_content"
                    id="summernote"
                    cols="30"
                    rows="10"
                    v-model="post.post_content"
                  ></textarea>
                </div>
                <div class="form-group">
                  <label for="title" style="color: black; font-weight: bold"
                    >Tag</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    name="post_tag"
                    v-model="post.post_tags"
                  />
                </div>
                <div class="form-group">
                  <input
                    class="btn btn-success"
                    type="submit"
                    name="create"
                    value="Sửa bài viết"
                  />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
  name: "EditPost",
  data() {
    return {
      post: {
        post_title: "",
        post_image: "",
        post_category_id: "",
        post_status: "",
        post_content: "",
        post_author: "",
        post_tags: "",
      },
      errors: [],
      categories: [],
      selectStatus: [
        { name: "Publish", id: "Publish" },
        { name: "Draft", id: "Draft" },
      ],
    };
  },
  created() {},
  mounted() {
    this.getPostById();
    this.getCategories();
  },
  methods: {
    onChange(e) {
      console.log("selected file", e.target.files[0]);
      this.post.post_image = e.target.files[0];
    },
    async getPostById() {
      let url = `http://127.0.0.1:8000/api/edit_post/${this.$route.params.id}`;
      await axios.get(url).then((response) => {
        console.log(response);
        this.post = response.data;
      });
    },

    async getCategories() {
      let url = "http://127.0.0.1:8000/api/categories_all";
      await axios
        .get(url)
        .then((response) => {
          this.categories = response.data.categories;
          console.log(this.post.post_category_id);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async updatedPost() {
      this.errors = [];
      if (!this.post.post_title) {
        this.errors.push("Post title is required");
      }
      if (!this.post.post_image) {
        this.errors.push("Post image is required");
      }
      if (!this.post.post_category_id) {
        this.errors.push("Post category is required");
      }
      if (!this.post.post_content) {
        this.errors.push("Post content is required");
      }
      if (!this.post.post_author) {
        this.errors.push("Post author is required");
      }
      if (!this.post.post_tags) {
        this.errors.push("Post tags is required");
      }
      if (!this.post.post_status) {
        this.errors.push("Post status is required");
      }
      if (!this.errors.length) {
        let formData = new FormData();
        formData.append("post_title", this.post.post_title);
        formData.append("post_category_id", this.post.post_category_id);
        formData.append("post_content", this.post.post_content);
        formData.append("post_image", this.post.post_image);
        formData.append("post_author", this.post.post_author);
        formData.append("post_tags", this.post.post_tags);
        formData.append("post_status", this.post.post_status);
        let url = `http://127.0.0.1:8000/api/update_post/${this.$route.params.id}`;
        await axios
          .post(url, formData)
          .then((response) => {
            console.log(response);

            // `status` là mã HTTP status trả về từ server
            if (response.status == 200) {
              //sau khi thêm thành công thì set giá trị ở trong tưng input là rỗng

              Swal.fire("Edit post is success!", "", "success");
              //sau khi thêm thành công thì chuyển hướng sang trang categories
              this.$router.push("/posts");
              // message này ở trong data được trả về trong server
            } else {
              console.log("error");
            }
          })
          .catch((error) => {
            // this.errors.push(error.response);
            console.log(error);
          });
      }
    },
    mounted: function () {
      console.log("Edit component form loaded ");
    },
  },
};
</script>

<style>
</style>