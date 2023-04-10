<script>
    export let textes = [];
</script>

<div class="textes-container">
    {#each textes as text}
        <div class="texte text-[1rem] text-[#272727]">
            <p>{text}</p>
        </div>
    {/each}
</div>

<style>
    .textes-container {
        max-height: 15rem;
        overflow-y: auto;
        width: 100%;
    }

    .texte  {
        border-bottom: 1px solid #E5E5E5;
        padding: 1rem 0;
    }

    .textes-container::-webkit-scrollbar {
        width: 4px;
    }

    .textes-container::-webkit-scrollbar-track {
        background: #deeee7;
    }

    .textes-container::-webkit-scrollbar-thumb {
        background-color: #47524e;
        border-radius: 10px;
    }
</style>