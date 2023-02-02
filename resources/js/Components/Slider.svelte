<script>
    let className = "";

    export { className as class };
    export let disabled = false;
    export let name = "";
    export let value = "";
    export let min = 0;
    export let max = 100;
    export let step = 1;
</script>

<input type="range"
    class="{className}"
    {...$$restProps}
    {name}
    bind:value={value}
    {min}
    {max}
    {step}
    {disabled}
    >

<style>

    input[type="range"] {
        
        height: 0.5rem;
        border-radius: 5px;
        background: #E8E8E8;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    
    input[type=range]::-webkit-slider-thumb {
                
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 1.40625rem;
        height: 1.40625rem;
        background: #00E689;
        border: 4.5px solid #FFFFFF;
        border-radius: 50px;
        cursor: pointer;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.15);
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.15);
                
    }

    input[type=range]:active::-webkit-slider-thumb  {
            
        -webkit-box-shadow: rgba(0, 0, 0, 0.30) 0px 5px 12px;
        box-shadow: rgba(0, 0, 0, 0.30) 0px 5px 12px;
            
    }

    input[type=range]:disabled::-webkit-slider-thumb  {
            
        background: #797979;
        cursor: not-allowed;
            
    }

    input[type=range]:disabled:active::-webkit-slider-thumb  {
            
        -webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.15);
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.15);
                
    }

</style>