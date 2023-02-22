<script>
    import {lightenColor} from "@/Components/util/ColorUtil";

    export let text="none";
    export let emoji="❌";
    export let color="#34FFAD";
</script>

<span class="tag flex items-center justify-center font-semibold text-[1rem] w-fit h-fit py-[.25rem] px-4 rounded-62px text-black transition-[.2s] relative z-1" style="--tag-color: {color}; --bg-color: {lightenColor(color, -25)}">
{emoji} {text.toUpperCase()}
</span>

<style>
    .tag {
        background-color: var(--tag-color);
    }

    .tag:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 1px var(--bg-color);
    }
</style>
