<script>
    import Timer from "../../Components/Timer.svelte";
    import { onMount } from "svelte";

    // Décompteur en temps réel pour Timer
    let timer = {
        minutes: 10,
        seconds: 0,
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

<main>
    <Timer
            bind:minutes={timer.minutes}
            bind:seconds={timer.seconds}
        />
</main>

<style>
    main {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
</style>