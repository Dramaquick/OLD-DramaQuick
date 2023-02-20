<script>
    export let minutes = 0;
    export let seconds = 0;

    let secondString;
    $: secondString = seconds.toString().padStart(2, '0');
</script>

<span class="timer">
{minutes}:{secondString}
</span>

<style>
    .timer {
        display: flex;
        align-items: center;
        justify-content: start;
        font-style: normal;
        font-weight: 600;
        font-size: 2.25rem;
        width: 100%;
        text-align: center;

        color: #000000;
    }
</style>
