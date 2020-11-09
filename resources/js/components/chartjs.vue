
<script>
// MonthlyIncome.vue
import { Line, Bar } from 'vue-chartjs'

export default {
  extends: Line,
  props: ['labels', 'datasets', 'options','xTitle', 'yTitle', 'title'],
  mounted () {

    this.renderChart({
                  labels: this.labels,
                  datasets: this.datasets
                },
                {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        text: this.title,
                        fontSize: 18,
                        fontStyle: 'bold'
                    },
                    legend: {
                        display: true,
                        labels: {
                            fontSize: 16,
                            fontStyle: "bold"
                        }
                    },
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: this.yTitle,
                                fontSize: 16,
                                fontStyle: 'bold'
                            },

                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: this.xTitle,
                            fontSize: 16,
                            fontStyle: 'bold'
                          }
                        }]
                    }
                })
  }
}
</script>

<style lang="css" scoped>
</style>
