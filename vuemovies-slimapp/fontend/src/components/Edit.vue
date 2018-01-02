<template>
  <div class="about container">
      <alert v-if="alert" v-bind:message="alert"></alert>
    <h1 class="page-header">Edit Movie</h1>
    <form v-on:submit="updateMovie">
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
                <textarea class="form-control" placeholder="Movie Description"  rows="3" v-model="movies.description"></textarea>
                
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</template>

<script>
import Alert from './Alert'
export default {
  name: 'edit',
  data () {
    return {

        movies:{},
        alert:''
    }
  },

  methods:{
    fetchData(id){
        this.$http.get('http://slimapp/api/movies/'+id)
      .then(function(response){
        this.movies = response.body;
      });
      },
      updateMovie(e){
          if(!this.movies.movie_name || !this.movies.category || !this.movies.description){
              this.alert = 'Please Fill in all the required details';
          }else{
              let updateMovie = {
                  movie_name: this.movies.movie_name,
                  category: this.movies.category,
                  description: this.movies.description
              }

              this.$http.put('http://slimapp/api/movies/update/'+this.$route.params.id, updateMovie)
              .then(function(response){
                  this.$router.push({path: '/', query: {alert: 'Movie has been updated'}});
              });
              e.preventDefault();
              
          }
          e.preventDefault();
      },


  },        
  created: function(){
      this.fetchData(this.$route.params.id);
  },
    components:{
      Alert
  }
}
</script>
<style scoped>
</style>
