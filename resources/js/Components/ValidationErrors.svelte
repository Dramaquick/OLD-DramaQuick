<script lang="ts">
    import Notification from "./Notification.svelte";
    let hasErrors = false;

    export let errors = {};

    $: {
        hasErrors = Object.keys(errors).length > 0;
    }

    function notify(title, text, type, duration, format, position, input, placeholder, action, id) {
        if (id != undefined) {
            if (document.getElementById(id) != null) {
                return;
            }
        }
        const notification = document.createElement('div');
        document.body.appendChild(notification);

        new Notification({
            target: notification,
            props: {
                title,
                text,
                type,
                duration,
                format,
                position,
                input,
                placeholder,
                action,
                id
            }
        });
    }

    $: {
        if (hasErrors) {
            Object.keys(errors).forEach(key => {
                if (errors[key] === "These credentials do not match our records.") {
                    notify("Erreur", "Veuillez vérifier vos identifiants", "error", 0, "box", "corner-top-right", false, "", false, "login");
                } else if (errors[key] === "The email must be a valid email address.") {
                    notify("Erreur", "Veuillez entrer une adresse mail valide", "error", 0, "box", "corner-top-right", false, "", false, "login");
                } else if (errors[key] === "Vous devez accepter les conditions d'utilisation") {
                    notify("Erreur", "Vous devez accepter les conditions d'utilisation", "error", 0, "box", "corner-top-right", false, "", false, "login");
                } else if (errors[key] === "The email has already been taken.") {
                    notify("Erreur", "Cette adresse mail est déjà utilisée", "error", 0, "box", "corner-top-right", false, "", false, "login");
                } else if (errors[key] === "The password confirmation does not match.") {
                    notify("Erreur", "Les deux mot de passe ne sont pas identiques", "error", 0, "box", "corner-top-right", false, "", false, "login");
                }
            });
        }
    }

    hasErrors = false;
    errors = {};
</script>