<template>
    <div class="container settings-page mb-4 mt-4">
        <canvas id="myChart" width="400" height="200"></canvas>
        <line-chart :labels="labels" :datasets="chartdata" :options="options"></line-chart>
    </div>
</template>

<script>
    import lineChart from '../components/chartjs.vue';
    export default {
        components: { lineChart },
        data(){
            return{
                labels: ['A', 'B', 'C'],
                chartdata: [
                    {
                    data: [10, 20, 30],
                    backgroundColor: '#af90ca',
                    label: 'Before'
                  },
                  {
                    data: [50, 30, 40],
                    backgroundColor: '#c46998',
                    label: 'After'
                  }
                ],
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }

            }
        },
        mounted(){

        },
        methods: {

        }
    }
</script>
