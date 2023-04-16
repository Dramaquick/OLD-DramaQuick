<script lang="ts">
    export let checked = false;
    export let value = null;
</script>

<input
    type="checkbox"
    {value}
    bind:checked={checked}
    class="w-7.2 h-7.2 border-3 border-[#00E589] border-solid rounded-2.5l cursor-pointer outline-none transition-[.2s] bg-center ease-in"
/>

<style>
    input[type="checkbox"]:checked {
        background: #00E589 url("/img/components/check.svg") no-repeat center 5px;
        background-size: 70%;
    }

    input[type="checkbox"]:focus {
        box-shadow: none;
    }
</style>
