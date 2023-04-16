<script>
    import { onMount } from "svelte";
    export let minutes = 0;
    export let seconds = 0;

    export let action = [{ time: [minutes, seconds], action: () => {} }];

    let secondString;
    $: secondString = seconds.toString().padStart(2, "0");

    let mainAction = {};

    let index = 0;

    function nextAction() {
        if (index < action.length) {
            mainAction = action[index];
            index++;
        } else {
            mainAction = { time: [minutes, seconds], action: () => {} };
        }
    }

    nextAction();

    onMount(() => {
        let interval = setInterval(() => {
            if (seconds > 0) {
                seconds--;
            } else if (minutes > 0) {
                minutes--;
                seconds = 59;
            } else {
                clearInterval(interval);
            }

            if (
                mainAction.time[0] == minutes &&
                mainAction.time[1] == seconds
            ) {
                mainAction.action();
                nextAction();
            }
        }, 1000);
    });
</script>

<div class="flex gap-4 items-end">
    <span
        class="flex items-end justify-start font-semibold text-[2.25rem] text-center text-black w-20"
    >
        {minutes}:{secondString}
    </span>
    <p
        class="text-[1.5rem] text-[#666666] font-normal w-fit h-12 flex items-center"
    >
        restantes
    </p>
</div>
