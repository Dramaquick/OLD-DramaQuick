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


<div class="text-input">
    <img src="/img/components/tirets.svg" alt="Tirets">
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


    img {
        width: 1.7rem;
    }

    .text-input {

        height: 3rem;
        width: 16rem;
        border-radius: 4px;
        background: white;
        border: 2px solid #DEEEE7;
        color: #0D241B;
        font-family: 'Noto Sans';
        font-weight: 400;
        box-sizing: border-box;
        padding: 0.5rem .75rem;
        display: flex;
        align-items: center;
        justify-content: space-between;

    }

    input[type="text"] {
        border: none;
        outline: none;
        background: transparent;
        width: 90%;
        box-shadow: none;
        font-size: 1rem;
    }

    input[type="text"]::placeholder {

        color: #BABABA;

    }

</style>
