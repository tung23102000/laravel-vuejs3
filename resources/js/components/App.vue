<template>
    <div id="root-element">
      <Admin_navigation></Admin_navigation>
      <router-view></router-view>
    </div>
  
  </template>
  
  <script>
  
  import Admin_navigation from "./admin/include/Admin_navigation.vue";
  export default {
    name: 'App',
    components: {
      Admin_navigation,
      
      
  }
  }
  </script>
  
  <style scoped>
  /* body {
    margin-top: 100px;
    background-color: #222;
  }
  
  @media (min-width: 768px) {
    body {
      margin-top: 50px;
    }
  }
  
  #wrapper {
    padding-left: 0;
  }
  
  #page-wrapper {
    width: 100%;
    padding: 0;
    height: 100%;
    background-color: #fff;
  }
  
  .huge {
    font-size: 50px;
    line-height: normal;
  }
  
  @media (min-width: 768px) {
    #wrapper {
      padding-left: 225px;
    }
  
    #page-wrapper {
      padding: 10px;
    }
  }
  Custom Colored Panels
  
  .huge {
      font-size: 40px;
  }
  
  .panel-green {
      border-color: #5cb85c;
  }
  
  .panel-green .panel-heading {
      border-color: #5cb85c;
      color: #fff;
      background-color: #5cb85c;
  }
  
  .panel-green a {
      color: #5cb85c;
  }
  
  .panel-green a:hover {
      color: #3d8b3d;
  }
  
  .panel-red {
      border-color: #d9534f;
  }
  
  .panel-red .panel-heading {
      border-color: #d9534f;
      color: #fff;
      background-color: #d9534f;
  }
  
  .panel-red a {
      color: #d9534f;
  }
  
  .panel-red a:hover {
      color: #b52b27;
  }
  
  .panel-yellow {
      border-color: #f0ad4e;
  }
  
  .panel-yellow .panel-heading {
      border-color: #f0ad4e;
      color: #fff;
      background-color: #f0ad4e;
  }
  
  .panel-yellow a {
      color: #f0ad4e;
  }
  
  .panel-yellow a:hover {
      color: #df8a13;
  } */
  </style>
  