<template>
    <!-- Je définis la structure de ma vue de connexion. -->
    <div class="login">
      <!-- J'affiche le titre de la page. -->
      <h1>Connexion</h1>
      <!-- J'utilise un formulaire pour collecter les informations de connexion de l'utilisateur. -->
      <form @submit.prevent="login">
        <!-- Je demande l'adresse e-mail de l'utilisateur. -->
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="email" required>
        </div>
        <!-- Je demande le mot de passe de l'utilisateur. -->
        <div>
          <label for="password">Mot de passe:</label>
          <input type="password" id="password" v-model="password" required>
        </div>
        <!-- Cette section s'affiche uniquement si une réinitialisation du mot de passe est nécessaire. -->
        <div v-if="showReset">
          <h2>Réinitialiser le mot de passe</h2>
          <!-- J'ai besoin de l'ancien mot de passe pour le vérifier avant de le changer. -->
          <div>
            <label for="oldPassword">Ancien mot de passe:</label>
            <input type="password" id="oldPassword" v-model="oldPassword" required>
          </div>
          <!-- Je demande le nouveau mot de passe. -->
          <div>
            <label for="newPassword">Nouveau mot de passe:</label>
            <input type="password" id="newPassword" v-model="newPassword" required>
          </div>
          <!-- Je demande de confirmer le nouveau mot de passe pour éviter les erreurs de frappe. -->
          <div>
            <label for="confirmPassword">Confirmation du mot de passe:</label>
            <input type="password" id="confirmPassword" v-model="confirmPassword" required>
          </div>
        </div>
        <!-- J'ajoute un bouton pour soumettre le formulaire. -->
        <button type="submit">Se connecter</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        // Je définis les variables nécessaires pour recueillir les informations du formulaire.
        email: '',
        password: '',
        oldPassword: '',
        newPassword: '',
        confirmPassword: '',
        // Cette variable contrôle l'affichage de la section de réinitialisation du mot de passe.
        showReset: false
      };
    },
    mounted() {
      // Je vérifie si le mot de passe doit être réinitialisé lors du chargement du composant.
      const lastReset = new Date(localStorage.getItem('lastPasswordReset'));
      const now = new Date();
      // Je calcule le nombre de jours écoulés depuis la dernière réinitialisation.
      const days = Math.floor((now - lastReset) / (1000 * 60 * 60 * 24));
      // Je définis la condition pour afficher la section de réinitialisation du mot de passe.
      if (days >= 90) {
        this.showReset = true;
      }
    },
    methods: {
      login() {
        // Cette méthode est appelée lorsque l'utilisateur soumet le formulaire de connexion.
        console.log("Tentative de connexion avec", this.email, this.password);
        
        // Si la réinitialisation du mot de passe est nécessaire et que les mots de passe correspondent...
        if (this.showReset && this.newPassword === this.confirmPassword) {
          // Je traite ici la réinitialisation du mot de passe.
          console.log("Réinitialisation du mot de passe pour", this.email);
          // Je mets à jour la date de la dernière réinitialisation du mot de passe.
          localStorage.setItem('lastPasswordReset', new Date().toISOString());
          // Je masque la section de réinitialisation après une réinitialisation réussie.
          this.showReset = false;
        }
      }
    }
  }
  
  
  </script>
  
  <style scoped>
    /* Je définis le style de ma page de connexion pour la rendre agréable à l'œil. */
    .login div {
      margin-bottom: 15px;
    }
  
    label {
      display: block;
      margin-bottom: 5px;
    }
  
    input[type=email], input[type=password] {
      width: 100%;
      padding: 8px;
      margin-bottom: 20px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
  
    button {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  
    button:hover {
      background-color: #0056b3;
    }
    
  </style>