<script>
    import 'animate.css';
    import { onMount, onDestroy } from "svelte";

    let mounted;

    onMount(() => {
        setTimeout(() => {
            mounted = true;
        }, 100);
    });

    onDestroy(() => {
        mounted = false;
    });
</script>

<!-- <div class="animate__animated absolute z-[999999] w-full h-full bg-[#2ef6a6] flex items-center justify-center {mounted ? 'animate__slideOutUp' : ''}">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        class="icon icon-tabler icon-tabler-loader-2 animate-spin text-white"
        width="40"
        height="40"
        viewBox="0 0 24 24"
        stroke-width="3"
        stroke="currentColor"
        fill="none"
        stroke-linecap="round"
        stroke-linejoin="round"
    >
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M12 3a9 9 0 1 0 9 9" />
    </svg>
</div>
<slot /> -->

<div class="animate__animated animate__fadeIn animate__faster">
    <slot />
</div>
