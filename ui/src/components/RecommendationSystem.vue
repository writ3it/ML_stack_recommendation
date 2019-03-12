<template>
    <div>
        <v-card>
            <v-img :src="require('../assets/header.jpg')" aspect-ratio="1.75"><h1 class="header">Rekomendacje IT</h1></v-img>

            <v-stepper v-model="step" vertical>
                <v-stepper-step step="1" :complete="step>1">
                    <span @click="step = 1" class="selector">Profil</span>
                </v-stepper-step>
                <v-stepper-content step="1">
                    <v-layout row wrap>

                        <v-flex xs12 d-flex>
                            <v-select v-model="selected.reviews" :items="data.reviews"
                                      label="Jak często bywasz na rozmowie rekrutacyjnej?"></v-select>
                        </v-flex>
                        <v-flex sm12>
                            <v-select v-model="selected.age" :items="ages" label="Ile masz lat?"></v-select>
                        </v-flex>
                    </v-layout>
                </v-stepper-content>

                <v-stepper-step step="2" :complete="step>2">
                    <span @click="step = 2" class="selector">Praca</span>
                </v-stepper-step>
                <v-stepper-content step="2">
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-autocomplete v-model="selected.country" :items="data.countries"
                                            label="W jakim kraju programujesz?"></v-autocomplete>
                        </v-flex>
                        <v-flex xs12>
                            <v-autocomplete v-model="selected.district" :items="data.polishDistricts"
                                            label="Gdzie programujesz? (lokalizacja oddziału pracodawcy)"></v-autocomplete>
                        </v-flex>
                        <v-flex sm12>
                            <v-select v-model="selected.level" :items="data.levels" label="Twoje obecne stanowisko?"></v-select>
                        </v-flex>
                        <v-flex sm12>
                            <v-radio-group v-model="selected.position" label="Twoje stanowisko">
                                <v-radio
                                        v-for="option in data.positions"
                                        :key="option"
                                        :label="`${option}`"
                                        :value="option"
                                ></v-radio>
                            </v-radio-group>
                        </v-flex>
                        <v-flex v-if="selected.position=='Inne'">
                            <v-text-field label="Inne stanowisko - jakie?" v-model="selected.otherPosition"></v-text-field>
                        </v-flex>
                        <v-flex md12 hidden-sm-and-down>
                            <v-slider v-model="sliders.sallary" @change="selected.sallary = data.sallaries[sliders.sallary]" :min="0"
                                      :max="data.sallaries.length-1" :label="selected.sallary" ticks></v-slider>
                        </v-flex>
                        <v-flex md12 hidden-md-and-up>
                            <v-select v-model="selected.sallary" :items="data.sallaries" label="Zarobki (za etat, netto) / msc"></v-select>
                        </v-flex>
                    </v-layout>
                </v-stepper-content>
                <v-stepper-step step="3" :complete="step>3">
                    <span @click="step = 3" class="selector">Zwyczaje</span>
                </v-stepper-step>
                <v-stepper-content step="3">
                    <v-flex md12 hidden-sm-and-down>
                        <label>Ile czasu dziennie spędzasz przed komputerem?</label>
                        <v-slider v-model="sliders.spentTime" @change="selected.spentTime = data.timesWithComputer[sliders.spentTime]" :min="0"
                                  :max="data.timesWithComputer.length-1" :label="selected.spentTime" ticks ></v-slider>
                    </v-flex>
                    <v-flex md12 hidden-md-and-up>
                        <v-select v-model="selected.spentTime" :items="data.timesWithComputer" label="Ile czasu dziennie spędzasz przed komputerem?"></v-select>
                    </v-flex>
                    <v-flex md12>
                        <v-text-field
                                label="Github/Bitbucket login" v-model="selected.github"
                        ></v-text-field>
                    </v-flex>
                    <v-flex md12>
                        <v-combobox v-model="selected.freeTimeHabits" :items="data.freeTimeHabits" label="Co robisz w wolnym czasie?" chips multiple deletable-chips/>
                    </v-flex>
                    <v-flex md12>
                        <v-combobox v-model="selected.activities" :items="data.activities" label="Co udzielasz się poza pracą?" chips multiple deletable-chips/>
                    </v-flex>
                </v-stepper-content>


            </v-stepper>


        </v-card>

    </div>
</template>
<style scoped>
    .selector {
        cursor: pointer;
    }
    .header{
        color:#333;
        text-align:center;
        margin-top:50%;
    }
</style>
<script>
    import * as data from "../data";

    var ages = (function () {
        var output = [];
        for (var i = 20; i < 60; i += 5) {
            output.push(i + " - " + (i + 4) + " lat");
        }
        return output;
    })()
    export default {
        name: 'RecommendationForm',
        props: {
            msg: String
        },
        data: () => ({
            step: 1,
            sliders:{
                age:1,
                level:1,
                sallary:1,
                spentTime:1
            },
            selected: {
                country: "Polska",
                district: "",
                age: ages[1],
                level: data.levels[1],
                position: "",
                otherPosition: "",
                sallary: data.sallaries[1],
                spentTime:"",
                github:"",
                freeTimeHabits:[],
                activities:[]
            },
            data: data,
            ages: ages
        })

    }
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    #main-panel {
        padding: 16px;
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
