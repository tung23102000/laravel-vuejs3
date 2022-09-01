<template>
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row">
          <!-- body -->
          <div class="col-lg-12">
            <h1 class="page-header"
              style="text-align:center; color:#2a789b; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;  border-bottom: 1px solid #fff;">
              POSTS MANAGEMENT

            </h1>
            <div class="row" style="margin-left: 0; margin-right: 0;">
              <div class="search" style="float: left; margin-right: 50px;">

                <form class="form-inline">
                  <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search..."
                    aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0 mx-4"><i
                      class="fa-solid fa-magnifying-glass"></i></button>
                </form>
              </div>

              <router-link to="add_post">
                <button class="btn btn-success" style="margin-bottom: 15px; float: right;">Thêm bài viết</button>
              </router-link>
            </div>

            <table class="table table-bordered table-hover table-responsive ">
              <thead class="thead-dark">
                <tr>
                  <th class="align-middle text-center align-middle" width="50px" style="vertical-align: middle;">ID</th>
                  <th class="align-middle text-center" style="vertical-align: middle;">Tác giả</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Ảnh</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Tiêu đề</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Danh mục</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Ngày</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">View</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Tag</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Post status</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Comment count</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Edit</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Delete</th>

                </tr>
              </thead>
              <tbody v-for="(post,index) in posts" :key="post._id">

                <tr>
                  <td class='align-middle text-center' style='vertical-align: middle;' >{{index+1}}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{post.post_author}}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'><img class='img-responsive' width="102"
                      v-bind:src="post.post_image" alt='image' /></td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{post.post_title}}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{post.post_category}}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{post.created_at}}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'><a href='#'>View post</a></td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{post.post_tags}}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{post.post_status}}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>1</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'><router-link :to="{name: 'EditPost', params:{id: post._id}}" class='btn btn-warning'>Sửa</router-link></td>
                  <td class='align-middle text-center' style='vertical-align: middle;'><a href='#'><button
                        class='btn btn-danger' @click.prevent="deletePost(post._id)">Xóa</button></a></td>
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
  name: "Posts",
  data() {
    return {
      posts: Array,
    }
  },
  created() {
    this.getPosts()
  },
  mounted() {
    // this.getPosts()
  },
  methods: {
    async getPosts() {
      let url = "http://127.0.0.1:8000/api/posts_all";
      await axios.get(url).then(response => {
        this.posts = response.data.posts;
        console.log(this.posts);
      }).catch(error => {
        console.log(error);
      });
    },
    async deletePost(id) {
      Swal.fire({
        title: 'Are you sure want to delete?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2eab54',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        let url = `http://127.0.0.1:8000/api/delete_post/${id}`;
        axios.delete(url).then(response => {
          if (response.data.code == 200) {
            this.getPosts();
          }
        }).catch(error => {
          console.log(error);

        });
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your category has been deleted.',
            'success'
          )
        }
      })
    }
  }
}
</script>

<style>
</style>