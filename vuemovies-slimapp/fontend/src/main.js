// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import VueRouter from 'vue-router'
import vueResource from 'vue-resource'
import Movies from './components/Movies'
import About from './components/About'
import Add from './components/Add'
import Edit from './components/Edit'
import MovieDetails from './components/MovieDetails'


Vue.use(vueResource)
Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes:[
    {path:'/', component: Movies},
    {path:'/about', component: About},
    {path:'/add', component: Add},
    {path:'/movie/:id', component: MovieDetails},
    {path:'/edit/:id', component: Edit}
  ]
})
Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  router,
  template: `
        <div id="app">
        <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item btn btn-lg btn-outline-light">
        <router-link to="/">Home</router-link>
      </li>
      <li class="nav-item btn btn-lg btn-outline-success">
      <router-link to="/about">About</router-link>
      </li>
      <li class="nav-item btn btn-lg btn-outline-danger" >
      <router-link to="/add">Add Movie</router-link>
      </li>
    </ul>
  </div>
  </div>
</nav>
      <router-view></router-view>
    </div>
  `
}).$mount('#app')
