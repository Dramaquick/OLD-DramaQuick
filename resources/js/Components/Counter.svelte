<script>
    export let value = 0;
    let max = 100;
    let min = 0;

    export { max as max }
    export { min as min }

    function no_min() {
        if (value <= min) {
            value = min;
        }
        else {
            value--;
        }
    }

    function no_max() {
        if (value >= max) {
            value = max;
        }
        else {
            value++;
        }
    }

</script>

<div class="box"
    >
    <div class="down">
        {#if value >= min}
        <button on:click={() => no_min(value)}><svg width="18" height="15" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.722304 1.82842L1.91605 0.555557L4.69453 3.51957L7.473 0.555557L8.66675 1.82842L5.68913 5.00488C5.55853 5.14424 5.40347 5.25478 5.23282 5.3302C5.06216 5.40563 4.87925 5.44445 4.69453 5.44445C4.5098 5.44445 4.32689 5.40563 4.15624 5.3302C3.98558 5.25478 3.83052 5.14424 3.69992 5.00488L0.722304 1.82842Z" fill="#47524E"/>
            </svg>
            </button>
        {/if}
    </div>
    <p class="number">{value}</p>
    <div class="up">
        {#if value <= max}
            <button on:click={() => no_max(value)}><svg width="18" height="15" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.2777 4.1716L7.08395 5.44446L4.30547 2.48045L1.527 5.44446L0.333252 4.1716L3.31087 0.995138C3.44147 0.85578 3.59653 0.745233 3.76718 0.669811C3.93784 0.594388 4.12075 0.555568 4.30547 0.555568C4.4902 0.555568 4.67311 0.594388 4.84376 0.669811C5.01442 0.745233 5.16948 0.85578 5.30008 0.995138L8.2777 4.1716Z" fill="#47524E"/>
                </svg>
                </button>
        {/if}
    </div>
</div>

<style>
    .box {
        display: flex;
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
    }

    button {
        height: 100%;
    }

</style>