<script>
    import Timer from "../../Components/Timer.svelte";
    import { onMount } from "svelte";

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
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="h-screen w-full overflow-hidden bg-cover bg-no-repeat">
    <h1 class="font-semibold text-[2rem] text-black py-12 pl-56 w-full">DramaQuick</h1>
    <div class="pl-56 pr-56">
    <div class="content bg-white w-full h-156 shadow rounded-2.5xl px-20 py-16">
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

    .content {
        display: grid;
    }

    .color {
        color: #666666;
    }
</style>