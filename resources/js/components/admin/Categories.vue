<template>
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row">
          <!-- body -->
          <div class="col-lg-12">
            <h1 class="page-header"
              style="text-align:center; color:#2a789b; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;  border-bottom: 1px solid #fff;">
              CATEGORIES MANAGEMENT
            </h1>

            <div class="col-xs-6">
              <form @submit.prevent="addCategory">
                <label for="cate-title">Add category</label>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Enter the category" name="cat_title"
                    v-model="category.cat_title" />
                </div>
                <div class="alert alert-danger mt-4" v-if="errors.length">
                  <ul class="mb-0">
                    <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                  </ul>
                </div>
                <div class="form-group">
                  <button class="btn btn-success">Thêm danh mục</button>
                </div>
              </form>
            </div>

            <div class="col-xs-6">
              <table class="table table-striped table-bordered table-hover" id="tableCat">
                <thead>
                  <tr>
                    <th class="align-middle text-center" style="vertical-align: middle">
                      ID
                    </th>
                    <th class="align-middle text-center" style="vertical-align: middle">
                      Category Title
                    </th>
                    <th class="align-middle text-center" style="vertical-align: middle">
                      Edit
                    </th>
                    <th class="align-middle text-center" style="vertical-align: middle">
                      Delete
                    </th>
                  </tr>
                </thead>
                <tbody v-for="(cat, index) in categories" :key="cat._id">
                  <tr>
                    <td class="align-middle text-center" style="vertical-align: middle">
                      {{ index + 1 }}
                    </td>
                    <td class="align-middle text-center" style="vertical-align: middle">
                      {{ cat.cat_title }}
                    </td>
                    <td class="align-middle text-center" style="vertical-align: middle">
                      <router-link :to="{ name: 'EditCategory', params: {id: cat._id} }" class="btn btn-warning ">Sửa</router-link>
                    </td>
                    <td class="align-middle text-center" style="vertical-align: middle">
                      <a href="#"><button class="btn btn-danger"
                          @click.prevent="deleteCategory(cat._id)">Xóa</button></a>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from 'sweetalert2';
export default {
  name: "Categories",
  data() {
    return {
      categories: Array,
      category: {
        cat_title: ""
      },
      errors: []
    };

  },

  created() {
    

  },
  mounted() {
    this.getCategories();
    //console.log('categories component mounted');
  },

  methods: {

    async addCategory() {
      this.errors = [];
      if (!this.category.cat_title) {
        this.errors.push("Category title is required");
      }
      if (!this.errors.length) {
        let formData = new FormData();
        formData.append("cat_title", this.category.cat_title);
        let url = "http://127.0.0.1:8000/api/add_category";
        await axios.post(url, formData).then((response) => {
          console.log(response);

          // `status` là mã HTTP status trả về từ server
          if (response.status == 200) {
            //sau khi thêm thành công thì set giá trị ở trong tưng input là rỗng
            this.category.cat_title = '';
            // alert(response.data.message);
            this.$router.push('/categories');

            // message này ở trong data được trả về trong server
          } else {
            console.log('error');
          }
        }).catch(error => {
          // this.errors.push(error.response);
          console.log(error);
        });
      }

    },
    async getCategories() {
      let url = "http://127.0.0.1:8000/api/categories_all";
      await axios.get(url).then(response => {
        this.categories = response.data.categories;
        console.log(this.categories);
      }).catch(error => {
        console.log(error);
      });
    },
    async deleteCategory(id) {
      Swal.fire({
        title: 'Are you sure want to delete?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2eab54',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        let url = `http://127.0.0.1:8000/api/delete_category/${id}`;
        axios.delete(url).then(response => {
          if (response.data.code == 200) {

            // alert(response.data.message);
            this.getCategories();
          }
        }).catch(error => {
          console.log(error);

        });
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })



    }


  }

};


</script>

<style>
</style>