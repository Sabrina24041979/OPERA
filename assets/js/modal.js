let modalWindow = document.querySelector("#modalWindow");
let buttonPrimary = document.querySelector(".btn-primary");

if (buttonPrimary) {
  buttonPrimary.click();
}

// Créer une instance de MutationObserver 
// const observer = new MutationObserver((mutations) => {
//   mutations.forEach((mutation) => {
//     console.log(mutation.type);  // mutation.type will be "attributes", "childList", or "characterData" 
//     modalWindow.style.width = "100vw";
//     modalWindow.style.backdropFilter = "blur(8.7px)"; // un effet glassmorphisme en arrière-plan
//   });
// });

// // Configurer l'observateur pour écouter les changements dans le DOM 
// const config = { attributes: true, childList: true, subtree: true };
// observer.observe(modalWindow, config);

// On peut arrêter l'observateur à tout moment
// observer.disconnect();

// si la fenetre change, ecouter le modal
// Si c'est le modal qui est présent, alors mettre le width à 100vw
