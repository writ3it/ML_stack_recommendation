<template>
    <v-flex>
        <v-card>
            <v-img :src="require('../assets/header.jpg')" aspect-ratio="1.75"><h1 class="header">Rekomendacje IT</h1></v-img>
            <v-card-title primary-title  v-if="intro">
                <h3 class="headline mb-0"><i><a href="https://blogs.msdn.microsoft.com/larryosterman/2004/03/30/one-in-a-million-is-next-tuesday/" rel="nofollow" target="_blank" style="text-decoration:none;">One in a million is next Tuesday.</a></i><br/><small>Gordon Letwin (architect for DOS 4)</small></h3>
                <div style="text-align:center">
                    <p style="text-align:justify">
                        Świat IT to żywe "ZOO" technologii XXI wieku. Każdy z&nbsp;nas, programistów, rozpoczyna swoją przygodę w&nbsp;innym środowisku będąc kształtowanym przez kolejne projekty, zespoły oraz potrzeby konsumentów.
                        Aby dać Tobie spojrzenie z lotu ptaka na nasze "ZOO" przygotowałem aplikację wykorzystującą Machine Learning do wytyczania propozycji rozwoju dla Ciebie.
                        Interesują Ciebie lepsze zarobki? Relokacja? Być może planujesz przebudować swój stack. Wypełnij formularz i&nbsp;nzamów darmowy raport!
                    </p>
                    <v-btn color="success" @click="intro=false">Wypełnij formularz</v-btn>
                    <p style="text-align:justify">
                        Celem projektu jest prezentacja oraz zastosowanie możliwości SVD. Więcej informacji o&nbsp;aplikacji znajdziesz  <a href="https://github.com/writ3it/ML_stack_recommendation" rel="nofollow" target="_blank">github</a>. O skuteczności raportu decyduje ilość zebranych danych oraz ich różnorodność.
                    </p>

                </div>

            </v-card-title>
            <v-stepper v-model="step" vertical v-if="intro==false">
                <v-stepper-step step="1" :complete="step>1">
                    <span @click="step = 1" class="selector">Profil</span>
                </v-stepper-step>
                <v-stepper-content step="1">
                    <v-layout row wrap>
                        <v-flex xs12 d-flex>
                            <v-text-field v-model="selected.email"
                                      label="Adres email na który zostanie przesłany raport:"></v-text-field>
                        </v-flex>
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
                        <v-flex>
                            <v-select v-model="selected.sallary" :items="data.sallaries" label="Zarobki (za etat, netto) / msc"></v-select>
                        </v-flex>
                    </v-layout>
                </v-stepper-content>
                <v-stepper-step step="3" :complete="step>3">
                    <span @click="step = 3" class="selector">Zwyczaje</span>
                </v-stepper-step>
                <v-stepper-content step="3">

                    <v-flex>
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
                        <v-combobox v-model="selected.activities" :items="data.activities" label="Gdzie udzielasz się poza pracą?" chips multiple deletable-chips/>
                    </v-flex>
                </v-stepper-content>
                <v-stepper-step step="4" :complete="step>4">
                    <span @click="step = 4" class="selector">Doświadczenie i edukacja</span>
                </v-stepper-step>
                <v-stepper-content step="4">


                        <v-flex>
                            <v-select v-model="selected.articles" :items="data.articles" label="Czytasz artykuły branżowe?"></v-select>
                        </v-flex>
                    <v-flex sm12>
                        <v-select v-model="selected.mentor" :items="data.mentor" label="Czy inspirujesz się osobą, która jest Twoim 'mentorem'?"></v-select>
                    </v-flex>
                    <v-flex sm12>
                        <v-select v-model="selected.exp" :items="data.jobExperience" label="Doświadczenie niezawodowe (od pierwszego programu do dziś)"></v-select>
                    </v-flex>
                    <v-flex sm12>
                        <v-select v-model="selected.jobExp" :items="data.jobExperience" label="Doświadczenie zawodowe"></v-select>
                    </v-flex>
                    <v-flex sm12>
                        <v-select v-model="selected.studies" :items="data.studies" label="Studiujesz?"></v-select>
                    </v-flex>
                    <v-flex sm12>
                        <v-select v-model="selected.schools" :items="data.schools" label="Edukacja 'szkolna'"></v-select>
                    </v-flex>
                    <v-flex sm12>
                        <v-combobox v-model="selected.otherEdu" :items="data.otherEdu" label="Pozostała edukacja (certyfikaty, książki, kursy itp)" chips multiple deletable-chips/>
                    </v-flex>
                </v-stepper-content>

                <v-stepper-step step="5" :complete="step>5">
                    <span @click="step = 5" class="selector">Technologia</span>
                </v-stepper-step>
                <v-stepper-content step="5">
                    <v-flex sm12>
                        <v-select v-model="selected.tdd" :items="data.tdd" label="Czy testujesz swój kod?"></v-select>
                    </v-flex>
                    <v-flex sm12>
                        <v-combobox v-model="selected.tech" :items="data.tech" label="Które narzędzia/technologie dają Ci chleb?" chips multiple deletable-chips></v-combobox>
                    </v-flex>
                    <v-flex sm12>
                        <v-combobox v-model="selected.itech" :items="data.tech" label="Które narzędzia/technologie dają Cię interesują?" chips multiple deletable-chips></v-combobox>
                    </v-flex>
                </v-stepper-content>
                <v-stepper-step step="6" :complete="step>6">
                    <span @click="step = 6" class="selector">Zamów raport</span>
                </v-stepper-step>
                <v-stepper-content step="6">
                    <v-flex sm12>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque libero augue, rhoncus id aliquet vel, efficitur a nisi. Mauris at eros non erat pulvinar mattis. In consequat velit augue, ac cursus felis ullamcorper at. Ut nulla mi, elementum ac ex et, vehicula consectetur tortor. Nulla vel dolor facilisis, dapibus magna a, accumsan massa. Vivamus eget fermentum neque. Integer vitae leo sit amet leo pretium cursus. Donec et turpis et purus euismod egestas. Nulla commodo turpis vel egestas elementum. Ut gravida, massa et sodales dapibus, metus diam fermentum diam, eu faucibus erat mi eu tortor. Vivamus porta tellus eget bibendum dapibus. Quisque vitae purus in dui aliquet malesuada. Curabitur dapibus, nibh et lacinia suscipit, lectus diam ultricies sapien, non luctus nisi libero in sem. Fusce tempus purus eros, at ultrices ipsum sodales sed. Donec et suscipit massa. Curabitur at dui lacus. </p>
                    </v-flex>
                </v-stepper-content>

            </v-stepper>


        </v-card>

    </v-flex>
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
    import apimap from '../api'
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
        http:{
          root:apimap.root
        },
        data: () => ({
            step: 1,
            intro:true,
            selected: {
                country: "Polska",
                district: "",
                age: ages[1],
                level: '',
                position: "",
                otherPosition: "",
                sallary: '',
                spentTime:"",
                github:"",
                freeTimeHabits:[],
                activities:[],
                books:0,
                articles:"",
                mentor:"",
                exp:"",
                jobExp:"",
                studies:"",
                schools:"",
                otherEdu:[],
                tdd:"",
                tech:[],
                itech:[],
                email:""
            },
            data: {},
            ages: ages
        }),
        created:function(){
            var that = this;
            this.$http.get(apimap.form_data).then(response=>{
                that.data = response.body;
            });
        }

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
