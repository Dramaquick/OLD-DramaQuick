<script>
    export let checked = false;
    export let value = null;
</script>

<input
    type="checkbox"
    {value}
    bind:checked={checked}
/>

<style>
    input[type="checkbox"] {
        width: 1.8rem;
        height: 1.8rem;
        border: 3px solid #00E689;
        border-radius: 10px;
        cursor: pointer;
        outline: none;
        position: relative;
    }

    input[type="checkbox"]:checked {
        background: #00E589 url("/img/components/check.svg") no-repeat center;
        background-size: 70%;
    }

    input[type="checkbox"]:focus {
        box-shadow: none;
    }
</style>
