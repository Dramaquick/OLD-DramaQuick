<script>
    import Notification from "./Notification.svelte";
    let className;
    let hasErrors = false;

    export { className as class };
    export let errors = {};

    function createText() {
        let text = "";
        for (let key in errors) {
            text += errors[key] + " ";
        }
        return text;
    }

    $: {
        hasErrors = Object.keys(errors).length > 0;
    }
</script>

{#if hasErrors}
    {#each Object.keys(errors) as key}
        {#if errors[key] === "These credentials do not match our records."}
            <Notification title={"Erreur"} text={"Veuillez vérifier vos identifiants"} type={"error"} duration={5000} format={"box"} position={"corner-top-right"}/>
        {:else if errors[key] === "The email must be a valid email address."}
            <Notification title={"Erreur"} text={"Veuillez entrer une adresse mail valide"} type={"error"} duration={5000} format={"box"} position={"corner-top-right"}/>
        {:else if errors[key] === "Vous devez accepter les conditions d'utilisation"}
            <Notification title={"Erreur"} text={"Vous devez accepter les conditions d'utilisation"} type={"error"} duration={5000} format={"box"} position={"corner-top-right"}/>
        {:else if errors[key] === "The email has already been taken."}
            <Notification title={"Erreur"} text={"Cette adresse mail est déjà utilisée"} type={"error"} duration={5000} format={"box"} position={"corner-top-right"}/>
        {:else if errors[key] === "The password confirmation does not match."}
            <Notification title={"Erreur"} text={"Les deux mot de passe ne sont pas identiques"} type={"error"} duration={5000} format={"box"} position={"corner-top-right"}/>
        {/if}
    {/each}
{/if}
