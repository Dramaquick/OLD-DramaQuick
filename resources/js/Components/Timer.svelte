<script>
    export let minutes = 0;
    export let seconds = 0;

    let secondString;
    $: secondString = seconds.toString().padStart(2, '0');
</script>

<span class="timer">
    <p>{minutes}:</p>
    <p>{secondString}</p>
</span>

<style>
    .timer {
        display: flex;
        align-items: center;
        justify-content: start;
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 600;
        font-size: 2.25rem;
        line-height: 3.375rem;
        width: 75px;

        color: #000000;
    }
</style>