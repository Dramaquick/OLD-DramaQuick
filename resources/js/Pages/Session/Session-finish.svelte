<script lang="ts">
    import { onMount } from "svelte";
    import type { Router } from '@inertiajs/core/types/router';
    import { router } from '@inertiajs/svelte'
    import Button from "../../Components/Button.svelte";

    // Mise en place des données de la session pour le texte
    let text = {
        session: "#35878454",
    }

    // On redirige l'utilisateur vers la page d'accueil après 10 secondes
    onMount(() => {
        setTimeout(() => {
            window.location.href='/';
        }, 10_000)
    })
    
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="min-h-screen w-full overflow-hidden bg-cover bg-no-repeat">
    <h1 class="font-semibold text-[2rem] text-black py-12 pl-56">DramaQuick</h1>
    <div class="w-full flex justify-center mb-4">
        <div class="infos-container flex bg-white w-5/6 h-fit shadow rounded-2.5xl px-20 py-16 flex-col justify-between">
            <div>
                <p class="session text-[1.5rem] color font-normal w-fit">Session {text.session}</p>
                <h1 class="title py-8 font-semibold text-[2.25rem] w-fit">Vous avez terminé le quiz !</h1>
                <h2 class="desc bordered pl-6 font-normal text-[1.5rem] h-fit w-fit">Merci d'avoir participé !<br> Vous allez être redirigé automatiquement vers la page d'accueil, mais vous pouvez aussi cliquer sur le bouton ci-dessous.</h2>
            </div>
            <div class="button flex justify-center items-center mt-8">
                <Button class="" action={() => {window.location.href='/'}}>Voir les résultats</Button>
            </div>
        </div>
    </div>
</main>

<style>
    main {
        background-image: url(/img/landing/back.png);
    }

    .shadow {
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    .color {
        color: #666666;
    }

    .session {
        grid-row: 1;
        grid-column: 1;
    }

    .title {
        grid-row: 1;
        grid-column: 1;
    }

    .desc {
        grid-row: 1;
        grid-column: 1;
    }

    .bordered {
        border-left: 4px solid #34FFAD;
    }

    @media screen and (max-width: 650px) {
        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        main h1 {
            padding-left: 0px;
        }
    }

    @media screen and (max-width: 600px) {
        .infos-container {
            padding: 2rem;
        }
    }

    @media screen and (max-width: 400px) {
        .infos-container {
            width: 95%;
        }

        .infos-container h1 {
            font-size: 2rem;
        }

        .infos-container h2 {
            font-size: 1.25rem;
        }

        .infos-container p {
            font-size: 1.25rem;
        }
    }
</style>