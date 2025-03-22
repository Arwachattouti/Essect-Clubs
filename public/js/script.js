document.addEventListener('DOMContentLoaded', function() {
    console.log("Bienvenue sur la plateforme des Clubs ESSECT!");
    const loginForm = document.querySelector("form[action='/login']");
    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            const email = document.querySelector("#email").value;
            const password = document.querySelector("#password").value;
            if (!email || !password) {
                alert("Tous les champs sont obligatoires !");
                event.preventDefault();
            }
        });
    }
});
