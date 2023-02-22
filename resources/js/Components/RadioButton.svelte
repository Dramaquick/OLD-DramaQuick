<script>
    let className = "";

    export { className as class };
    export let disabled = false;
    export let selected;
    export let name = "";
    export let value = "";

</script>

<input type="radio"
    class="{className}"
    {...$$restProps}
    {name}
    {value}
    bind:group={selected}
    {disabled}
    >

<style>

    input[type="radio"] {

        background: transparent;
        height: 1.5rem;
        width: 1.5rem;
        box-sizing: border-box;
        border: 3px solid #dfdfdf;
        border-radius: 50px;
        color: white;
        position: relative;

    }

    input[type="radio"]::after {
        content: "";
        position: absolute;
        width: 1.5rem;
        height: 1.5rem;
        top: 50%;
        left: 50%;
        border: 6px solid #00E689;
        border-radius: 50px;
        opacity: 0;
        transition: .2s;
        transform: translate(-50%, -50%) scale(0.2);
    }

    input[type="radio"]:checked::after {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
    
    input[type="radio"]:disabled {

        border: 3px solid #797979;
        cursor: not-allowed;

    }

    input[type="radio"]:checked:disabled {

        border: 6px solid #797979;
        cursor: not-allowed;

    }

    input[type="radio"]:focus {
        box-shadow: none;
    }

</style>


