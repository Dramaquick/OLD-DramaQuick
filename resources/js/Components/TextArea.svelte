<script>
    let className = "";

    export { className as class };
    export let disabled = false;
    export let name = "";
    export let value = "";
    export let placeholder = "Placeholder";
    export let required = false;
    export let autocomplete = "off";
    export let pattern = "";
    export let minlength = "";
    export let maxlength = "";
</script>

<div class="area">
<textarea
    class="{className}"
    {...$$restProps}
    {name}
    bind:value={value}
    {placeholder}
    {required}
    {autocomplete}
    {pattern}
    {minlength}
    {maxlength}
    {disabled}
    />
</div>

<style>
    .area {
        height: 7.125rem;
        width: 25.625rem;
        border-radius: 4px;
        background: white;
        border: 2px solid #DEEEE7;
        box-sizing: border-box;
        padding: 0.25rem .5rem;
    }

    textarea {

        appearance: none;
        background: transparent;
        border: none;
        width: 100%;
        height: 100%;
        resize: none;
        font-family: 'Noto Sans';
        font-style: normal;
        font-weight: 400;
        font-size: 1rem;
        color: #0D241B;

    }

    textarea::placeholder {

        color: #BABABA;

    }

    textarea:focus {

        box-shadow: none;

    }

    /* Firefox */
    textarea {
        scrollbar-width: auto;
        scrollbar-color: #48db9b #deeee7;
        
    }

    /* Chrome, Edge, and Safari */
    textarea::-webkit-scrollbar {
        width: 4px;
    }

    textarea::-webkit-scrollbar-track {
        background: #deeee7;
    }

    textarea::-webkit-scrollbar-thumb {
        background-color: #47524e;
        border-radius: 10px;
    }
</style>