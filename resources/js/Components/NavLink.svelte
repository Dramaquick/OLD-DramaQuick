<script>
    import { inertia, page } from "@inertiajs/inertia-svelte";
    let classes;
    export let href;
    export let style = "";
    $: {
        classes = "nav-link inline-block py-2 px-4 font-normal text-[#666666] relative z-0 w-fit hover-underline-animation py-2 px-4 inline-block relative";
        classes += $page.url === href ? ' active' : '';
        console.log($page);
    }
</script>

<a use:inertia {href} class={classes} {...$$restProps} {style}>
    <slot />
</a>

<style>
    .nav-link.active::before {
        z-index: -1;
        color: black;
        width: 85%;
        position: absolute;
        bottom: 1rem;
        left: 7.5%;
        background-color: #34FFAD;
        height: 0.75rem;
        content: " ";
    }

    .hover-underline-animation::after {
        content: '';
        position: absolute;
        width: -webkit-fill-available;
        transform: scaleX(0);
        height: 2px;
        bottom: 12px;
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
