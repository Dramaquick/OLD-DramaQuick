<script>
    import {lightenColor} from "@/Components/util/ColorUtil";

    export let tag = {
        text: "none",
        emoji: "❌",
        color: "#34FFAD",
    };
</script>

<span class="tag flex flex-row items-center justify-center font-semibold text-[1rem] w-fit h-fit py-[.25rem] px-4 rounded-62px text-black transition-[.2s] relative z-1" style="--tag-color: {tag.color}; --bg-color: {lightenColor(tag.color, -25)}">
{tag.emoji} {tag.text.toUpperCase()}
</span>

<style>
    .tag {
        background-color: var(--tag-color);
        min-width: fit-content;
    }

    .tag:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 1px var(--bg-color);
    }
</style>
