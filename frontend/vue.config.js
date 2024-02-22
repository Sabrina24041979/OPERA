const { defineConfig } = require('@vue/cli-service')

module.exports = defineConfig({
  transpileDependencies: true,

  css: {
    loaderOptions: {
      scss: {
        // Options du préprocesseur SCSS
        sassOptions: {
          // Importation des variables et des mixins
          prependData: `
            @import "@/styles/variables.scss";
            @import "@/styles/mixins.scss";
          `
        }
      }
    }
  }
});