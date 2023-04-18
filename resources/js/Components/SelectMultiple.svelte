<script lang="ts">

    /*
    🌐 Attributs du composant
     */

    // Liste des items
    export let items = [
        {id: 1, name: 'Item 1'},
        {id: 2, name: 'Item 2'},
        {id: 3, name: 'Item 3'},
        {id: 4, name: 'Item 4'},
        {id: 5, name: 'Item 5'},
        {id: 6, name: 'Item 6'},
        {id: 7, name: 'Item 7'},
        {id: 8, name: 'Item 8'},
        {id: 9, name: 'Item 9'},
        {id: 10, name: 'Item 10'}
    ];

    export let max: number = 3;

    let items_selected = {};

    items.forEach(element => {
        items_selected[element.id] = false;
    });

    // Valeur sélectionnée par défaut
    export let values = [];

    /*
    📍 Fonctions du composant
    */

    function toggleItem(id) {
        if (id != -1) {
            if (values.includes(id)) {
                values = values.filter(value => value !== id);
                items_selected[id] = false;
            } else {
                if (values.length >= max) {
                    return;
                } else {
                    values.push(id);
                    items_selected[id] = true;
                }
            }
        } else {
            return;
        }
    }

    // Permet de récupérer la référence HTML de la liste
    let scrollDiv;
</script>

<div bind:this={scrollDiv} class={`select-items open`}>
    {#each items as item (item.id)}
        <!-- svelte-ignore a11y-click-events-have-key-events -->
        <div class="select-item" on:click={() => {toggleItem(item.id)}}>
            <div class="select-item__text {items_selected[item.id] === true ? 'selected' : ''}">{item.name}</div>
        </div>
    {/each}
</div>

<style>
    .selected-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
        cursor: pointer;
    }

    .selected-item__text {
        font-size: .9rem;
        font-family: 'Noto Sans', sans-serif;
        color: #47524e;
        width: 85%
    }

    .selected-item__text.placeholder {
        color: #BABABA;
    }

    .selected-item__icon {
        width: 15%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .selected-item__icon.open {
        transform: rotate(180deg);
    }

    .select-items {
        top: 120%;
        left: 0;
        width: 11.9rem;
        height: 135px;
        overflow: auto;
        background-color: white;
        box-sizing: border-box;
        border-radius: 8px;
        border: 2px solid #DEEEE7;
        padding: .5rem 0;
    }

    /* Firefox */
    .select-items {
        scrollbar-width: auto;
        scrollbar-color: #48db9b #deeee7;
    }

    /* Chrome, Edge, and Safari */
    .select-items::-webkit-scrollbar {
        width: 4px;
    }

    .select-items::-webkit-scrollbar-track {
        background: #deeee7;
    }

    .select-items::-webkit-scrollbar-thumb {
        background-color: #47524e;
        border-radius: 10px;
    }

    .select-item {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        height: 2.5rem;
        padding: .1rem .5rem 0;
        cursor: pointer;
    }

    .select-item__text {
        font-size: .9rem;
        color: #829A90;
        padding: .4rem .5rem;
        border-radius: 8px;
        width: 100%;
        border: 2px solid transparent;
        box-sizing: border-box;
    }

    .select-item__text:hover {
        background-color: #00E58920;
        color: #00E589;
    }

    .select-item__text.selected {
        background-color: #00E58920;
        color: #00E589;
        border: 2px solid #00E589;
        box-sizing: border-box;
    }
</style>
