<script>
    import clickOutside from './util/clickOutside.js';
    import { createEventDispatcher, onMount } from 'svelte';

    const dispatch = createEventDispatcher();

    let className = "";
    let wrapperClassName = "";

    export { wrapperClassName as wrapperClass };
    export { className as class };
    export let disabled = false;
    export let name = "";
    export let value = "";
    export let placeholder = "Placeholder";
    export let required = false;
    export let autocomplete = "off";
    export let pattern = null;
    export let minlength = null;
    export let maxlength = null;
    export let showIcon = true;
    export let style = "";
    export let type = "text";

    function onInput() {
        dispatch("input", value);
    }

    let focused = false;
</script>


<div class:focused={focused} class={`text-input ${wrapperClassName ?? ""}`} use:clickOutside on:outclick={() => focused = false} on:click={() => focused = true} {style}>
    {#if showIcon}
        <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.89575 3.5C1.89575 3.25838 2.09163 3.0625 2.33325 3.0625H11.6666C11.9082 3.0625 12.1041 3.25838 12.1041 3.5C12.1041 3.74162 11.9082 3.9375 11.6666 3.9375H2.33325C2.09163 3.9375 1.89575 3.74162 1.89575 3.5Z" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.89575 7C1.89575 6.75838 2.09163 6.5625 2.33325 6.5625H11.6666C11.9082 6.5625 12.1041 6.75838 12.1041 7C12.1041 7.24162 11.9082 7.4375 11.6666 7.4375H2.33325C2.09163 7.4375 1.89575 7.24162 1.89575 7Z"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.89575 10.5C1.89575 10.2584 2.09163 10.0625 2.33325 10.0625H9.33325C9.57488 10.0625 9.77075 10.2584 9.77075 10.5C9.77075 10.7416 9.57488 10.9375 9.33325 10.9375H2.33325C2.09163 10.9375 1.89575 10.7416 1.89575 10.5Z"/>
        </svg>
    {/if}
    {#if type === "password"}
        <input type="password"
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
        on:input={onInput}
        />
    {:else}
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
        on:input={onInput}
        />
    {/if}
</div>

<style>


    svg {
        width: 1.7rem;
        transform: scale(1.8);
        fill: #BABABA;
        transition: all 0.2s ease;
    }

    .text-input {

        height: 3rem;
        min-width: 16rem;
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
        transition: all 0.2s ease;

    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus, 
    input:-webkit-autofill:active{
        box-shadow: 0 0 0 30px white inset !important;
        background: transparent !important;
    }

    input[type="text"],input[type="password"] {
        border: none;
        outline: none;
        background: transparent;
        width: 100%;
        box-shadow: none;
        font-size: 1rem;
    }

    input[type="text"]::placeholder {

        color: #BABABA;

    }

    input[type="password"]::placeholder {

        color: #BABABA;

    }

    .text-input.focused {
        border-color: #00E589;
        box-shadow: 0 0 2px #00E589;
    }

    .text-input.focused svg {
        fill: #00E589;
    }

</style>
