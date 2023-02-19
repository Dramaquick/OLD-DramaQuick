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
        justify-content: center;
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 600;
        font-size: 36px;
        line-height: 54px;

        color: #000000;
    }
</style>