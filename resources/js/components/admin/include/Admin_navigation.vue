<template>
    <div>
   <!-- <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #224b53;">
     <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="#" style="color: #06eeff;">Admin Page</a>
     </div>
     <ul class="nav navbar-right top-nav">

         <li><a href="#"><i class="fa-solid fa-house-chimney"></i> HOME SITE</a></li>
         <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                 <b class="caret"></b>
             </a>
             <ul class="dropdown-menu">
                 <li>
                     <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                 </li>
                 <li>
                     <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                 </li>
                 <li>
                     <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                 </li>
                 <li class="divider"></li>
                 <li>
                     <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                 </li>
             </ul>
         </li>
     </ul>
</nav> -->
     <div class="collapse navbar-collapse navbar-ex1-collapse">
         <ul class="nav navbar-nav side-nav">
             <li>
                 <router-link to="/dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</router-link>
             </li>

             <li>
                 <router-link to="/categories"><i class="fa fa-fw fa-table"></i> Categories</router-link>
             </li>
             <li>
                 <router-link to="/posts"><i class="fa fa-fw fa-edit"></i> Posts</router-link>
             </li>
             <li>
                 <router-link to="/comments"><i class="fa-solid fa-comment" style="margin-right: 3px;"></i> Comments</router-link>
             </li>

             <li>
                 <router-link to="/users"><i class="fa-solid fa-circle-user" style="margin-right: 3px;"></i> Users</router-link>
             </li>

         </ul>
     </div>
 <!-- </nav> -->
</div>
</template>

<script>
export default {
name:"Admin_navigation"
}
</script>

<style scoped> 
/* Top Navigation */
@import "../../../../css/sidebar.css";


</style>