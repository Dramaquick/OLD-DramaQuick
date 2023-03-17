<script>
    let className = "";

    export { className as class };
    export let disabled = false;
    export let style = "";
    export let action = () => {};
    export let width = false;
</script>

{#if !width}
<button
    class="{className} h-14.5 px-8 text-[1.25rem] rounded-2.5l bg-[#34ffad] border-none outline-none transition-[.2s] text-[#0D241B] font-medium box-border"
    {...$$restProps}
    on:click={action}
    {disabled}
    {style}
>
    <slot />
</button>
{:else}
<button
    class="{className} button h-14.5 px-8 text-[1.25rem] rounded-2.5l bg-[#34ffad] border-none outline-none transition-[.2s] text-[#0D241B] font-medium box-border"
    {...$$restProps}
    on:click={action}
    {disabled}
    style="min-width: {width}rem;"
>
    <slot />
</button>
{/if}

<style>
    .button {
        min-width: var(--var-width);
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
