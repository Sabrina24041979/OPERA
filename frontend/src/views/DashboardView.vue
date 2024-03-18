<template>
    <div class="dashboard">
      <h1>Tableau de Bord</h1>
      <team-performance-chart></team-performance-chart>
    </div>
  </template>
  
  <script>
  import TeamPerformanceChart from '@/components/TeamPerformanceChart.vue'
  
  export default {
    name: 'DashboardView',
    components: {
      TeamPerformanceChart
    }
  }
  </script>
  
  <style scoped>
  .dashboard {
    padding: 20px;
  }
  </style>