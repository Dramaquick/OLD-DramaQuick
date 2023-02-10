<script>
    let className = "";

    export { className as class };
    export let href = "";
    export let style = "";
</script>

<a {href} class="{className} hover-underline-animation" {...$$restProps} {style}>
    <slot />
</a>

<style>

    a {

        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        font-size: 18px;
        line-height: 27px;
        color: #00E589;
        text-decoration: none;
    
    }

    .hover-underline-animation {

        display: inline-block;
        position: relative;

    }

    .hover-underline-animation::after {

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

    .hover-underline-animation:hover::after {

        transform: scaleX(1);
        transform-origin: bottom left;

    }

</style>