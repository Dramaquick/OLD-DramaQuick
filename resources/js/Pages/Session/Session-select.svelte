<script>
    import Timer from "../../Components/Timer.svelte";
    import SelectList from "../../Components/SelectList.svelte";
    import Button from "../../Components/Button.svelte";

    // Décompteur en temps réel pour Timer
    let timer = {
        minutes: 1,
        seconds: 10,
    };

    let items = [
        {id: 1, name: 'Choix 1'},
        {id: 2, name: 'Choix 2'},
        {id: 3, name: 'Choix 3'},
        {id: 4, name: 'Choix 4'},
        {id: 5, name: 'Choix 5'},
        {id: 6, name: 'Choix 6'},
        {id: 7, name: 'Choix 7'},
        {id: 8, name: 'Choix 8'},
        {id: 9, name: 'Choix 9'},
        {id: 10, name: 'Choix 10'}
    ];

    let text = {
        session: "#35878454",
        page: "4/10",
        title: "Pourquoi le Japon ?",
        description: "Bah oui c'est vrai mdr",
        placeholder: "Blablabla"
    }

    let form = {
        selectValue: "",
    }
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="h-screen w-full overflow-hidden bg-cover bg-no-repeat">
    <h1 class="font-semibold text-[2rem] text-black py-12 pl-56 w-full">DramaQuick</h1>
    <div class="pl-56 pr-56">
    <div class="grid bg-white w-full h-156 shadow rounded-2.5xl px-20 py-16">
        <div>
            <p class="session text-[1.5rem] color font-normal w-fit">Session {text.session}</p>
            <h1 class="title py-2 w-144 font-semibold text-[2.25rem] w-fit">{text.title}</h1>
            <h2 class="desc bordered pl-6 w-144 font-normal text-[1.5rem] h-fit w-fit">{text.description}</h2>
        </div>
        <p class="page font-semibold text-[1.5rem] text-black text-right">{text.page}</p>
        <div class="selectlist flex justify-center">
            <SelectList
                bind:value={form.selectValue}
                placeholder="Sélectionnez une valeur..."
                items={items}
            />
        </div>
        <div class="timer-tags flex flex-row items-end gap-1">
            <Timer
                bind:minutes={timer.minutes}
                bind:seconds={timer.seconds}
            />
        </div>
        <div class="button flex justify-end items-end">
            <Button class="outline">Quitter la session</Button>
        </div>
    </div>
    </div>
</main>

<style>
    main {
        background-image: url(/img/landing/back.png);
    }

    .shadow {
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    .color {
        color: #666666;
    }

    .session {
        grid-row: 1;
        grid-column: 1;
    }

    .page {
        grid-row: 1;
        grid-column: 2;
    }

    .title {
        grid-row: 1;
        grid-column: 1;
    }

    .desc {
        grid-row: 1;
        grid-column: 1;
    }

    .bordered {
        border-left: 4px solid #34FFAD;
    }

    .selectlist {
        grid-row: 2;
        grid-column: 1/3;
    }
</style>