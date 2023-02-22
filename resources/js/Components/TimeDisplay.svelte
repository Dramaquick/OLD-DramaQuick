<script>
    export let minutes = 0;
    export let seconds = 0;

    let minuteString;
    let secondString;

    $: minuteString = minutes.toString().padStart(2, '0');
    $: secondString = seconds.toString().padStart(2, '0');
</script>

<div class="flex items-center justify-center text-[2rem] font-medium ">
    <div class="flex items-center justify-center">
        <div class={`digit rounded-t-lg flex items-center justify-center w-14 h-17 bg-[#f3f3f3] m-1 relative ${ minuteString[0] === '0' ? "text-[#ADADAD]" : "" }`}>
            {minuteString[0]}
        </div>
        <div class={`digit rounded-t-lg flex items-center justify-center w-14 h-17 bg-[#f3f3f3] m-1 relative ${ minuteString[1] === '0' ? "text-[#ADADAD]" : "" }`}>
            {minuteString[1]}
        </div>
    </div>
    <div class="my-0 mx-2 text-[#ADADAD]">
        :
    </div>
    <div class="flex items-center justify-center">
        <div class={`digit rounded-t-lg flex items-center justify-center w-14 h-17 bg-[#f3f3f3] m-1 relative ${ secondString[0] === '0' ? "text-[#ADADAD]" : "" }`}>
            {secondString[0]}
        </div>
        <div class={`digit rounded-t-lg flex items-center justify-center w-14 h-17 bg-[#f3f3f3] m-1 relative ${ secondString[1] === '0' ? "text-[#ADADAD]" : "" }`}>
            {secondString[1]}
        </div>
    </div>
</div>

<style>
    .digit::after {
        content: '';
        display: block;
        position: absolute;
        top: calc(100% - 0.3rem);
        left: 0;
        width: 100%;
        height: 0.3rem;
        border-radius: 0 0 8px 8px;
        background-color: #00E589;
    }
</style>
