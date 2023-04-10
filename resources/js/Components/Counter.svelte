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

<div class="flex flex-row justify-center items-center w-32 h-17 bg-white border-2 border-vert-pale border-solid rounded box-border font-[Noto Sans] font-bold text-[1.5rem]"
    >
    {#if value >= min}
    <div class="flex items-center justify-center w-full h-full">
        <button class="{`${ value === min ? "fill-white-gray cursor-not-allowed" : "" }`} h-full" on:click={() => no_min(value)}>
            <svg width="18" height="15" viewBox="0 0 9 6" fill='none' xmlns="http://www.w3.org/2000/svg">
                <path class="{`${ value === min ? "fill-white-gray cursor-not-allowed" : "" }`}" d="M0.722304 1.82842L1.91605 0.555557L4.69453 3.51957L7.473 0.555557L8.66675 1.82842L5.68913 5.00488C5.55853 5.14424 5.40347 5.25478 5.23282 5.3302C5.06216 5.40563 4.87925 5.44445 4.69453 5.44445C4.5098 5.44445 4.32689 5.40563 4.15624 5.3302C3.98558 5.25478 3.83052 5.14424 3.69992 5.00488L0.722304 1.82842Z" fill="#47524E"/>
            </svg>
        </button>
    </div>
    {/if}
    <p class="text-[#00E589]">{value}</p>
    {#if value <= max}
    <div class="flex items-center justify-center w-full h-full">
        <button class="{`${ value === max ? "fill-white-gray cursor-not-allowed" : "" }`} h-full" on:click={() => no_max(value)}>
            <svg width="18" height="15" viewBox="0 0 9 6" xmlns="http://www.w3.org/2000/svg">
                <path class="{`${ value === max ? "fill-white-gray cursor-not-allowed" : "" }`}" d="M8.2777 4.1716L7.08395 5.44446L4.30547 2.48045L1.527 5.44446L0.333252 4.1716L3.31087 0.995138C3.44147 0.85578 3.59653 0.745233 3.76718 0.669811C3.93784 0.594388 4.12075 0.555568 4.30547 0.555568C4.4902 0.555568 4.67311 0.594388 4.84376 0.669811C5.01442 0.745233 5.16948 0.85578 5.30008 0.995138L8.2777 4.1716Z" fill="#47524E"/>
            </svg>
        </button>
    </div>
    {/if}
</div>