<template>
  <div id="app">
    <RecommendationForm msg="Rekomendacje IT"/>
  </div>
</template>

<script>
import RecommendationForm from './components/RecommendationSystem.vue'

export default {
  name: 'app',
  components: {
    RecommendationForm
  }
}
</script>

<style>
  body{
    background: url(./assets/bg.jpg);
    background-size:cover;
    background-attachment: fixed;
    background-position: center bottom;
  }

</style>
