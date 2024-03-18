<template>
    <div class="chart-container">
      <line-chart :chart-data="chartData"></line-chart>
    </div>
  </template>
  
  <script>
  import { Line } from 'vue-chartjs'
  import { mapState } from 'vuex'
  
  export default {
    components: {
      LineChart: Line
    },
    computed: {
      ...mapState(['teamPerformanceData']),
      chartData() {
        return this.teamPerformanceData
      }
    }
  }
  </script>
  
  <style scoped>
  .chart-container {
    width: 600px;
    height: 400px;
  }
  </style>