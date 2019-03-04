<template>
  <div class="md-layout md-alignment-top-center  md-gutter">

    <div class="md-layout-item md-size-33">
      <md-content class="md-elevation-20"  id="main-panel">
        <h1>Rekomendacje IT</h1>
        <md-steppers md-vertical>
          <md-step id="profile" md-label="Profil osobisty">
            <md-field>
              <label>Jak często bywasz na rozmowie rekrutacyjnej?</label>
              <md-select v-model="selected.reviews">
                <md-option v-for=" option in data.reviews" :value="option">{{ option }}</md-option>
              </md-select>
            </md-field>
          </md-step>
          <md-step id="work" md-label="Praca">
            <md-autocomplete v-model="selected.country" :md-options="data.countries" :md-open-on-focus="false" md-open-on-focus="false">
              <Label>W jakim kraju programujesz?</Label>
            </md-autocomplete>

            <md-autocomplete v-model="selected.district" :md-options="data.polishDistricts" v-if="selected.country == 'Polska'" md-open-on-focus="false">
              <label>Gdzie programujesz? (lokalizacja oddziału pracodawcy)</label>
            </md-autocomplete>

            <md-field>
              <label>Ile masz lat?</label>
              <md-select v-model="selected.age">
                <md-option v-for=" age in ages" :value="age">{{ age }}</md-option>
              </md-select>
            </md-field>

              <label>Określ swój poziom stanowiska:</label>
              <div>

                <md-radio v-model="selected.level" v-for="level in data.levels" :value="level">{{ level }}</md-radio>

              </div>
            <label>Twoje stanowisko:</label>
            <div>
              <md-radio v-model="selected.position" v-for="position in data.positions" :value="position">{{ position }}</md-radio>
            </div>

            <md-field v-if="selected.position == 'Inne'">
              <label>Inne stanowisko - jakie?</label>
              <md-input v-model="selected.otherPosition"></md-input>
            </md-field>

            <md-autocomplete v-model="selected.sallary" :md-options="data.sallaries" md-open-on-focus="false">
              <label>Twoje miesięczne zarobki netto</label>
            </md-autocomplete>

          </md-step>
          <md-step id="experience" md-label="Doświadczenie">

          </md-step>
          <md-step id="education" md-label="Edukacja">

          </md-step>
          <md-step id="stack" md-label="Stack technologiczny">

          </md-step>
          <md-step id="recommendation" md-label="Rekomendacje dla Ciebie!">

          </md-step>
        </md-steppers>

      </md-content>
    </div>

  </div>
</template>

<script>
  import * as data from "../data";
  export default {
  name: 'RecommendationForm',
  props: {
    msg: String
  },
  data:()=>({
    selected:{
      country:"Polska",
      district:null,
      age:null,
      level:null,
      position:null,
      otherPosition:null,
      sallary:null
    },
    data:data,
    ages:(function(){
      var output = [];
      for (var i = 20; i<60; i+=5){
        output.push(i+" - "+(i+4));
      }
      return output;
    })()
  })

}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#main-panel{
  padding:16px;
}

h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
