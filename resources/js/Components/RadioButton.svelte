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
        height: 1.4375rem;
        width: 1.4375rem;
        box-sizing: border-box;
        border: 3px solid #dfdfdf;
        border-radius: 50px;
        color: white;

    }

    input[type="radio"]:checked {

        border: 6px solid #00E689;

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


