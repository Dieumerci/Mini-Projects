<template>
  <div class="movies container">
    <Alert v-if="alert" v-bind:message="alert" style="margin: 10px;"/>
    <h1 class="page-header">Manage Movies</h1>
    <input class="form-control" placeholder="Search for a movie" v-model="filterInput"/>
    <br/>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Movie Name</th>
          <th>Category</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="movies in filterBy(movies, filterInput)">
          <td>{{movies.movie_name}}</td>
          <td>{{movies.category}}</td>
          
          <td><router-link class="btn btn-default" v-bind:to="'/movie/'+movies.id">View</router-link></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import Alert from './Alert';

export default {
  name: 'movies',
  data () {
    return {
      movies:[],
      alert:'',
      filterInput:''
    }
  },

  methods:{
    fetchMovies(){
      this.$http.get('http://slimapp/api/movies')
      .then(function(response){
        this.movies = response.body;
      });
    },
    filterBy(list, value){
      value = value.charAt(0).toUpperCase() + value.slice(1);
      return list.filter(function(movies){
        return movies.movie_name.indexOf(value) > -1;
      })
    }
  },
  created: function(){

    if(this.$route.query.alert){
        this.alert = this.$route.query.alert;
    }
    this.fetchMovies();
  },
    updated: function(){
    this.fetchMovies();
  },
  components:{
    Alert
  }
}
</script>
<style scoped>

</style>


