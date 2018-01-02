<template>
  <div class="details container">
    
    <h3 class="page-header" style="margin-top: 15px;">The Movie Name is: {{movie.movie_name}}</h3>
    <ul class="list-group">
      <li class="list-group-item">
        <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
        {{movie.category}}
      </li>
      <li class="list-group-item">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        {{movie.description}}
      </li>
    </ul>
    <hr/>
    <router-link to="/" class="btn btn-sm btn-outline-primary">back</router-link>
    <router-link  class="btn btn-lg btn-outline-warning" v-bind:to="'/edit/'+movie.id">Update</router-link>
    <span class="pull-right"><button class="btn btn-lg btn-outline-danger" v-on:click="delMovie(movie.id)">Delete</button></span>
  </div>
</template>

<script>
export default {
  name: 'moviedetails',
  data () {
    return {
        movie: ''
    }
  },

  methods: {
      fetchData(id){
        this.$http.get('http://slimapp/api/movies/'+id)
      .then(function(response){
        this.movie = response.body;
      });
      },
      delMovie(id){
        this.$http.delete('http://slimapp/api/movies/delete/'+id)
      .then(function(response){
        this.$router.push({path:'/', query: {alert: 'Movie Deleted'}});
      });
      }
  }, 

  created: function(){
      this.fetchData(this.$route.params.id);
  }
}
</script>

<style>

</style>

