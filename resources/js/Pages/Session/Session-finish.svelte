<script>
    import { onMount } from "svelte";
    import Timer from "../../Components/Timer.svelte";
    import TextArea from "../../Components/TextArea.svelte";
    import Button from "../../Components/Button.svelte";

    // Décompteur en temps réel pour Timer
    let timer = {
        minutes: 1,
        seconds: 10,
    };

    let text = {
        session: "#35878454",
    }

    let form = {
        textArea: "",
    }
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="h-screen w-full overflow-hidden bg-cover bg-no-repeat">
    <h1 class="font-semibold text-[2rem] text-black py-12 pl-56 w-full">DramaQuick</h1>
    <div class="pl-56 pr-56">
    <div class="grid bg-white w-full h-156 shadow rounded-2.5xl px-20 py-16">
        <div>
            <p class="session text-[1.5rem] color font-normal w-fit">Session {text.session}</p>
            <h1 class="title py-8 w-144 font-semibold text-[2.25rem] w-fit">Vous avez terminé le quiz !</h1>
            <h2 class="desc bordered pr-52 pl-6 font-normal text-[1.5rem] h-fit w-fit">Merci d'avoir participé !<br> Vous allez être redirigé automatiquement vers la page d'accueil, mais vous pouvez aussi cliquer sur le bouton ci-dessous.</h2>
        </div>
        <div class="button flex justify-center items-center">
            <Button class="">Voir les résultats</Button>
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
</style>