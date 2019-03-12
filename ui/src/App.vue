<template>
  <v-app dark>

    <v-content>
      <v-container fluid>
        <v-flex xs12 sm8 offset-sm2 md6 offset-md3 lg4 offset-lg4>
          <RecommendationForm msg="Rekomendacje IT"/>
        </v-flex>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import RecommendationForm from './components/RecommendationSystem.vue'

export default {
  name: 'app',
  components: {
    RecommendationForm
  },
  created(){
    document.title='Rekomendacje IT | writ3it'
  }
}
</script>

<style>
  .v-content{
    background: url(./assets/bg.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    border-sizing:border-box;
  }
  html, body{
    width:100%;
    padding:0px;
    margin:0px;
    overflow-x:hidden;
  }

</style>
