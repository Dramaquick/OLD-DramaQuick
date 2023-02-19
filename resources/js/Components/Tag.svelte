<script>
    export let text="none";
    export let emoji="❌";
    export let color="#34FFAD";
</script>

<span class="tag" style="background-color: {color};">
{emoji}{text.toUpperCase()}
</span>

<style>
    .tag {
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 600;
        font-size: 0.9375rem;
        line-height: 1.4375rem;
        width: fit-content;
        height: fit-content;
        padding: 5px 16px;
        border-radius: 62px;
        padding-left: 0.625rem;
        color: #000000;
    }
</style>