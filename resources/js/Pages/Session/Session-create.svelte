<script>
    import TextBox from "../../Components/TextBox.svelte";
    import TextArea from "../../Components/TextArea.svelte";
    import Counter from "../../Components/Counter.svelte";
    import Select from "../../Components/SelectList.svelte";
    import Button from "../../Components/Button.svelte";
    import QuestionCreator from "../../Components/QuestionCreator.svelte";

    let items_speed = [
        {id: 1, name: 'Rapide'},
        {id: 2, name: 'Moyen'},
        {id: 3, name: 'Lent'}
    ];

    let items_tags = [
        {id: 1, name: 'Officiel'},
        {id: 2, name: 'Nourriture'},
        {id: 3, name: 'Halloween'}
    ]

    let session_parameters = {
        Title: null,
        Description: null,
        Min_players: 1,
        Max_players: 10,
        Speed: 0,
        Tag1: 0,
        Tag2: 0,
        Tag3: 0,
    };

    let questions = [
        {
            title: null,
            description: null,
            type: 0,
            opt_counter: 0,
            options: {},
        },
    ];
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="h-screen w-full overflow-hidden bg-cover bg-no-repeat">
    <h1 class="font-semibold text-[2rem] text-black py-6 pl-56 w-full">DramaQuick</h1>
    <div class="pl-75 pr-75 flex justify-between">
    <div class="grid bg-white shadow rounded-2.5xl px-14 py-6 w-142 h-200">
        <div class="text">
            <h1 class="title-style z-0 relative inline-block font-semibold text-[1.50rem]">Créer une session</h1>
            <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-6 pb-2.5">
                <img src="/img/landing/parametres.svg" alt="emoji" class="w-5 h-5">
                <p>PARAMETRES GENERAUX</p>
            </div>
            <p class="pb-2">Titre du quiz</p>
            <div class="pb-3 5">
                <TextBox bind:value={session_parameters.Title} placeholder="Quiz super cool, 3ème B..." showIcon={false}/>
            </div>
            <p class="pb-2">Description du quiz</p>
            <div class="pb-3.5 h-25%">
                <TextArea bind:value={session_parameters.Description} placeholder="Un quiz trop génial réalisé par moi parce que les quiz c’est cool..."/>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-row gap-8">
                    <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-4 pb-2.5">
                        <img src="/img/landing/user.svg" alt="emoji" class="w-5 h-5">
                        <p>NOMBRE DE PARTICIPANTS</p>
                    </div>
                    <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-4 pb-2.5">
                        <img src="/img/landing/sablier.svg" alt="emoji" class="w-5 h-5">
                        <p>RAPIDITE</p>
                    </div>
                </div>
                <div class="flex flex-row items-end">
                    <div class="flex gap-4 ml-[-1rem]">
                        <div class="flex flex-col items-center">
                            <p class="">Minimum</p>
                            <div class="scale-75">
                            <Counter bind:value={session_parameters.Min_players} min={1} max={session_parameters.Max_players}/>
                            </div>
                        </div>
                        <div class="flex flex-col ml-2.5 items-center w-25%">
                            <p class="">Maximum</p>
                            <div class="scale-75">
                                <Counter bind:value={session_parameters.Max_players} min={session_parameters.Min_players} max={100}/>
                            </div>
                        </div>
                    </div>
                    <div class="pb-[0.5rem]">
                        <Select
                            bind:value={session_parameters.Speed}
                            placeholder="Sélectionnez une valeur..."
                            items={items_speed}
                            width={true}
                        />
                    </div>
                </div>
            </div>
            <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-4 pb-2.5">
                <img src="/img/landing/user.svg" alt="emoji" class="w-5 h-5">
                <p>TAGS</p>
            </div>
            <!-- L'utilisateur doit pouvoir choisir 3 tags maximum -->
            <div class="flex flex-row gap-4">
                <div class="flex flex-col items-center w-fit">
                    <p class="">Tag 1</p>
                    <div class="scale-75 ml-[-1.25rem]">
                        <Select
                            bind:value={session_parameters.Tag1}
                            placeholder="Sélectionnez une valeur..."
                            items={items_tags}
                            width={true}
                        />
                    </div>
                </div>
                <div class="flex flex-col items-center w-fit">
                    <p class="">Tag 2</p>
                    <div class="scale-75 ml-[-1.25rem]">
                        <Select
                            bind:value={session_parameters.Tag2}
                            placeholder="Sélectionnez une valeur..."
                            items={items_tags}
                            width={true}
                        />
                    </div>
                </div>
                <div class="flex flex-col items-center w-fit">
                    <p class="">Tag 3</p>
                    <div class="scale-75 ml-[-1.25rem]">
                        <Select
                            bind:value={session_parameters.Tag3}
                            placeholder="Sélectionnez une valeur..."
                            items={items_tags}
                            width={true}
                        />
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end pt-2">
                <Button>Créer la session</Button>
            </div>
        </div>
    </div>
    <div class="bg-white shadow rounded-2.5xl py-6 w-142 h-200">
            <div class="questioncreator">
                <QuestionCreator bind:questions={questions} />
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

    .title-style {
        grid-column: 1;
        grid-row: 1;
    }

    .questioncreator {
        grid-column: 2;
        grid-row: 1;
    }

    .title-style::before {
        z-index: -1;
        color: black;
        width: 110%;
        position: absolute;
        bottom: 0.09rem;
        left: -5%;
        background-color: #34FFAD;
        height: 1rem;
        content: " ";
    }
</style>