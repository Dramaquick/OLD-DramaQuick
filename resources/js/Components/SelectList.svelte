<script>
    import clickOutside from './util/clickOutside.js';

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

    // Placeholder par défaut
    export let placeholder = 'Select';
    // Valeur sélectionnée par défaut
    export let value = -1;

    /*
    📍 Variables du composant
     */

    // Permet de savoir si la liste est ouverte ou non
    let isOpen = false;

    // Permet de modifier le style de la liste quand elle est fermée
    let closed = "closed";

    // Permet de récupérer la référence HTML de la liste
    let scrollDiv;

    // Permet de fermer la liste (supprimer le border & padding)
    $: if(!isOpen) {
        setTimeout(() => {
            closed = "closed";
        }, 200);
    } else {
        // Permet de remettre le scroll en haut quand on ouvre la liste et rafficher le border & padding
        scrollDiv.scrollTop = 0;
        closed = "";
    }
</script>

<div class={`select-list ${isOpen ? "open" : ""}`} use:clickOutside on:outclick={() => isOpen = false}>
    <div class="selected-item" on:click={() => isOpen = !isOpen }>
        {#if value}
            <div class="selected-item__text">{items.find(item => item.id === value).name}</div>
        {:else}
            <div class="selected-item__text placeholder">{placeholder}</div>
        {/if}
        <div class={`selected-item__icon ${isOpen ? "open" : ""}`}>
            <svg width="9" height="6" viewBox="0 0 9 6" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.722304 1.82842L1.91605 0.555557L4.69453 3.51957L7.473 0.555557L8.66675 1.82842L5.68913 5.00488C5.55853 5.14424 5.40347 5.25478 5.23282 5.3302C5.06216 5.40563 4.87925 5.44445 4.69453 5.44445C4.5098 5.44445 4.32689 5.40563 4.15624 5.3302C3.98558 5.25478 3.83052 5.14424 3.69992 5.00488L0.722304 1.82842Z"/>
            </svg>
        </div>
    </div>
    <div bind:this={scrollDiv} class={`select-items ${isOpen ? "open" : ""} ${closed}`}>
        {#each items as item (item.id)}
            <div class="select-item" on:click={() => {value = item.id; isOpen = !isOpen}} >
                <div class="select-item__text">{item.name}</div>
            </div>
        {/each}
    </div>
</div>

<style>
    .select-list {
        position: relative;
        width: clamp(13rem, 100%, 20rem);
        height: 3.5rem;
        border: 2px solid #DEEEE7;
        border-radius: 8px;
        padding: 0 .75rem;
        font-weight: 500;
        box-sizing: border-box;
    }

    .select-list.open {
        border-color: #00E589;
        box-shadow: 0 0 2px #00E589;
    }

    .select-list.open .selected-item__icon svg {
        fill: #00E589;
    }

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

    .selected-item__icon svg {
        transform: scale(1.5);
    }

    .select-items {
        position: absolute;
        top: 120%;
        left: 0;
        width: 100%;
        height: 0;
        overflow: hidden;
        transition: height 0.3s ease;
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

    .select-items.open {
        height: 200px;
        overflow: auto;
    }

    .select-items.closed {
        border: none;
        padding: 0;
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
    }

    .select-item__text:hover {
        background-color: #00E58920;
        color: #00E589;
    }
</style>
