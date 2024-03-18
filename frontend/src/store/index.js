import { createStore } from 'vuex';

// Je crée le store Vuex pour gérer l'état global de mon application OPERA
export default createStore({
  state: {
    // Je définis l'état initial lié à la performance de l'équipe
    teamPerformanceData: {
      labels: ['Janvier', 'Février', 'Mars', 'Avril'], // Mois de l'année pour l'axe des abscisses du graphique
      datasets: [
        {
          label: 'Performance de l’équipe', // Légende du graphique
          backgroundColor: '#f87979', // Couleur des barres du graphique
          data: [40, 39, 10, 40, 39, 80, 40] // Données de performance pour chaque mois
        }
      ]
    }
  },
  getters: {
    // Je crée un getter pour accéder facilement aux données de performance de l'équipe dans l'application
    teamPerformanceData: state => state.teamPerformanceData
  },
  mutations: {
    // Je peux ajouter des mutations ici pour modifier l'état, par exemple, après avoir récupéré de nouvelles données
  },
  actions: {
    // Je peux ajouter des actions ici pour gérer les opérations asynchrones, comme la récupération des données de performance de l'équipe depuis une API
  }
});