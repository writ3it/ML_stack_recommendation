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
                    <div v-if="supported">


                    <v-btn color="success" @click="openForm" v-if="!filled">Wypełnij formularz</v-btn>
                    <div v-if="filled">
                        <v-alert
                                :value="true"
                                type="success"
                        ><h4>Wypełniłeś już formularz!</h4></v-alert>
                    </div>

                    </div>
                    <div v-else>
                        <v-alert :value="true" type="error"><h3>Twoja przeglądarka nie obsługuje <br/>Web Pushes!</h3> Są one niezbędne do działania aplikacji.</v-alert>
                    </div>
                    <p style="text-align:justify">
                        Celem projektu jest prezentacja oraz zastosowanie możliwości SVD. Więcej informacji o&nbsp;aplikacji znajdziesz  <a href="https://github.com/writ3it/ML_stack_recommendation" rel="nofollow" target="_blank">github</a>. O skuteczności raportu decyduje ilość zebranych danych oraz ich różnorodność.
                    </p>
                    <v-alert
                            :value="true"
                            type="warning"
                    >
                        Aby dostarczyć raport potrzebujemy wiedzy, którą możemy przeanalizować. Obecnie serwery są wypełnione tylko w <strong>{{currentState}}</strong>. Dopiero po ich zapełnieniu mogą wziąć się do pracy! Jeżeli chcesz przyspieszyć proces, rozpowszechnij ten formularz.
                    </v-alert>

                </div>

            </v-card-title>

            <v-stepper v-model="step" vertical v-if="intro==false">
                <v-stepper-step step="1" :complete="step>1">
                    <span @click="changeStep(1)" class="selector">Dostarczenie raportu</span>
                </v-stepper-step>
                <v-stepper-content step="1">
                    <div v-if="!isSubscriber">
                    <p>
                        Aby opracować raport aplikacja musi zostać wykorzystana przez wielu użytkowników. Odpowiedzi zostaną przetworzone a następnie wykorzystane do wygenerowania dla Ciebie raprotu.
                        Aplikacja mogłaby przesłać je Tobie na adres e-mail jednakże w trosce o Twoje dane, takie jak adres e-mail aplikacja o nie nie prosi! Aby móc bezpiecznie dostarczyć Tobie raport,
                        musisz zasubskrybować aplikację w swojej przeglądarce. Następnie po wygenerowaniu raportu otrzymasz w niej powiadomienie wraz z informacjami o możliwości jego pobrania!
                    </p>
                    <p><small>Dzięki temu dość ogólne informacje o Tobie zbierane przez aplikację za pomocą tego formularza nie zostaną nawet przypadkowo z Tobą powiązane! Gdyby serwer został zhackowany wystarczy,
                        że w swojej przeglądarce odsubkrybujesz stronę.</small></p>
                    <p>
                        <v-btn color="success" @click="subscribe">Zgadzam się na to!</v-btn>
                    </p>
                    </div>
                    <div v-else>
                        <p>
                            Aby opracować raport aplikacja musi zostać wykorzystana przez wielu użytkowników. Odpowiedzi zostaną przetworzone a następnie wykorzystane do wygenerowania dla Ciebie raprotu.
                            Aplikacja mogłaby przesłać je Tobie na adres e-mail jednakże w trosce o Twoje dane, takie jak adres e-mail aplikacja o nie nie prosi! Aby móc bezpiecznie dostarczyć Tobie raport,
                            zasubskrybowałeś uprzednio aplikację Po wygenerowaniu raportu otrzymasz do swojej przeglądarki instrukcje jak go pobrać!
                        </p>
                        <p><small>Dzięki temu dość ogólne informacje o Tobie zbierane przez aplikację za pomocą tego formularza nie zostaną nawet przypadkowo z Tobą powiązane! Gdyby serwer został zhackowany wystarczy,
                            że w swojej przeglądarce odsubkrybujesz stronę.</small></p>
                        <p>
                            <v-btn color="success" @click="changeStep(2)">Zgadzam się na to!</v-btn>
                        </p>
                    </div>
                </v-stepper-content>
                </v-stepper-step>
                <v-stepper-step step="2" :complete="step>2">
                    <span @click="changeStep(2)" class="selector">Profil</span>
                </v-stepper-step>
                <v-stepper-content step="2">
                    <v-form ref="step_form_2" >
                        <v-layout row wrap>
                            <v-flex xs12 d-flex>
                                <v-select v-model="selected.reviews" :items="data.reviews"
                                          label="Jak często bywasz na rozmowie rekrutacyjnej?" :error-messages="errors.reviews" required :rules="rules.select"></v-select>
                            </v-flex>
                            <v-flex sm12>
                                <v-select v-model="selected.age" :items="data.ages" label="Ile masz lat?" :error-messages="errors.age" required :rules="rules.select"></v-select>
                            </v-flex>
                            <v-flex sm12>
                                <v-btn color="success" @click="changeStep(3)">Przejdź dalej</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-form>
                </v-stepper-content>

                <v-stepper-step step="3" :complete="step>3">
                    <span @click="changeStep(3)" class="selector">Praca</span>
                </v-stepper-step>
                <v-stepper-content step="3">
                    <v-form ref="step_form_3">
                        <v-layout row wrap>
                            <v-flex xs12>
                                <v-autocomplete v-model="selected.country" :items="data.countries"
                                                label="W jakim kraju programujesz?" :error-messages="errors.country" required :rules="rules.select" ></v-autocomplete>
                            </v-flex>
                            <v-flex xs12 v-if="selected.country=='Polska'">
                                <v-autocomplete v-model="selected.district" :items="data.polishDistricts"
                                                label="Gdzie programujesz? (lokalizacja oddziału pracodawcy)" :error-messages="errors.district" :required="selected.country=='Polska'" :rules="rules.select"></v-autocomplete>
                            </v-flex>
                            <v-flex sm12>
                                <v-select v-model="selected.level" :items="data.levels" label="Twoje obecne stanowisko?" :error-messages="errors.level" required :rules="rules.select"  validate-on-blur> </v-select>
                            </v-flex>
                            <v-flex sm12>
                                <v-radio-group v-model="selected.position" label="Twoje stanowisko" :error-messages="errors.position" required :rules="rules.select">
                                    <v-radio
                                            v-for="option in data.positions"
                                            :key="option"
                                            :label="`${option}`"
                                            :value="option"
                                    ></v-radio>
                                </v-radio-group>
                            </v-flex>
                            <v-flex v-if="selected.position=='Inne'" sm12>
                                <v-text-field label="Inne stanowisko - jakie?" v-model="selected.otherPosition" :required="selected.position=='Inne'"></v-text-field>
                            </v-flex>
                            <v-flex>
                                <v-select v-model="selected.salary" :items="data.salaries" label="Zarobki (za etat, netto) / msc" :error-messages="errors.salary" required :rules="rules.select"></v-select>
                            </v-flex>
                            <v-flex sm12>
                                <v-btn color="success" @click="changeStep(4)">Przejdź dalej</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-form>
                </v-stepper-content>
                <v-stepper-step step="4" :complete="step>4">
                    <span @click="changeStep(4)" class="selector">Zwyczaje</span>
                </v-stepper-step>
                <v-stepper-content step="4">
                    <v-form ref="step_form_4" >
                        <v-flex>
                            <v-select v-model="selected.spentTime" :items="data.timesWithComputer" label="Ile czasu dziennie spędzasz przed komputerem?" :error-messages="errors.spentTime"  required :rules="rules.select"></v-select>
                        </v-flex>
                        <!-- <v-flex md12>
                            <v-text-field
                                    label="Github/Bitbucket login" v-model="selected.github"
                            ></v-text-field>
                        </v-flex> -->
                        <v-flex md12>
                            <v-combobox v-model="selected.freeTimeHabits" :items="data.freeTimeHabits" label="Co robisz w wolnym czasie?" chips multiple deletable-chips :error-messages="errors.freeTimeHabits"  required :rules="rules.select"/>
                        </v-flex>
                        <v-flex md12>
                            <v-combobox v-model="selected.activities" :items="data.activities" label="Gdzie udzielasz się poza pracą?" chips multiple deletable-chips :error-messages="errors.activities"  required :rules="rules.select"/>
                        </v-flex>
                        <v-flex sm12>
                            <v-btn color="success" @click="changeStep(5)">Przejdź dalej</v-btn>
                        </v-flex>
                    </v-form>
                </v-stepper-content>
                <v-stepper-step step="5" :complete="step>5">
                    <span @click="changeStep(5)" class="selector">Doświadczenie i edukacja</span>
                </v-stepper-step>
                <v-stepper-content step="5">
                    <v-form ref="step_form_5" >
                        <v-flex>
                            <v-select v-model="selected.articles" :items="data.articles" label="Czytasz artykuły branżowe?" :error-messages="errors.articles"  required :rules="rules.select"></v-select>
                        </v-flex>
                        <v-flex sm12>
                            <v-select v-model="selected.mentor" :items="data.mentor" label="Czy inspirujesz się osobą, która jest Twoim 'mentorem'?" :error-messages="errors.mentor" required :rules="rules.select"></v-select>
                        </v-flex>
                        <v-flex sm12>
                            <v-select v-model="selected.exp" :items="data.jobExperience" label="Doświadczenie niezawodowe (od pierwszego programu do dziś)" :error-messages="errors.exp" required :rules="rules.select"></v-select>
                        </v-flex>
                        <v-flex sm12>
                            <v-select v-model="selected.jobExp" :items="data.jobExperience" label="Doświadczenie zawodowe" :error-messages="errors.jobExp" required :rules="rules.select"></v-select>
                        </v-flex>
                        <v-flex sm12>
                            <v-select v-model="selected.studies" :items="data.studies" label="Studiujesz?" :error-messages="errors.studies" required :rules="rules.select"></v-select>
                        </v-flex>
                        <v-flex sm12>
                            <v-select v-model="selected.schools" :items="data.schools" label="Edukacja 'szkolna'" :error-messages="errors.schools" required :rules="rules.select"></v-select>
                        </v-flex>
                        <v-flex sm12>
                            <v-combobox v-model="selected.otherEdu" :items="data.otherEdu" label="Pozostała edukacja (certyfikaty, książki, kursy itp)" chips multiple deletable-chips :error-messages="errors.otherEdu" />
                        </v-flex>
                        <v-flex sm12>
                            <v-btn color="success" @click="changeStep(6)">Przejdź dalej</v-btn>
                        </v-flex>
                    </v-form>
                </v-stepper-content>

                <v-stepper-step step="6" :complete="step>6">
                    <span @click="changeStep(6)" class="selector">Technologia</span>
                </v-stepper-step>
                <v-stepper-content step="6">
                    <v-form ref="step_form_6" >
                        <v-flex sm12>
                            <v-select v-model="selected.tdd" :items="data.tdd" label="Czy testujesz swój kod?" :error-messages="errors.tdd" required :rules="rules.select"></v-select>
                        </v-flex>
                        <v-flex sm12>
                            <v-combobox v-model="selected.tech" :items="data.tech" label="Które narzędzia/technologie dają Ci chleb?" chips multiple deletable-chips :error-messages="errors.tech" required :rules="rules.select"></v-combobox>
                        </v-flex>
                        <v-flex sm12>
                            <v-combobox v-model="selected.itech" :items="data.tech" label="Które narzędzia/technologie Ciebie interesują?" chips multiple deletable-chips :error-messages="errors.itech" required :rules="rules.select"></v-combobox>
                        </v-flex>
                        <v-flex sm12>
                            <v-btn color="success" @click="changeStep(7)">Przejdź dalej</v-btn>
                        </v-flex>
                    </v-form>
                </v-stepper-content>
                <v-stepper-step step="7" :complete="step>7">
                    <span @click="changeStep(7)" class="selector">Zamów raport</span>
                </v-stepper-step>
                <v-stepper-content step="7">
                    <v-flex sm12>
                        {{ message }} {{errors.token}} {{errors.subscription}}
                    </v-flex>
                    <v-flex sm12>
                        <p>
                            <v-btn color="success" @click="send" large class="fullwidth">Zamów</v-btn>
                        </p>
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
    .fullwidth{
        width:100%;
    }
</style>
<script>
    import apimap from '../api';
    import VueCookies from 'vue-cookies'

    export default {
        name: 'RecommendationForm',
        props: {
            token: String
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
                age: '',
                level: '',
                position: "",
                otherPosition: "",
                salary: '',
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
                email:"",
                reviews:null,
                token:'',
                subscription:null
            },

            rules:{
                email:[
                    v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'To nie jest adres email!'
                ],
                select:[
                    v => !!v || 'To pole jest wymagane.'
                ]
            },
            filled: VueCookies.get('form-filled'),
            data: {},
            errors:{},
            message:'',
            currentState:'',
            supported:false
        }),
        created:function(){
            const that = this;

            this.$http.get(apimap.form_data).then(response=>{
                that.data = response.body;
            });
            this.$http.get(apimap.counter).then(response=>{
                const y = (response.body.count / response.body.limit).toFixed(2).toString()+'%';
                that.currentState= y;
            });
            this.$webpush.RegisterWorker('notification.js').then(function(){
                 that.supported = true;
            })
        },
        computed:{
            isSubscriber:function(){
                return this.$webpush.isSubscriber;
            },
            isWebPushSupported:function(){
                return this.$webpush.IsSupported();
            }
        },
        methods:{
            subscribe:function(){
                let that = this;
                this.$webpush.Subscribe(this.data.serverKey).then(function(){
                    that.changeStep(2);
                }).catch(function () {
                    alert("Musisz zezwolić na powiadomienia, jeżeli chcesz skorzystać z aplikacji!");
                });
            },
            openForm:function(){
                this.$emit('recaptcha-auth');
                this.intro = false;
            },
            send:function(){
                const that = this;
                for (let i = 2; i<=6; i++){
                    const key = 'step_form_'+i;
                    if (!this.$refs[key].validate()) {
                        this.step = i;
                        break;
                    }
                }
                this.selected.token = this.token;
                this.selected.subscription = this.$webpush.Subscription;
                this.$http.post(apimap.create_request,this.selected).then(response=>{
                    that.errors = response.body.errors;
                    if (response.body.has_errors){
                        that.message = 'W formularzu są błędy. Popraw je proszę!';
                        if (response.body.errors.token.length>0){
                            this.$emit('recaptcha-auth');
                        }
                    }
                    if (response.body.success){
                        that.message = 'Twój formularz został zamówiony!'
                        VueCookies.set('form-filled',true);
                        that.intro = true;
                        that.filled = true;
                    }
                })
            },
            changeStep:function(step){
                if (step == 1){
                    return ;
                }
                const key = 'step_form_'+this.step;
                if (! (key in this.$refs)){
                    this.step = step;
                } else {
                    if (this.$refs[key].validate()) {
                        this.step = step;
                    }
                }
            }
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
