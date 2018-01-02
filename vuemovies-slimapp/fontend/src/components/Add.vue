<template>
  <div class="about container">
      <alert v-if="alert" v-bind:message="alert"></alert>
    <h1 class="page-header">Add Movie</h1>
    <form v-on:submit="addMovie">
        <div class="well">
            <h4>Get Movie Details</h4>
            <div class="form-group">
                <label>Movie Name:</label>
                <input type="text" class="form-control" placeholder="Movie Name" v-model="movies.movie_name">
            </div>
            <div class="form-group">
                <label>Category:</label>
                <input type="text" class="form-control" placeholder="Movie Category" v-model="movies.category">
            </div>
            <div class="form-group">
                <label>Description:</label>
                <input type="text" class="form-control" placeholder="Movie Description" v-model="movies.description">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
  </div>
</template>

<script>
import Alert from './Alert'
export default {
  name: 'add',
  data () {
    return {

        movies:{},
        alert:''
    }
  },

  methods:{
      addMovie(e){
          if(!this.movies.movie_name || !this.movies.category || !this.movies.description){
              this.alert = 'Please Fill in all the required details';
          }else{
              let newMovie = {
                  movie_name: this.movies.movie_name,
                  category: this.movies.category,
                  description: this.movies.description
              }

              this.$http.post('http://slimapp/api/movies/add', newMovie)
              .then(function(response){
                  this.$router.push({path: '/', query: {alert: 'Movie has been added'}});
              });
              e.preventDefault();
              
          }
          e.preventDefault();
      }
  },
  components:{
      Alert
  }
}
</script>
<style scoped>
</style>
