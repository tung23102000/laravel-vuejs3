<template>
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row">
          <!-- body -->
          <div class="col-lg-12">
            <h1 class="page-header"
              style="text-align:center; color:#2a789b; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;  border-bottom: 1px solid #fff;">
              USERS MANAGEMENT

            </h1>
            <div class="row" style="margin-left: 0; margin-right: 0;">
              <div class="search" style="float: left; margin-right: 50px;">

                <form class="form-inline">
                  <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search..."
                    aria-label="Search" v-model="search">
                  <button class="btn btn-outline-success my-2 my-sm-0 mx-4"><i
                      class="fa-solid fa-magnifying-glass"></i></button>
                </form>
              </div>

              <router-link to="add_user">
                <button class="btn btn-success" style="margin-bottom: 15px; float: right;">Thêm người dùng</button>
              </router-link>
            </div>

            <table class="table table-bordered table-hover table-responsive ">
              <thead class="thead-dark">
                <tr>
                  <th class="align-middle text-center align-middle" width="50px" style="vertical-align: middle;">ID</th>
                  <th class="align-middle text-center" style="vertical-align: middle;">Tác giả</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Email</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Edit</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Delete</th>

                </tr>
              </thead>
              <tbody v-for="(user, index) in users" :key="user._id">

                <tr>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{ index + 1 }}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{ user.name }}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{ user.email }}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>
                    <router-link :to="{ name: 'EditUser', params: { id: user._id } }" class='btn btn-warning'>Sửa
                    </router-link>
                  </td>
                  <td class='align-middle text-center' style='vertical-align: middle;'><a href='#'><button
                        class='btn btn-danger' @click.prevent="deleteUser(user._id)">Xóa</button></a></td>
                </tr>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
export default {
  name: "Users",
  data() {
    return {
      users: Array,
      search: null
    }
  },
  created() {
    this.getUsers();
  },
  mounted() {
  },
  methods: {
    async getUsers() {
      let url = "http://127.0.0.1:8000/api/users_all";
      await axios.get(url).then(response => {
        this.users = response.data.users;
        console.log(this.users);
      }).catch(error => {
        console.log(error);
      });
    },
    async deleteUser(id) {
      Swal.fire({
        title: 'Are you sure want to delete?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2eab54',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        let url = `http://127.0.0.1:8000/api/delete_user/${id}`;
        axios.delete(url).then(response => {
          if (response.data.code == 200) {
            this.getUsers();
          }
        }).catch(error => {
          console.log(error);

        });
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'User has been deleted.',
            'success'
          )
        }
      })
    },

    async searchData(val) {
      if (val != '') {
        let url = `http://127.0.0.1:8000/api/searchUser/${val}`;
        await axios.get(url).then(response => {
          this.users = response.data;
          console.log(this.posts);
        }).catch(error => {
          console.log(error);
        });
      }


    }
  },
  watch: {
    search() {
      // console.log(this.search);
      this.searchData(this.search);
    }
  }
}
</script>

<style>
</style>