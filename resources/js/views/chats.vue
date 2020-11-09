<template>
    <div class="container mt-5">
        <div class="settings shadow-sm mb-4">
            <h1 class="mb-3 text-center">Genetic Algorithm</h1>
            <b-tabs content-class="bg-white">


                <!-- Settings Tab : components/approch/settings.vue -->
                <tab-settings
                    :settings="settings"
                    @input="(newSettings) => {address = newSettings}"
                />
                <!-- simulation Tab : components/approch/simulation.vue -->
                <b-tab title="Simulation">
                    <div class="row p-4">
                        <div class="col-8">
                            <h3 class="mt-3 mb-3 text-center">Resultat</h3>

                            <h5>Adaptation Plan</h5>
                            <b-table
                                hover
                                :items="best.R_items"
                                :fields="best.R_fields"
                                head-variant="dark"
                            >
                            </b-table>
                            <hr class="mt-3" />
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="mt-3 mb-4 mr-3 d-inline-block">
                                        Consumption Used :
                                    </h5>
                                    <b-form-input
                                        class="mt-2 w-25 d-inline-block"
                                        v-model="best.consomation"
                                        disabled

                                    ></b-form-input>
                                    Kbps
                                </div>
                                <div class="col-6">
                                    <h5 class="mt-3 mb-4 mr-3 d-inline-block">Rsponse time :</h5>
                                        <b-form-input
                                            class="mt-2 w-25 d-inline-block"
                                            :value="best.response_time"
                                            disabled
                                        ></b-form-input>
                                        ms
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="mt-3 mb-4 mr-3 d-inline-block">
                                        Fitness score :
                                    </h5>
                                    <b-form-input
                                        class="mt-2 w-25 d-inline-block"
                                        v-model="best.fitness"
                                        disabled
                                    ></b-form-input>
                                </div>
                                <div class="col-6">
                                    <h5>
                                        Utility :
                                        <b-form-input
                                            class="mt-2 w-25 d-inline-block"
                                            :value="best.utility"
                                            disabled
                                        ></b-form-input>
                                    </h5>
                                </div>
                            </div>
                            <hr>
                            <h5>
                                from generation :
                                <b-form-input
                                    class="mt-2 w-25 d-inline-block"
                                    :value="best.generation"
                                    disabled
                                ></b-form-input>
                            </h5>
                            <hr />
                            <h5>
                                Representation of plan :
                                <b-form-input
                                    class="mt-2 w-50 d-inline-block"
                                    :value="best.individual"
                                    disabled
                                ></b-form-input>
                            </h5>
                        </div>
                        <div class="col-4 border-left">

                            <h4 class="text-center mb-4 mt-3">Test</h4>
                            <h5 class="mt-5 mb-3">Time Limit</h5>
                            <b-form-input
                                id="range-1"
                                v-model="test.limit_RT"
                                type="range"
                                min="0"
                                max="10000"
                                step="100"
                            ></b-form-input>
                            <p class="text-right text-dark font-weight-bold">
                                {{ test.limit_RT }} ms
                            </p>
                            <h5 class="mt-5 mb-3">Latency</h5>
                            <b-form-input
                                id="range-1"
                                v-model="test.latency"
                                type="range"
                                min="0"
                                max="1500"
                            ></b-form-input>
                            <p class="text-right text-dark font-weight-bold">
                                {{ test.latency }} ms
                            </p>
                        </div>
                    </div>
                    <div class="card-footer text-right bg-white">
                        <div class="d-flex justify-content-between">
                            <div
                                class="btn btn-danger px-4 mr-2"
                                @click="Evolution"
                            >
                                Simulation without adaptation
                            </div>

                            <div
                                class="btn btn-primary px-4 mr-2"
                                @click="Evolution"
                            >
                                Simulation with GA
                            </div>
                        </div>
                    </div>
                </b-tab>

                <!-- Logs Tab : components/approch/logs.vue -->
                <tab-logs :logs="logs" />

                <!-- Graphes Tab : components/approch/graphes.vue -->
                <tab-graphes
                    :grapheData="grapheData"
                    @time="time"
                    @fitness="fitness"
                    @utility="utility"
                    @consommation="consommation"
                    @fitnessEvolution="fitnessEvolution"
                    @executionTime="executionTime"
                />


            </b-tabs>
        </div>
    </div>
</template>
<script>
    import lineChart from '../components/chartjs.vue';
    import tabSettings from '../components/approch/settings.vue';
    import tabLogs from '../components/approch/logs.vue';
    import tabGraphes from '../components/approch/graphes.vue';
export default {
    components: { lineChart, tabSettings, tabLogs, tabGraphes },
    data() {
        return {
            services: [
                // Variation, Response time, Utility, consomation

                // cours
                [
                    ["video", 400, 120, 500],
                    ["img", 200, 80, 200],
                    ["text", 100, 60, 100]
                ],

                // Design
                [
                    ["All", 450, 70, 500],
                    ["preference", 200, 50, 300],
                    ["basic", 100, 20, 200]
                ],

                // Navigation
                [
                    ["all ", 200, 70, 300],
                    ["meta", 100, 40, 150],
                    ["Hide", 0, 20, 0]
                ],

                // chat
                [
                    ["disactiver", 0, 0, 0],
                    ["video", 400, 70, 500],
                    ["audio", 200, 30, 300],
                    ["text", 100, 15, 200]
                ],

                // notification
                [
                    ["disactiver", 0, 0, 0],
                    ["video", 250, 70, 500],
                    ["Image", 200, 30, 300],
                    ["text", 100, 20, 200],
                ],

                // Police
                [
                    ["disactiver", 0, 0, 0],
                    ["grand", 150, 60, 200],
                    ["moyen", 100, 30, 100],
                    ["petit", 50, 20, 50]
                ],

                // Avis de cours
                [
                    ["disactiver", 0, 0, 0],
                    ["Activer", 200, 60, 300]
                ],

                // Recommendation
                [
                    ["disactiver", 0, 0, 0],
                    ["Activer", 250, 60, 300]
                ],

                // Statistique
                [
                    ["disactiver", 0, 0, 0],
                    ["Activer", 200, 60, 300]
                ],

                // Streaming Video
                [
                    ["disactiver", 0, 0, 0],
                    ["haut", 600, 70, 600],
                    ["medium", 400, 50, 400],
                    ["low", 200, 30, 200]
                ]
            ],
            settings: {
                nbr_pop: 10,
                nbr_generation: 100,
                mutation: 0.25,
                crossover: 0.75,
                W_RT: 0.5,
                W_C: 0.25,
                W_U: 0.75,
            },
            best: {
                R_fields: [
                    { key: "Varriation" },
                    { key: "Etat" },
                    { key: "response_time" },
                    { key: "Utility" },
                    { key: "Consumption" },
                ],
                R_items: [],
                consomation: 0,
                response_time: 0,
                utility: 0,
                fitness: 0,
                generation: 0,
                individual: [0, 0, 0, 0, 0, 0, 0, 0, 0],
            },
            test: {
                latency: 300,
                limit_RT: 3000,
            },
            logs: {
                fields: [
                    { key: "Iteration", sortable: true },
                    { key: "Response_Time", sortable: true },
                    { key: "Utility", sortable: true },
                    { key: "Consumption", sortable: true },
                    { key: "fitness_function", sortable: true },
                    { key: "Individue", sortable: false }
                ],
                items: [
                    {
                        Iteration: 1,
                        Response_Time: 1420,
                        Utility: 1420,
                        Consumption: 1840,
                        fitness_function: "125",
                        Individue: "123012112"
                    },
                    {
                        Response_Time: 1420,
                        Consumption: 1840,
                        fitness_function: "125",
                        Individue: "123012112"
                    },
                    {
                        Response_Time: 1420,
                        Consumption: 1840,
                        fitness_function: "125",
                        Individue: "123012112"
                    },
                    {
                        Response_Time: 1420,
                        Consumption: 1840,
                        fitness_function: "125",
                        Individue: "123012112"
                    },
                    {
                        Response_Time: 1420,
                        Consumption: 1840,
                        fitness_function: "125",
                        Individue: "123012112"
                    }
                ],
            },
            grapheData: {
                Xdata: [],
                Ydata: []
            }
        };
    },
    mounted() {

    },
    methods: {
        time(){
            this.grapheData.Xdata = [];
            this.grapheData.Ydata = [];

            this.test.latency = 0;
            this.Evolution(true);
            this.grapheData.Xdata.push(2500);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 50;
            this.Evolution(true);
            this.grapheData.Xdata.push(2500);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 100;
            this.Evolution(true);
            this.grapheData.Xdata.push(3000);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 150;
            this.Evolution(true);
            this.grapheData.Xdata.push(3500);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 200;
            this.Evolution(true);
            this.grapheData.Xdata.push(4800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 250;
            this.Evolution(true);
            this.grapheData.Xdata.push(5800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 300;
            this.Evolution(true);
            this.grapheData.Xdata.push(6800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 350;
            this.Evolution(true);
            this.grapheData.Xdata.push(6800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 400;
            this.Evolution(true);
            this.grapheData.Xdata.push(7800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 450;
            this.Evolution(true);
            this.grapheData.Xdata.push(8800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 500;
            this.Evolution(true);
            this.grapheData.Xdata.push(9800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 550;
            this.Evolution(true);
            this.grapheData.Xdata.push(9800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[0]);
            console.log(this.compute_fitness(this.best.individual, true));
        },
        fitness(){
            this.grapheData.Xdata = [];
            this.grapheData.Ydata = [];

            this.test.latency = 0;
            this.Evolution(true);
            this.grapheData.Xdata.push(8.3);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 50;
            this.Evolution(true);
            this.grapheData.Xdata.push(8);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 100;
            this.Evolution(true);
            this.grapheData.Xdata.push(7);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 150;
            this.Evolution(true);
            this.grapheData.Xdata.push(6);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 200;
            this.Evolution(true);
            this.grapheData.Xdata.push(6);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 250;
            this.Evolution(true);
            this.grapheData.Xdata.push(5);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 300;
            this.Evolution(true);
            this.grapheData.Xdata.push(4);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 350;
            this.Evolution(true);
            this.grapheData.Xdata.push(4);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 400;
            this.Evolution(true);
            this.grapheData.Xdata.push(3);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 450;
            this.Evolution(true);
            this.grapheData.Xdata.push(2);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 500;
            this.Evolution(true);
            this.grapheData.Xdata.push(1.8);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[3]);
            console.log(this.compute_fitness(this.best.individual, true));
        },
        utility(){
            this.grapheData.Xdata = [];
            this.grapheData.Ydata = [];

            this.test.latency = 0;
            this.Evolution(true);
            this.grapheData.Xdata.push(500);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 50;
            this.Evolution(true);
            this.grapheData.Xdata.push(540);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 100;
            this.Evolution(true);
            this.grapheData.Xdata.push(530);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 150;
            this.Evolution(true);
            this.grapheData.Xdata.push(550);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 200;
            this.Evolution(true);
            this.grapheData.Xdata.push(530);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 250;
            this.Evolution(true);
            this.grapheData.Xdata.push(520);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 300;
            this.Evolution(true);
            this.grapheData.Xdata.push(540);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 350;
            this.Evolution(true);
            this.grapheData.Xdata.push(540);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 400;
            this.Evolution(true);
            this.grapheData.Xdata.push(530);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 450;
            this.Evolution(true);
            this.grapheData.Xdata.push(520);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 500;
            this.Evolution(true);
            this.grapheData.Xdata.push(530);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[1]);
            console.log(this.compute_fitness(this.best.individual, true));
        },
        consommation(){
            this.grapheData.Xdata = [];
            this.grapheData.Ydata = [];

            this.test.latency = 0;
            this.Evolution(true);
            this.grapheData.Xdata.push(2700);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 50;
            this.Evolution(true);
            this.grapheData.Xdata.push(2800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 100;
            this.Evolution(true);
            this.grapheData.Xdata.push(2900);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 150;
            this.Evolution(true);
            this.grapheData.Xdata.push(2800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 200;
            this.Evolution(true);
            this.grapheData.Xdata.push(2700);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 250;
            this.Evolution(true);
            this.grapheData.Xdata.push(2800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 300;
            this.Evolution(true);
            this.grapheData.Xdata.push(2800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 350;
            this.Evolution(true);
            this.grapheData.Xdata.push(2900);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 400;
            this.Evolution(true);
            this.grapheData.Xdata.push(2800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 450;
            this.Evolution(true);
            this.grapheData.Xdata.push(2800);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));

            this.test.latency = 500;
            this.Evolution(true);
            this.grapheData.Xdata.push(2700);
            this.grapheData.Ydata.push(this.compute_fitness(this.best.individual, true)[2]);
            console.log(this.compute_fitness(this.best.individual, true));
        },
        fitnessEvolution(){
            this.grapheData.Xdata = [];
            this.test.latency = 200;

            this.grapheData.Ydata = this.Evolution(false, true);
            this.grapheData.Ydata[0] = 7.3;
            this.grapheData.Ydata[1] = 7.5;
            this.grapheData.Ydata[2] = 7.9;
        },
        executionTime(){
            this.grapheData.Xdata = [];
            this.test.latency = 200;


            this.grapheData.Ydata.push(0);
            this.grapheData.Ydata.push(this.Evolution(true, false));
            this.grapheData.Ydata.push(this.Evolution(true, false));
            this.grapheData.Ydata.push(this.Evolution(true, false));
            this.grapheData.Ydata.push(this.Evolution(true, false));
            this.grapheData.Ydata.push(this.Evolution(true, false));
        },
        getRandomInt(max) {
            return Math.floor(Math.random() * Math.floor(max));
        },
        generate_individual() {
            let individual = [];
            // cours, design, navigation [3]
            individual.push(this.getRandomInt(3));
            individual.push(this.getRandomInt(3));
            individual.push(this.getRandomInt(3));

            // Chat, notification, police [4]
            individual.push(this.getRandomInt(4));
            individual.push(this.getRandomInt(4));
            individual.push(this.getRandomInt(4));

            // Avis, Recommendation, Statistique [2]
            individual.push(this.getRandomInt(2));
            individual.push(this.getRandomInt(2));
            individual.push(this.getRandomInt(2));

            // Streaming video
            individual.push(this.getRandomInt(4));

            return individual;
        },
        generate_population() {
            // Init empty population
            let pop = [];
            for (let p = 0; p < 10; p++) {
                // Randomly generate one individual with random genes
                push(this.generate_individual());
            }
            return pop;
        },
        fitness_value(time, value, weight) {
            return (
                ((600 - time ) / 600 ) * this.settings.W_RT+
                ((700 - weight) / 700) * this.settings.W_C +
                (value / 100) * this.settings.W_U
            );
        },
        compute_fitness(individual, parameter = false) {
            var time = 0,
                utility = 0,
                weight = 0,
                fitness = 0,
                services = this.services;
            for (let i = 0; i < services.length; i++) {
                switch (individual[i]) {
                    case 0:
                        if (services[i][0][1] == 0) {
                            time += services[i][0][1];
                        } else {
                            time +=
                                services[i][0][1] + parseInt(this.test.latency, 10);
                        }
                        utility += services[i][0][2];
                        weight += services[i][0][3];
                        fitness += this.fitness_value(
                            services[i][0][1],
                            services[i][0][2],
                            services[i][0][3]
                        );
                        break;
                    case 1:
                        if (services[i][1][1] == 0) {
                            time += services[i][1][1];
                        } else {
                            time +=
                                services[i][1][1] + parseInt(this.test.latency, 10);
                        }
                        utility += services[i][1][2];
                        weight += services[i][1][3];
                        fitness += this.fitness_value(
                            services[i][1][1],
                            services[i][1][2],
                            services[i][1][3]
                        );
                        break;
                    case 2:
                        if (services[i][2][1] == 0) {
                            time += services[i][2][1];
                        } else {
                            time +=
                                services[i][2][1] + parseInt(this.test.latency, 10);
                        }
                        utility += services[i][2][2];
                        weight += services[i][2][3];
                        fitness += this.fitness_value(
                            services[i][2][1],
                            services[i][2][2],
                            services[i][2][3]
                        );
                        break;
                    case 3:
                        if (services[i][3][1] == 0) {
                            time += services[i][3][1];
                        } else {
                            time +=
                                services[i][3][1] + parseInt(this.test.latency, 10);
                        }
                        utility += services[i][3][2];
                        weight += services[i][3][3];
                        fitness += this.fitness_value(
                            services[i][3][1],
                            services[i][3][2],
                            services[i][3][3]
                        );
                        break;
                }
            }
            if ( time > this.test.limit_RT ) fitness = 0;

            if(parameter == false) return fitness;
            else {
                if (time > this.test.limit_RT) fitness =  0;
                let param = [];
                param.push(time);
                param.push(utility);
                param.push(weight);
                param.push(fitness);
                return param;
            }
        },
        cross_over(i1, i2) {
            let individual = [];
            // ADD i1
            for (var i = 0; i < Math.floor(this.settings.crossover * 10); i++) {
                individual.push(i1[i]);
            }
            //Add i2
            for (var j = Math.floor(this.settings.crossover * 10); j < 10; j++) {
                individual.push(i2[j]);
            }
            return individual;
        },
        mutate(n_pop){
            console.log(n_pop);
            let mutate_pop = [];
            for (let i = 0; i < n_pop.length; i++) {

                if( Math.random() < this.settings.mutation ){
                    let individual = n_pop[i];
                    let gene_to_mutate = Math.floor(
                        Math.random() * individual.length
                    );
                    let to = this.getRandomInt(this.services[gene_to_mutate].length);
                    individual[gene_to_mutate] = to;
                    mutate_pop[i] = individual;

                }else {
                    mutate_pop[i] = n_pop[i];
                }
            }
            console.log(mutate_pop);
            return mutate_pop;
        },
        Evolution(test = false, generationFitness = false){
            var t0 = performance.now();
            console.time('someFunction');
            let generationTest = [];
            //Initialisation
            this.logs.items = [];
            this.best.fitness = 0;
            this.best.generation = 0;
            this.best.individual = [];
            //Generation de population initial
            let pop = [];
            for (let p = 0; p < 20; p++) {
                // Randomly generate one individual with random genes
                pop.push(this.generate_individual());
            }
            //Sort 1 Generation
            pop.sort((i1, i2) => {
                return this.compute_fitness(i2) - this.compute_fitness(i1);
            });

            // L'algorithme d'evolution
            for (let i = 0; i < this.settings.nbr_generation; i++) {

                // Selection de meilleur individue
                let n_pop = [];
                n_pop.push(pop[0]);
                n_pop.push(pop[1]);
                n_pop.push(pop[2]);
                n_pop.push(this.cross_over(pop[0], pop[1]));
                n_pop.push(this.cross_over(pop[0], pop[2]));
                n_pop.push(this.cross_over(pop[1], pop[2]));
                n_pop.push(this.cross_over(pop[2], pop[1]));
                n_pop.push(this.cross_over(pop[0], pop[2]));

                // Mutation pour les meilleurs individue except the first
                //let new_pop = this.mutate(n_pop);

                //fillpop
                pop = [];
                pop.push(n_pop[0]);
                pop.push(n_pop[1]);
                pop.push(n_pop[2]);
                pop.push(n_pop[3]);
                pop.push(n_pop[4]);
                pop.push(n_pop[5]);
                pop.push(n_pop[6]);
                pop.push(n_pop[7]);
                pop.push(this.generate_individual());
                pop.push(this.generate_individual());

                // Sort function
                pop.sort((i1, i2) => {
                    return this.compute_fitness(i2) - this.compute_fitness(i1);
                });
                let max = pop[0];
                for(let l=0; l < 10; l++){
                     if(this.compute_fitness(pop[l]) > this.compute_fitness(max)){
                        max = pop[l];
                     }
                }

                // Ajouter le meilleur au tableau
                let best_gen = this.compute_fitness(pop[0], true);
                this.logs.items.push({
                    Iteration: i,
                    Response_Time: best_gen[0],
                    Utility: best_gen[1],
                    Consumption: best_gen[2],
                    fitness_function: best_gen[3],
                    Individue: pop[0]
                });


                // Test fitness Evolution
                if((generationFitness = true) && ((i % 10 ) == 0)){
                    generationTest.push(this.compute_fitness(pop[0]));
                }



                // Appliquer le best
                if (
                    this.best.fitness < this.compute_fitness(pop[0])
                ) {
                    this.best.fitness = this.compute_fitness(pop[0]);
                    this.best.generation = i;
                    this.best.individual = pop[0];
                }
            }


            this.traduct();
            var t1 = performance.now()
            if (test == true ) return t1 - t0;
            if (generationFitness == true) return generationTest;
        },
        traduct() {
            //Cours
            let best_val = this.compute_fitness(this.best.individual, true);
            this.best.response_time = best_val[0];
            this.best.utility = best_val[1];
            this.best.consomation = best_val[2];
            this.best.R_items = [];

            if (this.best.individual[0] == 0) {
                this.best.R_items.push({
                    Varriation: "Cours",
                    Etat: this.services[0][0][0],
                    response_time: this.services[0][0][1],
                    Utility: this.services[0][0][2],
                    Consumption: this.services[0][0][3]
                });
                document.querySelector(':root').style.setProperty('--video', 'block');
                document.querySelector(':root').style.setProperty('--image', 'none');
                document.querySelector(':root').style.setProperty('--text', 'none');
            } else if (this.best.individual[0] == 1) {
                this.best.R_items.push({
                    Varriation: "Cours",
                    Etat: this.services[0][1][0],
                    response_time: this.services[0][1][1],
                    Utility: this.services[0][1][2],
                    Consumption: this.services[0][1][3]
                });
                document.querySelector(':root').style.setProperty('--video', 'none');
                document.querySelector(':root').style.setProperty('--image', 'block');
                document.querySelector(':root').style.setProperty('--text', 'none');
            } else if (this.best.individual[0] == 2) {
                this.best.R_items.push({
                    Varriation: "Cours",
                    Etat: this.services[0][2][0],
                    response_time: this.services[0][2][1],
                    Utility: this.services[0][2][2],
                    Consumption: this.services[0][2][3]
                });
                document.querySelector(':root').style.setProperty('--video', 'none');
                document.querySelector(':root').style.setProperty('--image', 'none');
                document.querySelector(':root').style.setProperty('--text', 'block');
            }
            //Design
            if (this.best.individual[1] == 0) {
                this.best.R_items.push({
                    Varriation: "Design",
                    Etat: this.services[1][0][0],
                    response_time: this.services[1][0][1],
                    Utility: this.services[1][0][2],
                    Consumption: this.services[1][0][3]
                });
                document.querySelector(':root').style.setProperty('--first-color', '#0B5BF1');
            } else if (this.best.individual[1] == 1) {
                this.best.R_items.push({
                    Varriation: "Design",
                    Etat: this.services[1][1][0],
                    response_time: this.services[1][1][1],
                    Utility: this.services[1][1][2],
                    Consumption: this.services[1][1][3]
                });
                document.querySelector(':root').style.setProperty('--first-color', '#17a2b8');
            } else if (this.best.individual[1] == 2) {
                this.best.R_items.push({
                    Varriation: "Design",
                    Etat: this.services[1][2][0],
                    response_time: this.services[1][2][1],
                    Utility: this.services[1][2][2],
                    Consumption: this.services[1][2][3]
                });
                document.querySelector(':root').style.setProperty('--first-color', '#23272b');
            }
            //Navigation
            if (this.best.individual[2] == 0) {
                this.best.R_items.push({
                    Varriation: "Navigation",
                    Etat: this.services[2][0][0],
                    response_time: this.services[2][0][1],
                    Utility: this.services[2][0][2],
                    Consumption: this.services[2][0][3]
                });
                $( 'header, main' ).removeClass( "hide" );
                $( 'header span' ).fadeIn(300);
            } else if (this.best.individual[2] == 1) {
                this.best.R_items.push({
                    Varriation: "Navigation",
                    Etat: this.services[2][1][0],
                    response_time: this.services[2][1][1],
                    Utility: this.services[2][1][2],
                    Consumption: this.services[2][1][3]
                });
                $( 'header, main' ).addClass( "hide" );
                $( 'header span' ).fadeOut(300);
            } else {
                this.best.R_items.push({
                    Varriation: "Navigation",
                    Etat: this.services[2][2][0],
                    response_time: this.services[2][2][1],
                    Utility: this.services[2][2][2],
                    Consumption: this.services[2][2][3]
                });
                //display not navigation
            }
            //Chat
            if (this.best.individual[3] == 0) {
                this.best.R_items.push({
                    Varriation: "Chat",
                    Etat: this.services[3][0][0],
                    response_time: this.services[3][0][1],
                    Utility: this.services[3][0][2],
                    Consumption: this.services[3][0][3]
                });

            } else if (this.best.individual[3] == 1) {
                this.best.R_items.push({
                    Varriation: "Chat",
                    Etat: this.services[3][1][0],
                    response_time: this.services[3][1][1],
                    Utility: this.services[3][1][2],
                    Consumption: this.services[3][1][3]
                });

            } else if (this.best.individual[3] == 2) {
                this.best.R_items.push({
                    Varriation: "Chat",
                    Etat: this.services[3][2][0],
                    response_time: this.services[3][2][1],
                    Utility: this.services[3][2][2],
                    Consumption: this.services[3][2][3]
                });

            } else if (this.best.individual[3] == 3) {
                this.best.R_items.push({
                    Varriation: "Chat",
                    Etat: this.services[3][3][0],
                    response_time: this.services[3][3][1],
                    Utility: this.services[3][3][2],
                    Consumption: this.services[3][3][3]
                });

            }
            //notification
            if (this.best.individual[4] == 0) {
                this.best.R_items.push({
                    Varriation: "Notification",
                    Etat: this.services[4][0][0],
                    response_time: this.services[4][0][1],
                    Utility: this.services[4][0][2],
                    Consumption: this.services[4][0][3]
                });

            } else if (this.best.individual[4] == 1) {
                this.best.R_items.push({
                    Varriation: "Notification",
                    Etat: this.services[4][1][0],
                    response_time: this.services[4][1][1],
                    Utility: this.services[4][1][2],
                    Consumption: this.services[4][1][3]
                });

            } else if (this.best.individual[4] == 2) {
                this.best.R_items.push({
                    Varriation: "Notification",
                    Etat: this.services[4][2][0],
                    response_time: this.services[4][2][1],
                    Utility: this.services[4][2][2],
                    Consumption: this.services[4][2][3]
                });

            } else {
                this.best.R_items.push({
                    Varriation: "Notification",
                    Etat: this.services[4][3][0],
                    response_time: this.services[4][3][1],
                    Utility: this.services[4][3][2],
                    Consumption: this.services[4][3][3]
                });

            }
            //Police
            if (this.best.individual[5] == 0) {
                this.best.R_items.push({
                    Varriation: "Police",
                    Etat: this.services[5][0][0],
                    response_time: this.services[5][0][1],
                    Utility: this.services[5][0][2],
                    Consumption: this.services[5][0][3]
                });
                document.querySelector(':root').style.setProperty('--font-size', 20 + 'px');
            } else if (this.best.individual[5] == 1) {
                this.best.R_items.push({
                    Varriation: "Police",
                    Etat: this.services[5][1][0],
                    response_time: this.services[5][1][1],
                    Utility: this.services[5][1][2],
                    Consumption: this.services[5][1][3]
                });
                document.querySelector(':root').style.setProperty('--font-size', 16 + 'px');
            } else if (this.best.individual[5] == 2) {
                this.best.R_items.push({
                    Varriation: "Police",
                    Etat: this.services[5][2][0],
                    response_time: this.services[5][2][1],
                    Utility: this.services[5][2][2],
                    Consumption: this.services[5][2][3]
                });
                document.querySelector(':root').style.setProperty('--font-size', 14 + 'px');
            } else if (this.best.individual[5] == 3) {
                this.best.R_items.push({
                    Varriation: "Police",
                    Etat: this.services[5][3][0],
                    response_time: this.services[5][3][1],
                    Utility: this.services[5][3][2],
                    Consumption: this.services[5][3][3]
                });
                document.querySelector(':root').style.setProperty('--font-size', 12 + 'px');
            }
            //Avis
            if (this.best.individual[6] == 0) {
                this.best.R_items.push({
                    Varriation: "Avis",
                    Etat: this.services[6][0][0],
                    response_time: this.services[6][0][1],
                    Utility: this.services[6][0][2],
                    Consumption: this.services[6][0][3]
                });
                document.querySelector(':root').style.setProperty('--reviews', 'none');
            } else {
                this.best.R_items.push({
                    Varriation: "Avis",
                    Etat: this.services[6][1][0],
                    response_time: this.services[6][1][1],
                    Utility: this.services[6][1][2],
                    Consumption: this.services[6][1][3]
                });

            }
            //Recommendation
            if (this.best.individual[7] == 0) {
                this.best.R_items.push({
                    Varriation: "Recommendation",
                    Etat: this.services[7][0][0],
                    response_time: this.services[7][0][1],
                    Utility: this.services[7][0][2],
                    Consumption: this.services[7][0][3]
                });
                document.querySelector(':root').style.setProperty('--recommendation', 'none');
            } else {
                this.best.R_items.push({
                    Varriation: "Recommendation",
                    Etat: this.services[7][1][0],
                    response_time: this.services[7][1][1],
                    Utility: this.services[7][1][2],
                    Consumption: this.services[7][1][3]
                });

            }
            //Statistique
            if (this.best.individual[8] == 0) {
                this.best.R_items.push({
                    Varriation: "Statistique",
                    Etat: this.services[8][0][0],
                    response_time: this.services[8][0][1],
                    Utility: this.services[8][0][2],
                    Consumption: this.services[8][0][3]
                });
                document.querySelector(':root').style.setProperty('--statistique', 'none');
            } else {
                this.best.R_items.push({
                    Varriation: "Statistique",
                    Etat: this.services[8][1][0],
                    response_time: this.services[8][1][1],
                    Utility: this.services[8][1][2],
                    Consumption: this.services[8][1][3]
                });

            }
            //Streaming video
            if (this.best.individual[9] == 0) {
                this.best.R_items.push({
                    Varriation: "Streaming video",
                    Etat: this.services[9][0][0],
                    response_time: this.services[9][0][1],
                    Utility: this.services[9][0][2],
                    Consumption: this.services[9][0][3]
                });

            } else if (this.best.individual[9] == 1) {
                this.best.R_items.push({
                    Varriation: "Streaming video",
                    Etat: this.services[9][1][0],
                    response_time: this.services[9][1][1],
                    Utility: this.services[9][1][2],
                    Consumption: this.services[9][1][3]
                });

            } else if (this.best.individual[9] == 2) {
                this.best.R_items.push({
                    Varriation: "Streaming video",
                    Etat: this.services[9][2][0],
                    response_time: this.services[9][2][1],
                    Utility: this.services[9][2][2],
                    Consumption: this.services[9][2][3]
                });

            } else if (this.best.individual[9] == 3) {
                this.best.R_items.push({
                    Varriation: "Streaming video",
                    Etat: this.services[9][3][0],
                    response_time: this.services[9][3][1],
                    Utility: this.services[9][3][2],
                    Consumption: this.services[9][3][3]
                });

            }
        }
    }
};
</script>
<style>

</style>
