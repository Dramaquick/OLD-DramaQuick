<script>
    import { inertia, page } from "@inertiajs/inertia-svelte";
    let classes;
    export let href;
    export let style = "";
    export let active;
    $: {
        classes = "nav-link inline-block py-2 px-4 font-normal text-[#666666] relative z-0 w-fit";
        classes += $page.url === href ? ' active' : '';
        console.log($page);
    }
</script>

<a use:inertia {href} class="{classes} hover-underline-animation py-2 px-4 inline-block relative" {...$$restProps} {style}>
    <slot />
</a>

<style>
    .nav-link.active::before {
        z-index: -1;
        color: black;
        width: 85%;
        position: absolute;
        bottom: 0.5rem;
        left: 7.5%;
        background-color: #34FFAD;
        height: 0.75rem;
        content: " ";
    }

    .hover-underline-animation::after {
        content: '';
        position: absolute;
        width: 85%;
        transform: scaleX(0);
        height: 2px;
        bottom: 5px;
        left: 7.5%;
        background-color: #666666;
        transform-origin: bottom right;
        transition: transform 0.25s ease-out;
    }

    .hover-underline-animation:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    .active.hover-underline-animation::after {
        background-color: transparent;
    }
</style>
