import Categories from '../components/admin/Categories.vue';
import Comments from '../components/admin/Comments.vue';
import Posts from '../components/admin/Posts.vue';
import Users from '../components/admin/Users.vue';
import Admin_body from '../components/admin/include/Admin_body.vue';
import EditCategory from '../components/admin/include/Edit_category.vue';
import AddPost from '../components/admin/include/Add_post.vue';
import EditPost from '../components/admin/include/Edit_post.vue';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
 {
        name:'Categories',
        path: '/categories',
        component: Categories
    },
    {
        name:'Comments',
        path: '/comments',
        component: Comments
    },
    {
        name:'Posts',
        path: '/posts',
        component: Posts
    },
    {
        name:'Users',
        path: '/users',
        component: Users
    },
    {
        name:'Admin_body',
        path: '/dashboard',
        component: Admin_body
    },
    {
        name: 'EditCategory',
        path:'/category/edit/:id',
        component: EditCategory
    },
    {
        name: 'AddPost',
        path:'/add_post',
        component: AddPost
    },
    {
        name: 'EditPost',
        path:'/post/edit/:id',
        component: EditPost
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;