<script>
    let className = "";

    export { className as class };
    export let disabled = false;
</script>

<button
    class="{className}"
    {...$$restProps}
    on:click
    {disabled}
>
    <slot />
</button>

<style>
    button {

        height: 3.625rem;
        padding: 0 2rem;
        font-size: 1.25rem;
        border-radius: 10px;
        background: #34ffad;
        border: none;
        outline: none;
        transition: .2s;
        color: #0D241B;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        box-sizing: border-box;

    }

    button:hover {

        transform: translateY(-5px);
        box-shadow: #d0dbd7 0px 5px 12px;

    }
    .outline{

        background-color: transparent;
        border: 4px solid #15EF97;
        color: #15EF97;

    }

    button:disabled{

        background-color: #d0dbd7;
        color: #a7aeab;
        cursor: not-allowed;

    }

    button:disabled:hover{

        transform: translateY(0px);
        box-shadow: none;
        
    }

    .outline:disabled{
            
        border: 4px solid #a7aeab;
        background-color: transparent;

    }
</style>
