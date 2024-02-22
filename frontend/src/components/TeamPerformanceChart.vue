<!-- TeamPerformanceChart.vue -->
<template>
    <div>
      <canvas id="teamPerformanceChart"></canvas>
    </div>
  </template>
  
  <script>
  import { Chart, registerables } from 'chart.js';
  Chart.register(...registerables);
  
  export default {
    name: 'TeamPerformanceChart',
    //En ajoutant teamPerformanceData comme props dans TeamPerformanceChart.vue, et en observant les changements sur cette props, le graphique peut être mis à jour chaque fois que les données de performance de l'équipe changent, ce qui permet une mise à jour dynamique du graphique en fonction de l'équipe sélectionnée.
    props: {
  teamPerformanceData: {
    type: Array,
    default: () => []
  }
},
    mounted() {
      this.renderChart();
    },
    watch: {
  teamPerformanceData() {
    this.renderChart(); // Rendre à nouveau le graphique lorsque les données de performance de l'équipe changent
  }
},
    methods: {
      renderChart() {
        const ctx = document.getElementById('teamPerformanceChart').getContext('2d');
        new Chart(ctx, {
          type: 'line', // Ou tout autre type de graphique (bar, pie, etc.)
          data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'], // Exemple de labels mensuels
            datasets: [{
              label: 'Performance des Équipes',
              data: [65, 59, 80, 81, 56, 55], // Exemple de données de performance
              fill: false,
              borderColor: 'rgb(75, 192, 192)',
              tension: 0.1
            }]
          },


          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      },
      getTeamPerformanceData(teamId) {
      // Ici, vous devriez implémenter la logique pour récupérer les données de performance de l'équipe en fonction de teamId
      // Pour cet exemple, nous retournons des données statiques
      return {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'], // Ces labels devraient être dynamiques en fonction des données disponibles
        data: [65, 59, 80, 81, 56, 55] // Ces données devraient être récupérées de votre backend en fonction de teamId
      };
    }


    }
  }
  </script>

  Dans ce code, teamId est utilisé comme prop pour filtrer les données de performance. La méthode renderChart est appelée chaque fois que teamId change, ce qui permet de mettre à jour le graphique pour refléter les performances de l'équipe sélectionnée. La méthode fictive getTeamPerformanceData est un exemple de la façon dont vous pourriez récupérer les données de performance de l'équipe en fonction de teamId. Vous devrez remplacer cette logique par votre propre logique pour récupérer les données réelles de votre backend.