<script>
    export let minutes = 0;
    export let seconds = 0;

    let secondString;
    $: secondString = seconds.toString().padStart(2, '0');
</script>

<div class="flex gap-4 items-end">
<span class="flex items-end justify-start font-semibold text-[2.25rem] text-center text-black w-20">
{minutes}:{secondString} 
</span>
<p class="text-[1.5rem] text-[#666666] font-normal w-fit h-12 flex items-center">restantes</p>
</div>