<template>
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row">
          <!-- body -->
          <div class="col-lg-12">
            <h1 class="page-header"
              style="text-align:center; color:#2a789b; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;  border-bottom: 1px solid #fff;">
              COMMENTS MANAGEMENT

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

             
            </div>

            <table class="table table-bordered table-hover table-responsive ">
              <thead class="thead-dark">
                <tr>
                  <th class="align-middle text-center align-middle" width="50px" style="vertical-align: middle;">ID</th>
                  <th class="align-middle text-center" style="vertical-align: middle;">Tác giả</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Nội dung</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">In response to</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Ngày</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Comment status</th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Change to approved
                  </th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Change to unapproved
                  </th>
                  <th class="align-middle text-center align-middle" style="vertical-align: middle;">Delete</th>

                </tr>
              </thead>
              <tbody v-for="(comment, index) in comments" :key="comment._id">

                <tr>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{ index + 1 }}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{ comment.comment_user_name  }}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{ comment.comment_content }}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{ comment.comment_post_title }}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;'>{{ comment.created_at }}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;' v-if="status===''">{{ comment.comment_status }}</td>
                  <td class='align-middle text-center' style='vertical-align: middle;' v-else>{{ status }}</td>
                  <td class ='align-middle text-center' style='vertical-align: middle;'><a href='#' @click="changeToApprove(comment._id)">Approve</a></td>
                  <td class ='align-middle text-center' style='vertical-align: middle;'><a href='#' @click="changeToUnapprove(comment._id)">Unapprove</a></td>
                  <td class='align-middle text-center' style='vertical-align: middle;'><a href='#'><button
                        class='btn btn-danger' @click.prevent="deleteComment(comment._id)">Xóa</button></a></td>
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
export default {
  name: "Comments",
  data() {
    return {
      comments: Array,
      posts:[],
      status:"",
      approvedStatus: "Approved",
      unapprovedStatus: "Unapproved",
      search: null
    }
  },
  created(){
    this.getComments();
  },
  mounted(){
//  this.getComments();
  },
  methods:{
    async getComments() {
      let url = "http://127.0.0.1:8000/api/comments_all";
      await axios.get(url).then(response => {
        this.comments = response.data.comments;
        console.log(this.comments);
      }).catch(error => {
        console.log(error);
      });
    }, 
    async deleteComment(id) {
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
    },
   
    async searchData(val){
      if(val!=''){
        let url = `http://127.0.0.1:8000/api/searchComment/${val}`;
      await axios.get(url).then(response => {
        this.comments = response.data;
        console.log(this.comments);
      }).catch(error => {
        console.log(error);
      });
      } 
    
         
    },
    changeToApprove(id){
       this.status = 'Approved';
                let formData = new FormData();
                formData.append("comment_status", this.approvedStatus);
                let url = `http://127.0.0.1:8000/api/update_comment/${id}`;
                 axios
                    .post(url, formData)
                    .then((response) => {
                        console.log(response);

                        // `status` là mã HTTP status trả về từ server
                        if (response.status == 200) {
                            //sau khi thêm thành công thì set giá trị ở trong tưng input là rỗng

                            Swal.fire("Edit comment is success!", "", "success");
                            //sau khi thêm thành công thì chuyển hướng sang trang categories
                             this.$router.push("/comments");
                            // message này ở trong data được trả về trong server
                        } else {
                            console.log("error");
                        }
                    })
                    .catch((error) => {
                        // this.errors.push(error.response);
                        console.log(error);
                    });
            
        
    },
    changeToUnapprove(id){
      this.status = 'Unapproved';
                let formData = new FormData();
                formData.append("comment_status", this.unapprovedStatus);
                let url = `http://127.0.0.1:8000/api/update_comment/${id}`;
                 axios
                    .post(url, formData)
                    .then((response) => {
                        console.log(response);

                        // `status` là mã HTTP status trả về từ server
                        if (response.status == 200) {
                            //sau khi thêm thành công thì set giá trị ở trong tưng input là rỗng

                            Swal.fire("Edit comment is success!", "", "success");
                            //sau khi thêm thành công thì chuyển hướng sang trang categories
                             this.$router.push("/comments");
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
  
  watch: {
    search() {
      // console.log(this.search);
      this.searchData(this.search);
    },
    
  }

}
</script>

<style>
</style>