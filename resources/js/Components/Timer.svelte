<script>
    export let minutes = 0;
    export let seconds = 0;

    let secondString;
    $: secondString = seconds.toString().padStart(2, '0');
</script>

<span class="flex items-center justify-start font-semibold text-[2.25rem] text-center text-black w-20">
{minutes}:{secondString}
</span>
