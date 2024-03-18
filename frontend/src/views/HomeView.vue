<template>
  <div class="home">
    <h1>Bienvenue sur OPERA</h1>
    <p>Ceci est votre application de gestion pour optimiser la performance et l'évaluation des équipes.</p>
    <button @click="goToLogin">Connexion</button>
  </div>
</template>

<script>
export default {
  name: 'HomeView',
  methods: {
    goToLogin() {
      // Rediriger l'utilisateur vers la page de connexion
      // Vous devez définir cette route dans votre fichier de routeur
      this.$router.push({ name: 'login' });
    }
  }
}
</script>

<!-- Ajoutez le style comme vous le souhaitez -->
<style scoped>
.home {
  text-align: center;
  margin-top: 50px;
}

button {
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}
</style>

