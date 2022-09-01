<template>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <!-- body -->
                    <div class="col-lg-12">
                        <h1 class="page-header"
                            style="text-align:center; color:#2a789b; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;  border-bottom: 1px solid #fff;">
                            ADD POST
                        </h1>
                        <div class="col-xs-11">
                            <form @submit.prevent="addPost" enctype="multipart/form-data">
                                <div class="alert alert-danger mt-4" v-if="errors.length">
                                    <ul class="mb-0">
                                        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label for="title" style="color: black; font-weight: bold;">Title</label>
                                    <input type="text" class="form-control" name="post_title" v-model="post.post_title">
                                </div>

                                <div class="form-group">
                                    <label for="post_image" style="color: black; font-weight: bold;">Image</label>
                                    <br>
                                    <input type="file" name="image" @change="onChange">
                                </div>

                                <div class="form-group">
                                    <label for="category" style="color: black; font-weight: bold;">Category</label>
                                    <!-- <select name="post_category" id="">
                                        <option>ABC</option>
                                    </select> -->
                                    <input type="text" class="form-control" name="post_author"
                                        v-model="post.post_category_options">
                                </div>

                                <div class="form-group">
                                    <label for="category" style="color: black; font-weight: bold;">Status</label>
                                    <!-- <select name="" id="">
                                        <option value=''>Status</option>
                                    </select> -->
                                    <input type="text" class="form-control" name="post_author"
                                        v-model="post.post_status">
                                </div>

                                <div class="form-group">
                                    <label for="title" style="color: black; font-weight: bold;">Author</label>
                                    <input type="text" class="form-control" name="post_author"
                                        v-model="post.post_author">
                                </div>

                                <div class="form-group">
                                    <label for="title" style="color: black; font-weight: bold;">Content</label>
                                    <textarea class="form-control" name="post_content" id="summernote" cols="30"
                                        rows="10" v-model="post.post_content"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title" style="color: black; font-weight: bold;">Tag</label>
                                    <input type="text" class="form-control" name="post_tag" v-model="post.post_tags">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" name="create" value="Thêm bài viết">
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
import axios from 'axios';
import Swal from 'sweetalert2';
export default {
    name: "AddPost",
    data() {
        return {
            post: {
                post_title: "",
                post_image: "",
                post_category_options: "",
                post_status: "",
                post_content: "",
                post_author: "",
                post_tags: ""
            },
            errors: [],
        };
    },
    methods: {
        // async getCategories() {
        //   let url = "http://127.0.0.1:8000/api/categories_all";
        //   await axios.get(url).then(response => {
        //     this.post.post_category_options = response.data.categories;
        //     console.log(this.post.post_category_options);
        //   }).catch(error => {
        //     console.log(error);
        //   });
        // },
        onChange(e) {
            console.log('selected file', e.target.files[0]);
            this.post.post_image = e.target.files[0];
        },
        async addPost() {
            this.errors = [];
            if (!this.post.post_title) {
                this.errors.push("Post title is required");
            }
            if (!this.post.post_image) {
                this.errors.push("Post image is required");
            }
            if (!this.post.post_category_options) {
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
                formData.append("post_category", this.post.post_category_options);
                formData.append("post_content", this.post.post_content);
                formData.append("post_image", this.post.post_image);
                formData.append("post_author", this.post.post_author);
                formData.append("post_tags", this.post.post_tags);
                formData.append("post_status", this.post.post_status);
                let url = "http://127.0.0.1:8000/api/add_post";
                await axios.post(url, formData).then((response) => {
                    console.log(response);

                    // `status` là mã HTTP status trả về từ server
                    if (response.status == 200) {
                        //sau khi thêm thành công thì set giá trị ở trong tưng input là rỗng
                        this.post.post_title = '';
                        this.post.post_image = '';
                        this.post.post_category_options = "",
                        this.post.post_status = "",
                        this.post.post_content = "",
                        this.post.post_author = "",
                        this.post.post_tags = ""
                        Swal.fire(
                            'Add post is success!',
                            '',
                            'success'
                        )
                        //sau khi thêm thành công thì chuyển hướng sang trang home
                        this.$router.push('/posts');
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


    }
}
</script>

<style>
</style>