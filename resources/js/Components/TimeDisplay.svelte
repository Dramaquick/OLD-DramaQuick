<script>
    export let minutes = 0;
    export let seconds = 0;

    let minuteString;
    let secondString;

    $: minuteString = minutes.toString().padStart(2, '0');
    $: secondString = seconds.toString().padStart(2, '0');
</script>

<div class="time-display">
    <div class="minutes">
        <div class={`digit ${ minuteString[0] === '0' ? "isZero" : "" }`}>
            {minuteString[0]}
        </div>
        <div class={`digit ${ minuteString[1] === '0' ? "isZero" : "" }`}>
            {minuteString[1]}
        </div>
    </div>
    <div class="colon">
        :
    </div>
    <div class="seconds">
        <div class={`digit ${ secondString[0] === '0' ? "isZero" : "" }`}>
            {secondString[0]}
        </div>
        <div class={`digit ${ secondString[1] === '0' ? "isZero" : "" }`}>
            {secondString[1]}
        </div>
    </div>
</div>

<style>
    .time-display {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 2rem;
    }

    .minutes,
    .seconds {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .digit {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3.5rem;
        height: 4.25rem;
        border-radius: 8px 8px 0 0;
        background-color: #f3f3f3;
        margin: 0.25rem;
        position: relative;
    }

    .digit.isZero {
        color: #ADADAD;
    }

    .digit::after {
        content: '';
        display: block;
        position: absolute;
        top: calc(100% - 0.3rem);
        left: 0;
        width: 100%;
        height: 0.3rem;
        border-radius: 0 0 8px 8px;
        background-color: #00E589;
    }

    .colon {
        margin: 0 0.5rem;
        color: #ADADAD;
    }
</style>
