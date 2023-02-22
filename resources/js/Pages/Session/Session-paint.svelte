<script>
    import { onMount } from "svelte";
    import Timer from "../../Components/Timer.svelte";
    import Paint from "../../Components/Paint.svelte";
    import Button from "../../Components/Button.svelte";

    // Décompteur en temps réel pour Timer
    let timer = {
        minutes: 1,
        seconds: 10,
    };

    onMount(() => {
        setInterval(() => {
            if (timer.seconds > 0) {
                timer.seconds--;
            } else if (timer.minutes > 0) {
                timer.minutes--;
                timer.seconds = 59;
            }
        }, 1000);
    });

    let text = {
        session: "#35878454",
        page: "4/10",
        title: "Pourquoi le Japon ?",
        description: "Bah oui c'est vrai mdr"
    }

    let form = {
        canvasImage: "",
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
            <h1 class="title py-2 w-144 font-semibold text-[2.25rem] w-fit">{text.title}</h1>
            <h2 class="desc bordered pl-6 w-144 font-normal text-[1.5rem] h-fit w-fit">{text.description}</h2>
        </div>
        <p class="page font-semibold text-[1.5rem] text-black text-right">{text.page}</p>
        <div class="paint flex justify-center">
            <Paint setPaint={(img) => form.canvasImage = img }  />
        </div>
        <div class="timer-tags flex items-end">
            <Timer
                bind:minutes={timer.minutes}
                bind:seconds={timer.seconds}
            />
            <p class="text-[1.5rem] color font-normal w-fit flex items-center h-12">restantes</p>
        </div>
        <div class="button flex justify-end items-end">
            <Button class="outline">Quitter la session</Button>
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

    .page {
        grid-row: 1;
        grid-column: 2;
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

    .paint {
        grid-row: 2;
        grid-column: 1/3;
    }
</style>