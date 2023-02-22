<script>
    let className = "";

    export { className as class };
    export let href = "";
    export let style = "";
</script>

<a {href} class="{className} inline-block relative font-normal text-[1.125rem] text-[#00E589] no-underline" {...$$restProps} {style}>
    <slot />
</a>

<style>
    a::after {

        content: '';
        position: absolute;
        width: 100%;
        transform: scaleX(0);
        height: 2px;
        bottom: -5px;
        left: 0;
        background-color: #00E589;
        transform-origin: bottom right;
        transition: transform 0.25s ease-out;

    }

    a:hover::after {

        transform: scaleX(1);
        transform-origin: bottom left;

    }
</style>