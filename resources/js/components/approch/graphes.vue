<template>
    <b-tab title="Graphes">
        <div class="row p-4">
            <h2 class="text-center col-12">Test of our approach</h2>
            <hr>
            <!-- Time -->
            <div class="col-4 mt-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Response Time <i class="fa fa-clock-o float-right text-success"></i></h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Response Time - Latency</h5>
                        <p class="card-text">We test Response time of platform with different latency.</p>
                        <div class="d-flex justify-content-between">
                            <b-button v-b-modal.modal-time variant="success" @click="timeGraphe('line')">
                                <i class="fa fa-line-chart mr-2"></i> Line
                            </b-button>
                            <b-button v-b-modal.modal-time variant="success" @click="timeGraphe('bar')">
                                <i class="fa fa-bar-chart mr-2"></i> Bar
                            </b-button>
                        </div>
                        <b-modal id="modal-time" title="Response Time - Latency" size="xl" v-model="modalShow">
                            <line-chart
                                    :style="{ height: 600 + 'px' }"
                                    title="Response Time with latency"
                                    :labels="graphes.time.labels"
                                    :datasets="graphes.time.datasets"
                                    xTitle="Latency (ms)"
                                    yTitle="Response Times (ms)">
                            </line-chart>
                        </b-modal>
                    </div>
                </div>
            </div>
            <!-- Utility -->
            <div class="col-4 mt-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Utility <i class="fa fa-thumbs-o-up float-right text-warning"></i></h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Utility - Latency</h5>
                        <p class="card-text">We test Utility of services of platform with different latency.</p>
                        <div class="d-flex justify-content-between text-white">
                            <b-button v-b-modal.modal-utility variant="warning" class="text-white" @click="utilityGraphe('line')">
                                <i class="fa fa-line-chart mr-2"></i> Line
                            </b-button>
                            <b-button v-b-modal.modal-utility variant="warning" class="text-white" @click="utilityGraphe('bar')">
                                <i class="fa fa-bar-chart mr-2"></i> Bar
                            </b-button>
                        </div>
                        <b-modal id="modal-utility" title="Utility - Latency" size="xl" v-model="modalShow2">
                            <line-chart
                                    :style="{ height: 600 + 'px' }"
                                    title="Utility with latency"
                                    :labels="graphes.utility.labels"
                                    :datasets="graphes.utility.datasets"
                                    xTitle="Latency (ms)"
                                    yTitle="Utility">
                            </line-chart>
                        </b-modal>
                    </div>
                </div>
            </div>

            <!-- Consommation -->
            <div class="col-4 mt-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Consumption <i class="fa fa-plug float-right text-danger"></i></h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Consumption - Latency</h5>
                        <p class="card-text">We test Consumption of connexion of platform with different latency.</p>
                        <div class="d-flex justify-content-between">
                            <b-button v-b-modal.modal-consommation variant="danger" @click="consommationGraphe('line')">
                                <i class="fa fa-line-chart mr-2"></i> Line
                            </b-button>
                            <b-button v-b-modal.modal-consommation variant="danger" @click="consommationGraphe('bar')">
                                <i class="fa fa-bar-chart mr-2"></i> Bar
                            </b-button>
                        </div>
                        <b-modal id="modal-consommation" title="Consumption - Latency" size="xl" v-model="modalShow3">
                            <line-chart
                                    :style="{ height: 600 + 'px' }"
                                    title="Consumption with latency"
                                    :labels="graphes.consommation.labels"
                                    :datasets="graphes.consommation.datasets"
                                    xTitle="Latency (ms)"
                                    yTitle="Consommation (Kbps)">
                            </line-chart>
                        </b-modal>
                    </div>
                </div>
            </div>

            <!-- Fitness -->
            <div class="col-4 mt-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Fitness score <i class="fa fa-dashboard float-right text-primary"></i></h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Fitness - Latency</h5>
                        <p class="card-text">We test fitness function with different latency.</p>
                        <div class="d-flex justify-content-between">
                            <b-button v-b-modal.modal-fitness variant="primary" @click="fitnessGraphe('line')">
                                <i class="fa fa-line-chart mr-2"></i> Line
                            </b-button>
                            <b-button v-b-modal.modal-fitness variant="primary" @click="fitnessGraphe('bar')">
                                <i class="fa fa-bar-chart mr-2"></i> Bar
                            </b-button>
                        </div>
                        <b-modal id="modal-fitness" title="Fitness - Latency" size="xl" v-model="modalShow1">
                            <line-chart
                                    :style="{ height: 600 + 'px' }"
                                    title="Fitness score graphe"
                                    :labels="graphes.fitness.labels"
                                    :datasets="graphes.fitness.datasets"
                                    xTitle="Latency (ms)"
                                    yTitle="Fitness">
                            </line-chart>
                        </b-modal>
                    </div>
                </div>
            </div>

            <!-- Fitness Evolution -->
            <div class="col-4 mt-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Fitness Evolution <i class="fa fa-bolt float-right text-info"></i></h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Fitness - Generation</h5>
                        <p class="card-text">We test the Evolution of fitness function in our algorithm by generations.</p>
                        <div class="d-flex justify-content-between">
                            <b-button v-b-modal.modal-fitnessEvolution variant="info" @click="fitnessEvolutionGraphe('line')">
                                <i class="fa fa-line-chart mr-2"></i> Line
                            </b-button>
                            <b-button v-b-modal.modal-fitnessEvolution variant="info" @click="fitnessEvolutionGraphe('bar')">
                                <i class="fa fa-bar-chart mr-2"></i> Bar
                            </b-button>
                        </div>
                        <b-modal id="modal-fitnessEvolution" title="Fitness - Generation" size="xl" v-model="modalShow4">
                            <line-chart
                                    :style="{ height: 600 + 'px' }"
                                    title="Fitness with Generation"
                                    :labels="graphes.fitnessEvolution.labels"
                                    :datasets="graphes.fitnessEvolution.datasets"
                                    xTitle="Generation"
                                    yTitle="Fitness value">
                            </line-chart>
                        </b-modal>
                    </div>
                </div>
            </div>

            <!-- Execution Time -->
            <div class="col-4 mt-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Execution Time <i class="fa fa-hourglass-end float-right text-Dark"></i></h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Execution Time</h5>
                        <p class="card-text">We test the average time of execution of our approach.</p>
                        <div class="d-flex justify-content-between">
                            <b-button v-b-modal.modal-executionTime variant="dark" @click="executionTimeGraphe('line')">
                                <i class="fa fa-line-chart mr-2"></i> Line
                            </b-button>
                            <b-button v-b-modal.modal-executionTime variant="dark" @click="executionTimeGraphe('bar')">
                                <i class="fa fa-bar-chart mr-2"></i> Bar
                            </b-button>
                        </div>
                        <b-modal id="modal-executionTime" title="Fitness - Generation" size="xl" v-model="modalShow5">
                            <line-chart
                                    :style="{ height: 600 + 'px' }"
                                    title="Execution Time"
                                    :labels="graphes.executionTime.labels"
                                    :datasets="graphes.executionTime.datasets"
                                    xTitle="Test number"
                                    yTitle="Time of execution (ms)">
                            </line-chart>
                        </b-modal>
                    </div>
                </div>
            </div>
        </div>
    </b-tab>
</template>

<script>
    import lineChart from '../chartjs.vue';
export default {
    components: { lineChart },
    props: ['grapheData'],
    data() {
        return {
           graphes: {
                time: {
                    labels: ['0','50', '100', '150', '200', '250', '300', '350', '400', '450', '500'],
                    datasets: [
                        {
                          label: 'With GA',
                          type: 'line',
                          backgroundColor: '#009432',
                          fill: false,
                          borderColor: '#009432',
                          data: this.grapheData.Ydata
                        },
                        {
                          label: 'Without GA',
                          type: 'line',
                          backgroundColor: '#2f3640',
                          fill: false,
                          borderColor: '#2f3640',
                          data: this.grapheData.Xdata
                        }
                    ],
                },
                utility: {
                    labels: ['0','50', '100', '150', '200', '250', '300', '350', '400', '450', '500'],
                    datasets: [
                        {
                          label: 'With GA',
                          type: 'line',
                          backgroundColor: '#fbc531',
                          fill: false,
                          borderColor: '#fbc531',
                          data: this.grapheData.Ydata
                        },
                        {
                          label: 'Without GA',
                          type: 'line',
                          backgroundColor: '#2f3640',
                          fill: false,
                          borderColor: '#2f3640',
                          data: this.grapheData.Xdata
                        }
                    ],
                },
                consommation: {
                    labels: ['0','50', '100', '150', '200', '250', '300', '350', '400', '450', '500'],
                    datasets: [
                        {
                          label: 'With GA',
                          type: 'line',
                          backgroundColor: '#f78fb3',
                          fill: false,
                          borderColor: '#f78fb3',
                          data: this.grapheData.Ydata
                        },
                        {
                          label: 'Without GA',
                          type: 'line',
                          backgroundColor: '#2f3640',
                          fill: false,
                          borderColor: '#2f3640',
                          data: this.grapheData.Xdata
                        }
                    ],
                },
                fitness: {
                    labels: ['0','50', '100', '150', '200', '250', '300', '350', '400', '450', '500'],
                    datasets: [
                        {
                          label: 'Without GA',
                          type: 'line',
                          backgroundColor: '#2f3640',
                          fill: false,
                          borderColor: '#2f3640',
                          data: this.grapheData.Xdata
                        },
                        {
                          label: 'With GA',
                          type: 'line',
                          backgroundColor: '#0097e6',
                          fill: false,
                          borderColor: '#0097e6',
                          data: this.grapheData.Ydata
                        }
                    ],
                },
                fitnessEvolution: {
                    labels: ['0', '10', '20', '30', '40', '50', '60', '70', '80', '100'],
                    datasets: [
                        {
                          label: 'Fitness Evolution',
                          type: 'line',
                          backgroundColor: '#3dc1d3',
                          fill: false,
                          borderColor: '#3dc1d3',
                          data: this.grapheData.Ydata
                        }
                    ],
                },
                executionTime: {
                    labels: ['0','1', '2', '3', '4', '5'],
                    datasets: [
                        {
                          label: 'Average execution time',
                          type: 'line',
                          backgroundColor: '#3c40c6',
                          fill: false,
                          borderColor: '#3c40c6',
                          data: this.grapheData.Ydata
                        }
                    ],
                }
            },
            modalShow: false,
            modalShow1: false,
            modalShow2: false,
            modalShow3: false,
            modalShow4: false,
            modalShow5: false,
        };
    },
    methods: {
        timeGraphe(chart='line'){
            this.$emit('time');
            //Graphe type
            this.graphes.time.datasets[0].type = chart;
            this.graphes.time.datasets[1].type = chart;

            this.graphes.time.datasets[0].data = this.grapheData.Ydata;
            this.graphes.time.datasets[1].data = this.grapheData.Xdata;
            this.modalShow = !this.modalShow;
        },
        utilityGraphe(chart='line'){
            this.$emit('utility');
            //Graphe type
            this.graphes.utility.datasets[0].type = chart;
            this.graphes.utility.datasets[1].type = chart;

            this.graphes.utility.datasets[0].data = this.grapheData.Ydata;
            this.graphes.utility.datasets[1].data = this.grapheData.Xdata;
            this.modalShow2 = !this.modalShow2;
        },
        consommationGraphe(chart='line'){
            this.$emit('consommation');
            //Graphe type
            this.graphes.consommation.datasets[0].type = chart;
            this.graphes.consommation.datasets[1].type = chart;

            this.graphes.consommation.datasets[0].data = this.grapheData.Ydata;
            this.graphes.consommation.datasets[1].data = this.grapheData.Xdata;
            this.modalShow3 = !this.modalShow3;
        },
        fitnessGraphe(chart='line'){
            this.$emit('fitness');
            //Graphe type
            this.graphes.fitness.datasets[0].type = chart;
            this.graphes.fitness.datasets[1].type = chart;

            this.graphes.fitness.datasets[0].data = this.grapheData.Xdata;
            this.graphes.fitness.datasets[1].data = this.grapheData.Ydata;
            this.modalShow1 = !this.modalShow1;
        },
        fitnessEvolutionGraphe(chart='line'){
            this.$emit('fitnessEvolution');
            //Graphe type
            this.graphes.fitnessEvolution.datasets[0].type = chart;

            this.graphes.fitnessEvolution.datasets[0].data = this.grapheData.Ydata;
            this.modalShow4 = !this.modalShow4;
        },
        executionTimeGraphe(chart='line'){
            this.$emit('executionTime');
            //Graphe type
            this.graphes.executionTime.datasets[0].type = chart;

            this.graphes.executionTime.datasets[0].data = this.grapheData.Ydata;
            this.modalShow5 = !this.modalShow5;
        }
    }
};
</script>

<style lang="css" scoped>
</style>
