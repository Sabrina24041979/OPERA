<template>
    <div class="dashboard">
      <h1>Tableau de Bord</h1>
      <div class="filters">
        <select v-model="selectedTeam" @change="updateChartData">
          <option value="">Sélectionner une équipe</option>
          <option v-for="team in teams" :key="team.id" :value="team.id">{{ team.name }}</option>
        </select>
      </div>
      <div class="dashboard-widgets">
        <div class="widget performances">
          <h2>Performances des Équipes</h2>
          <TeamPerformanceChart :teamId="selectedTeam"/>
        </div>
        <div class="widget tasks">
          <h2>Tâches à Venir</h2>
          <ul>
            <!-- Boucle sur les tâches à venir -->
            <li v-for="task in upcomingTasks" :key="task.id">{{ task.name }}</li>
          </ul>
        </div>
        <div class="widget goals">
          <h2>Objectifs Récents</h2>
          <ul>
            <!-- Boucle sur les objectifs récents -->
            <li v-for="goal in recentGoals" :key="goal.id">{{ goal.name }}</li>
          </ul>
        </div>
        <div class="widget feedbacks">
          <h2>Derniers Feedbacks</h2>
          <ul>
            <!-- Boucle sur les derniers feedbacks -->
            <li v-for="feedback in latestFeedbacks" :key="feedback.id">{{ feedback.content }}</li>
          </ul>
        </div>
      </div>
    </div>
  </template>
    
  <script>
import TeamPerformanceChart from './TeamPerformanceChart.vue';

export default {
    name: 'Dashboard',
  components: {
    TeamPerformanceChart
  },
  // Le reste de la logique de votre composant Dashboard...
    data() {
      return {
        // Exemple de données, à remplacer par des données réelles via API
        upcomingTasks: [
          { id: 1, name: 'Préparer rapport mensuel' },
          { id: 2, name: 'Réunion équipe projet X' },
        ],
        recentGoals: [
          { id: 1, name: 'Augmenter satisfaction client de 10%' },
          { id: 2, name: 'Réduire temps de réponse support' },
        ],
        latestFeedbacks: [
          { id: 1, content: 'Très satisfait de la présentation projet' },
          { id: 2, content: 'Besoin d\'amélioration dans la communication interne' },
        ],
      };
    },
    methods: {
//La méthode updateChartData dans Dashboard.vue peut être utilisée pour mettre à jour le graphique en fonction de l'équipe sélectionnée, et le composant TeamPerformanceChart s'adapt
  updateChartData() {
    if (this.selectedTeam) {
      // Supposons que `fetchTeamPerformance` est une méthode qui récupère les données de performance d'une équipe spécifique
      this.fetchTeamPerformance(this.selectedTeam)
        .then(performanceData => {
          // Supposons que `teamPerformanceData` est une propriété data qui stocke les données de performance de l'équipe actuellement sélectionnée
          this.teamPerformanceData = performanceData;
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des données de performance de l'équipe", error);
        });
    } else {
      // Si aucune équipe n'est sélectionnée, vous pourriez vouloir réinitialiser le graphique ou afficher les données de toutes les équipes
      this.teamPerformanceData = null; // Ou définir une valeur par défaut
    }
  }
}
  }
  </script>
  
  <style>
  .dashboard {
    padding: 20px;
  }
  
  .dashboard h1 {
    color: #333;
    text-align: center;
  }
  
  .dashboard-widgets {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-top: 20px;
  }
  
  .widget {
    background: #f4f4f4;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 10px;
    width: calc(50% - 20px);
  }
  
  .widget h2 {
    color: #0077cc;
    margin-bottom: 15px;
  }
  
  .widget ul {
    list-style: none;
    padding: 0;
  }
  
  .widget li {
    margin-bottom: 10px;
    padding: 5px;
    background: #fff;
    border-radius: 5px;
  }
  </style>