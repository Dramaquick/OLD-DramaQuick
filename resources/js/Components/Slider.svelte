<script>
    import RangeSlider from "svelte-range-slider-pips";
    let sliderType = "simple";

    export { sliderType as type };
    export let values;
    export let stiffness = 0;
    export let damping = 0;
    export let max = 100;
    export let min = 0;
    export let vertical = false;
</script>

<div class="globalrange">
{#if sliderType == "simple"}
<div class="simplestyle">
    <RangeSlider range="min" bind:values={values} {vertical} float="true" springValues={stiffness,damping} {max} {min}/>
</div>
{:else}
<div class="doublestyle">
    <RangeSlider bind:values={values} pushy range="true" float="true" springValues={stiffness,damping} {max} {min}/>
</div>
{/if}
</div>

<style>

    .globalrange {
        width: 15rem;
    }

    .doublestyle :global(.rangeSlider .rangeBar) {

        background-color: #00e589;

    }

    .doublestyle :global(.rangeSlider .rangeNub) {

        background-color: #00e589;

    }

    .doublestyle :global(.rangeSlider.range .rangeNub) {

        border: 4px solid #FFFFFF;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.15);
        border-radius: 50px;
        box-sizing: border-box;
        cursor: pointer;
        
    }

    .doublestyle :global(.rangeSlider .rangeHandle.active .rangeNub) {

        box-shadow: rgba(0, 0, 0, 0.30) 0px 5px 12px;
        background-color: #00e589;
        -webkit-box-shadow: rgba(0, 0, 0, 0.30) 0px 5px 12px;

    }

    .doublestyle :global(.rangeSlider) {

        --handle: none;

    }

    .doublestyle :global(.rangeSlider .rangeFloat) {

        background-color: #0D241B;

    }

    .doublestyle :global(.rangeSlider.focus .rangeFloat) {

        background-color: #0D241B;

    }

    .simplestyle :global(.rangeSlider .rangeBar) {
        
        background-color: #00e589;
        
    }
    
    .simplestyle :global(.rangeSlider .rangeNub) {
    
        background-color: #00e589;
    
    }
    
    .simplestyle :global(.rangeSlider.range .rangeNub) {
    
        border: 4px solid #FFFFFF;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.15);
        border-radius: 50px;
        box-sizing: border-box;
        cursor: pointer;
    
    }
    
    .simplestyle :global(.rangeSlider .rangeHandle.active .rangeNub) {
    
        box-shadow: rgba(0, 0, 0, 0.30) 0px 5px 12px;
        background-color: #00e589;
        -webkit-box-shadow: rgba(0, 0, 0, 0.30) 0px 5px 12px;
    
    }
    
    .simplestyle :global(.rangeSlider) {
    
        --handle: none;
    
    }
    
    .simplestyle :global(.rangeSlider .rangeFloat) {
    
        background-color: #0D241B;
    
    }
    
    .simplestyle :global(.rangeSlider.focus .rangeFloat) {
    
        background-color: #0D241B;
    
    }

</style>