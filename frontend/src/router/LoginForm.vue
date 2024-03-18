<template>
    <!-- Je crée le formulaire de connexion qui sera utilisé dans LoginView.vue -->
    <form @submit.prevent="submitForm">
      <!-- Champ e-mail avec liaison bidirectionnelle pour capturer la saisie de l'utilisateur -->
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required>
      </div>
      <!-- Champ mot de passe avec liaison bidirectionnelle pour capturer la saisie de l'utilisateur -->
      <div>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" v-model="password" required>
      </div>
      <!-- Bouton pour soumettre le formulaire -->
      <button type="submit">Se connecter</button>
    </form>
  </template>
  
  <script>
  export default {
    name: 'LoginForm',
    data() {
      // Je définis les données de mon formulaire de connexion
      return {
        email: '',
        password: ''
      };
    },
    methods: {
      submitForm() {
        // Je définis ce qui se passe lors de la soumission du formulaire
        // Ici, je pourrais implémenter la logique d'authentification ou émettre un événement
        this.$emit('login', { email: this.email, password: this.password });
        console.log("Tentative de connexion avec", this.email, this.password);
      }
    }
  }
  </script>
  
  <style scoped>
  /* Je stylise mon formulaire de connexion pour le rendre plus agréable à l'œil */
  form {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input {
    width: 100%;
    padding: 8px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }
  
  button {
    width: 100%;
    padding: 10px 0;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  </style>