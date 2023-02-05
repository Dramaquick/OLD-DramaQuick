<script>
    export let value = 0;
    let max = 100;
    let min = 0;

    export { max as max }
    export { min as min }

    /**
     * Permet d'obtenir une valeur comprise entre un min et un max
    */
    const clamp = (val, min, max) => Math.min(Math.max(val, min), max);

    function updateVal(val, increment) {
        value = clamp(increment ? ++val : --val, min, max);
    }

    /**
     * 
     * @param {Event & { currentTarget: EventTarget & HTMLInputElement }} e
     */
    function validateInput(e) {
        value = clamp(value, min, max);
        value = parseInt(value.toString());
        e.currentTarget.value = value;
    }

</script>

<div class="box">
    <div class="down">
        <button class="{`${ value <= min ? "Disabled" : "" }`}" on:click={() => updateVal(value, false)}>
            <svg width="18" height="15" viewBox="0 0 9 6" fill='none' xmlns="http://www.w3.org/2000/svg">
                <path class="{`${ value <= min ? "Disabled" : "" }`}" d="M0.722304 1.82842L1.91605 0.555557L4.69453 3.51957L7.473 0.555557L8.66675 1.82842L5.68913 5.00488C5.55853 5.14424 5.40347 5.25478 5.23282 5.3302C5.06216 5.40563 4.87925 5.44445 4.69453 5.44445C4.5098 5.44445 4.32689 5.40563 4.15624 5.3302C3.98558 5.25478 3.83052 5.14424 3.69992 5.00488L0.722304 1.82842Z" fill="#47524E"/>
            </svg>
        </button>
    </div>
    <input type="number" class="number" {min} {max} bind:value={value} on:input={(e) => validateInput(e)}>
    <div class="up">
        <button class="{`${ value >= max ? "Disabled" : "" }`}" on:click={() => updateVal(value, true)}>
            <svg width="18" height="15" viewBox="0 0 9 6" xmlns="http://www.w3.org/2000/svg">
                <path class="{`${ value >= max ? "Disabled" : "" }`}" d="M8.2777 4.1716L7.08395 5.44446L4.30547 2.48045L1.527 5.44446L0.333252 4.1716L3.31087 0.995138C3.44147 0.85578 3.59653 0.745233 3.76718 0.669811C3.93784 0.594388 4.12075 0.555568 4.30547 0.555568C4.4902 0.555568 4.67311 0.594388 4.84376 0.669811C5.01442 0.745233 5.16948 0.85578 5.30008 0.995138L8.2777 4.1716Z" fill="#47524E"/>
            </svg>
        </button>
    </div>
</div>

<style>
    .box {
        display: inline-flex;
        flex-direction: line;
        align-items: center;
        justify-content: center;
        width: 8rem;
        height: 4.25rem;
        background: #FFFFFF;
        border: 2px solid #DEEEE7;
        border-radius: 4px;
        box-sizing: border-box;
        font-family: 'Noto Sans';
        font-style: normal;
        font-weight: 700;
        font-size: 24px;
        line-height: 12px;
    }

    .up {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .down {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .number {
        color: #00E589;
        font-size: 1.25rem;
        width: 100%;
        text-align: center;
        border: none;
        outline: none;
        box-shadow: none;
    }

    button {
        height: 100%;
    }

    .Disabled {
        fill: #cdd4d1;
        cursor: not-allowed;
    }

    input[type='number'] {
    -moz-appearance:textfield;
}

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

</style>