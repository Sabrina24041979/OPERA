<template>
    <div class="home">
      <h1>Bienvenue sur OPERA</h1>
      <p>Ceci est la page d'accueil de votre application de gestion d'opérations et de ressources.</p>
      <router-link to="/login">
        <button>Connexion</button>
      </router-link>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Home'
  }
  </script>
  
  <style scoped>
  .home {
    text-align: center;
    margin-top: 50px;
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