<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Logo et nom de l'application -->
    <a class="navbar-brand" href="#">OPERA</a>

    <!-- Bouton pour les écrans plus petits (mobiles) -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Basculer la navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Éléments de navigation -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <!-- Lien vers le tableau de bord de l'utilisateur -->
        <li class="nav-item active">
          <router-link class="nav-link" to="/dashboard">Tableau de Bord</router-link>
        </li>

        <!-- Lien vers la gestion des équipes -->
        <li class="nav-item">
          <router-link class="nav-link" to="/teams">Équipes</router-link>
        </li>

        <!-- Lien vers la gestion des employés -->
        <li class="nav-item">
          <router-link class="nav-link" to="/employees">Employés</router-link>
        </li>

        <!-- Lien vers la gestion des projets -->
        <li class="nav-item">
          <router-link class="nav-link" to="/projects">Projets</router-link>
        </li>

        <!-- Lien vers la page des initiatives éco-responsables -->
        <li class="nav-item">
          <router-link class="nav-link" to="/eco-initiatives">Initiatives Éco</router-link>
        </li>
      </ul>

      <!-- Liens de navigation à droite pour les actions utilisateur (profil, déconnexion) -->
      <ul class="navbar-nav ml-auto">
        <!-- Lien vers le profil de l'utilisateur -->
        <li class="nav-item">
          <router-link class="nav-link" to="/profile">Mon Profil</router-link>
        </li>

        <!-- Lien pour la déconnexion -->
        <li class="nav-item">
          <router-link class="nav-link" to="/logout">Déconnexion</router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',

  // data retourne un objet avec les données locales du composant
  data() {
    return {
      // Indicateur pour savoir si l'utilisateur est connecté
      isLoggedIn: false,
    };
  },

  // Les méthodes du composant, pour gérer la déconnexion
  methods: {
    logout() {
      // Ajouter la logique pour gérer la déconnexion de l'utilisateur
      // Effacer un token de stockage local, appeler un endpoint d'API pour se déconnecter.
      console.log("L'utilisateur s'est déconnecté.");
      this.isLoggedIn = false;
      // Rediriger l'utilisateur vers la page de connexion après la déconnexion
      this.$router.push('/login');
    },

    checkLoginStatus() {
      // Vérifier si l'utilisateur est actuellement connecté
      // Cela pourrait être fait en vérifiant la présence d'un token de session, un appel API.
      // Pour cet exemple, nous allons simplement simuler que l'utilisateur est connecté
      this.isLoggedIn = true;
    }
  },

  // Les hooks de cycle de vie, par exemple mounted(), pour vérifier le statut de connexion lors du montage du composant
  mounted() {
    this.checkLoginStatus();
  },
}
</script>

<style scoped>
/* Style général de la barre de navigation */
.navbar {
  background-color: #007bff; /* Couleur de fond bleu OPERA */
  color: #ffffff; /* Texte blanc pour un contraste élevé */
  padding: 1rem 2rem; /* Espacement autour du contenu de la navbar */
  display: flex; /* Utilisation de Flexbox pour aligner les éléments */
  justify-content: space-between; /* Répartir les éléments uniformément */
  align-items: center; /* Centrer les éléments verticalement */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre subtile pour la profondeur */
}

/* Style des liens dans la barre de navigation */
.navbar a {
  color: #ffffff; /* Texte blanc pour tous les liens */
  text-decoration: none; /* Supprimer le soulignement */
  margin-right: 20px; /* Espacement à droite de chaque lien */
}

.navbar a:hover {
  text-decoration: underline; /* Souligner au survol pour indiquer la possibilité de cliquer */
}

/* Style du logo ou du titre de l'application dans la navbar */
.navbar-brand {
  font-weight: bold; /* Rendre le texte du logo ou du titre plus gras */
  font-size: 1.5rem; /* Taille de police plus grande pour le logo ou le titre */
}

/* Style pour le bouton de déconnexion ou pour les actions spécifiques de l'utilisateur */
.nav-action {
  background-color: #ffc107; /* Couleur de fond pour le bouton d'action, jaune pour la visibilité */
  color: #000; /* Texte noir pour un contraste élevé avec le fond jaune */
  padding: 0.5rem 1rem; /* Espacement interne pour le bouton */
  border-radius: 5px; /* Bordures arrondies pour un look moderne */
  cursor: pointer; /* Indicateur de pointeur pour montrer qu'il est cliquable */
}

.nav-action:hover {
  background-color: #e0a800; /* Assombrir le bouton au survol pour une interaction visuelle */
}
</style>