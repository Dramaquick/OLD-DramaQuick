<script>
    import { inertia, page } from "@inertiajs/svelte";
    let classes;
    export let href;
    export let style = "";
    export let action = () => {};
    export let type = "link";
    export let inertiaction = {};
    export let activate = false;

    $: {
        classes = "nav-link inline-block py-2 px-4 font-normal text-[#666666] relative z-0 w-fit hover-underline-animation py-2 px-4 inline-block relative";
        classes += $page.url === href ? ' active' : '';
        classes += activate ? ' active' : '';
        classes += type === "button" ? ' flex' : '';
    }
</script>

{#if type === "link"}
    <a use:inertia {href} class={classes} {...$$restProps} {style} on:click={action}>
        <slot />
    </a>
{:else if type === "button"}
    <button use:inertia={inertiaction} {href} class={classes} {...$$restProps} {style} on:click={action}>
        <slot />
    </button>
{/if}

<style>
    .nav-link.active::before {
        z-index: -1;
        color: black;
        width: 85%;
        position: absolute;
        bottom: 0rem;
        transform: translate(-50%, -60%);
        left: 50%;
        background-color: #34FFAD;
        height: 0.75rem;
        content: " ";
    }

    .hover-underline-animation::after {
        content: '';
        position: absolute;
        width: -webkit-fill-available;
        transform: scaleX(0) ;
        height: 2px;
        bottom: calc(.75rem / 2 + 2px);
        left: 0;
        background-color: #666666;
        transform-origin: bottom right;
        transition: transform 0.25s ease-out;
        margin: 0 1rem;
    }

    .hover-underline-animation:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
        margin: 0 1rem;
    }

    .active.hover-underline-animation::after {
        background-color: transparent;
    }
</style>
