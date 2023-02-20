<script>
    import {lightenColor} from "@/Components/util/ColorUtil";

    export let text="none";
    export let emoji="❌";
    export let color="#34FFAD";
</script>

<span class="tag" style="--tag-color: {color}; --bg-color: {lightenColor(color, -25)}">
{emoji} {text.toUpperCase()}
</span>

<style>
    .tag {
        display: flex;
        align-items: center;
        justify-content: center;
        font-style: normal;
        font-weight: 600;
        font-size: 1rem;
        width: fit-content;
        height: fit-content;
        padding: .25rem 1rem;
        border-radius: 62px;
        color: #000000;
        background-color: var(--tag-color);
        transition: .2s;
        position: relative;
        z-index: 1;
    }

    .tag:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 1px var(--bg-color);
    }
</style>
