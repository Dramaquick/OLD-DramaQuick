<script>
    import { onMount } from "svelte";
    import TextBox from "../../Components/TextBox.svelte";
    import TextArea from "../../Components/TextArea.svelte";
    import Counter from "../../Components/Counter.svelte";
    import Select from "../../Components/SelectList.svelte";
    import Button from "../../Components/Button.svelte";
    import SelectList from "../../Components/SelectList.svelte";
    import QuestionCreator from "../../Components/QuestionCreator.svelte";

    let tag = {
        emo1: "⌛",
        emo2: "🎃",
        emo3: "🍨",
        text1: "officiel",
        text2: "halloween",
        text3: "nourriture",
        color1: "#34FFAD",
        color2: "#FFC634",
        color3: "#FFA6E6",
    }

    // Décompteur en temps réel pour Timer
    let timer = {
        minutes: 1,
        seconds: 10,
    };

    let form = {
        selected: 0,
        type: 0,
    };

    onMount(() => {
        setInterval(() => {
            if (timer.seconds > 0) {
                timer.seconds--;
            } else if (timer.minutes > 0) {
                timer.minutes--;
                timer.seconds = 59;
            }
        }, 1000);
    });

    let users = {
        user1: {
            pseudo: "Ewen.G",
            role: "creator",
            hasCustomIcon: false,
        },
        user2: {
            pseudo: "Pierre-Louis.L",
            role: "admin",
            hasCustomIcon: false,
        },
        user3: {
            pseudo: "Dorian.P",
            role: "admin",
            hasCustomIcon: false,
        },
        user4: {
            pseudo: "Hugo.M",
            role: "admin",
            hasCustomIcon: true,
        },
        user5: {
            pseudo: "Nathan.R",
            role: "admin",
            hasCustomIcon: false,
        },
        user6: {
            pseudo: "Arthur.P",
            role: "admin",
            hasCustomIcon: false,
        },
        user7: {
            pseudo: "Emilio.M",
            role: "admin",
            hasCustomIcon: false,
        },
        user8: {
            pseudo: "Forfait.F",
            role: "member",
            hasCustomIcon: false,
        },
        user9: {
            pseudo: "Jean-Bandonne.B",
            role: "member",
            hasCustomIcon: false,
        },
    }

    let text = {
        title : "Quiz ultime de la mort qui fait pas trop vivre !",
        description : "Voici une petit quiz plutôt pipou pour relancer un peu la mode parce qu’en vrai c’était vachement cool ✨",
        session : "#35878454",
        createur : "Ewen.G",
        size : "9/10",
    }

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

    let questions = [
        {
            title: null,
            description: null,
            type: 0,
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
    <div class="grid bg-white h-156 shadow rounded-2.5xl px-14 py-6 w-142 h-200">
        <div class="text">
            <h1 class="title-style z-0 relative inline-block font-semibold text-[1.50rem]">Créer une session</h1>
            <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-6 pb-2.5">
                <img src="/img/landing/parametres.svg" alt="emoji" class="w-5 h-5">
                <p>PARAMETRES GENERAUX</p>
            </div>
            <p class="pb-2">Titre du quiz</p>
            <div class="pb-3 5">
                <TextBox placeholder="Quiz super cool, 3ème B..." showIcon={false}/>
            </div>
            <p class="pb-2">Description du quiz</p>
            <div class="pb-3.5 h-25%">
                <TextArea placeholder="Un quiz trop génial réalisé par moi parce que les quiz c’est cool..."/>
            </div>
            <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-4 pb-2.5">
                <img src="/img/landing/user.svg" alt="emoji" class="w-5 h-5">
                <p>NOMBRE DE PARTICIPANTS</p>
            </div>
            <div class="flex">
                <div class="flex flex-col w-25% items-center">
                    <p class="">Minimum</p>
                    <div class="scale-75">
                     <Counter value={1} />
                    </div>
                </div>
                <div class="flex flex-col ml-2.5 items-center w-25%">
                    <p class="">Maximum</p>
                    <div class="scale-75">
                        <Counter value={10} />
                    </div>
                </div>
            </div>
            <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-6 pb-2.5">
                <img src="/img/landing/sablier.svg" alt="emoji" class="w-5 h-5">
                <p>RAPIDITE</p>
            </div>
            <div class="pb-3 5">
                <Select
                    bind:value={form.selected}
                    placeholder="Sélectionnez une valeur..."
                    items={items}
                />
            </div>
            <div class="flex items-center justify-end pt-2">
                <Button>Créer la session</Button>
            </div>
        </div>
    </div>
        <div class="bg-white h-156 shadow rounded-2.5xl py-6 w-142 h-200">
                <div class="questioncreator">
                    <QuestionCreator bind:questions={questions} />
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