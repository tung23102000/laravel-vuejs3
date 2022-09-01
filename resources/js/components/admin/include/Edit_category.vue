<template>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <!-- body -->
                    <div class="col-lg-12">
                        <h1 class="page-header"
                            style="text-align:center; color:#2a789b; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;  border-bottom: 1px solid #fff;">
                            EDIT CATEGORIES

                        </h1>

                        <div class="col-xs-6">
                            <form @submit.prevent="updatedCategory">
                                <label for="cate-title">Edit category</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter the category"
                                        v-model="category.cat_title" />
                                </div>
                                <div class="alert alert-danger mt-4" v-if="errors.length">
                                    <ul class="mb-0">
                                        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Sửa danh mục</button>
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
import Swal from 'sweetalert2';
export default {
    name: "EditCategory",
    data() {
        return {
            category: {
                cat_title: "",
            },
            errors: [],
        }
    },
    created() {
        this.getCategoryById();
    },
    mounted() {

    },
    methods: {
        async getCategoryById() {
            let url = `http://127.0.0.1:8000/api/edit_category/${this.$route.params.id}`;
            await axios.get(url).then((response) => {
                console.log(response);
                this.category = response.data;
            })

        },


        async updatedCategory() {
            this.errors = [];
            if (!this.category.cat_title) {
                this.errors.push("Category title is required");
            }


            if (!this.errors.length) {

                let formData = new FormData();
                formData.append("cat_title", this.category.cat_title);

                let url = `http://127.0.0.1:8000/api/update_category/${this.$route.params.id}`;
                await axios.post(url, formData).then((response) => {
                    console.log(response);

                    // `status` là mã HTTP status trả về từ server
                    if (response.status == 200) {
                        //sau khi thêm thành công thì set giá trị ở trong tưng input là rỗng

                        Swal.fire(
                            'Edit category is success!',
                            '',
                            'success'
                        )
                        //sau khi thêm thành công thì chuyển hướng sang trang categories
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
        mounted: function () {
            console.log("Edit component form loaded ");
        },
    }
}

</script>

<style>
</style>