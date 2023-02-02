<script>
    let className = "";

    export { className as class };
    export let disabled = false;
    export let name = "";
    export let value = "";
    export let placeholder = "";
    export let required = false;
    export let autocomplete = "off";
    export let pattern = "";
    export let minlength = "";
    export let maxlength = "";
</script>


<div>
    <img src="~/img/components/tirets.svg" alt="Tirets">
    <input type="text"
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
    >
</div> 

<style>

    input[type="text"] {

        height: 3rem;
        width: 16rem;
        font-size: 1rem;
        border-radius: 4px;
        background: white;
        border: 3px solid #DEEEE7;
        color: #0D241B;
        font-family: 'Noto Sans';
        font-weight: 400;
        box-sizing: border-box;

    }

    input[type="text"]::placeholder{

        color: #BABABA;

    }

</style>