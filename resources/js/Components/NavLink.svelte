<script>
    import { inertia, page } from "@inertiajs/inertia-svelte";
    let classes;
    export let href;
    export let active;
    $: {
        classes = "nav-link";
        classes += $page.url === href ? ' active' : '';
        console.log($page);
    }
</script>

<a use:inertia {href} class={classes}>
    <slot />
</a>

<style>
    .nav-link {
        display: inline-block;
        padding: 0.5rem 1rem;
        color: #666666;
        position: relative;
        z-index: 0;
        width: fit-content;
    }
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
</style>
