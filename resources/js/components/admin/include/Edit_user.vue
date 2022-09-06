<template>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <!-- body -->
                    <div class="col-lg-12">
                        <h1 class="page-header"
                            style="text-align:center; color:#2a789b; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;  border-bottom: 1px solid #fff;">
                            EDIT USER
                        </h1>
                        <div class="col-xs-11">
                            <form @submit.prevent="updatedUser" enctype="multipart/form-data">
                                <div class="alert alert-danger mt-4" v-if="errors.length">
                                    <ul class="mb-0">
                                        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label for="title" style="color: black; font-weight: bold;">Name</label>
                                    <input type="text" class="form-control" name="name" v-model="user.name">
                                </div>



                                <div class="form-group">
                                    <label for="title" style="color: black; font-weight: bold;">Email</label>
                                    <input type="email" class="form-control" name="post_author" v-model="user.email">
                                </div>
                                <div class="form-group">
                                    <label for="title" style="color: black; font-weight: bold;">Password</label>
                                    <input type="password" class="form-control" name="post_author"
                                        v-model="user.password">
                                </div>


                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" name="create" value="Sửa người dùng">
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
    name: "EditUser",
    data() {
        return {
            user: {
                name: "",
                email: "",
                password: "",

            },
            errors: [],
        }
    },
    created() {
    },
    mounted() {
        this.getUserById();
    },
    methods: {
        async getUserById() {
      let url = `http://127.0.0.1:8000/api/edit_user/${this.$route.params.id}`;
      await axios.get(url).then((response) => {
        console.log(response);
        this.user = response.data;
      });
    },
        async updatedUser() {
            this.errors = [];
            if (!this.user.name) {
                this.errors.push("Name is required");
            }
            if (!this.user.email) {
                this.errors.push("Email is required");
            }
            if (!this.user.password) {
                this.errors.push("Password is required");
            }
            if (!this.errors.length) {
                let formData = new FormData();
                formData.append("name", this.user.name);
                formData.append("email", this.user.email);
                formData.append("password", this.user.password);
                let url = `http://127.0.0.1:8000/api/update_user/${this.$route.params.id}`;
                await axios
                    .post(url, formData)
                    .then((response) => {
                        console.log(response);

                        // `status` là mã HTTP status trả về từ server
                        if (response.status == 200) {
                            //sau khi thêm thành công thì set giá trị ở trong tưng input là rỗng

                            Swal.fire("Edit user is success!", "", "success");
                            //sau khi thêm thành công thì chuyển hướng sang trang categories
                            this.$router.push("/users");
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
    }

}
</script>

<style>
</style>