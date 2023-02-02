<script>
    import { Link, page } from "@inertiajs/inertia-svelte";
    import {onMount} from "svelte";
    import Button from "../Components/Button.svelte";

    export let canLogin;
    export let canRegister;
    export let laravelVersion;
    export let phpVersion;
    // Les exportations ci-dessus sont définies dans "/routes/web.php"

    export let errors;
    /** @type {{date: Date, email: string, email_verified_at: null, id: int, name: string, updated_at: Date}}*/
    export let auth;
    // Celles-ci sont définies automatiquement par Inertia
    // A savoir que la variable auth est un objet qui permet d'accéder aux attributs publics de l'utilisateur :

    // created_at (date): La date & l'heure de création de l'utilisateur
    // email (string): L'email de l'utilisateur
    // email_verified_at: (date): La date & l'heure à laquelle l'utilisateur a vérifié son email (pas fait pour le moment)
    // id: (int) L'identifiant de l'utilisateur
    // name: (string) Le pseudo de l'utilisateur
    // updated_at: (date) La date & l'heure de dernière mise à jour de l'utilisateur
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="min-h-screen w-full">
    <div>
        <Button class="">Rejoindre une session</Button>
        <Button class="outline">Créer une session</Button>
        <Button class="disabled">Disabled</Button>
    </div>
</main>

<!-- Ici j'utilise style pour styliser le fond qui est un peu compliqué -->
<style>
    main::before {
        background: url("../../img/landing/square.png") 0 0 no-repeat;
        background-size: cover;
        content: "";
        position: absolute;
        width: 60rem;
        height: 60rem;
        z-index: -1;
        transform: rotate(45deg);
        bottom: -32rem;
        right: -8rem;
        overflow: hidden;
        border-radius: 5rem;
    }
</style>
