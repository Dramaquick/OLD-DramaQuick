<script lang="ts">
    import TextBox from "../../Components/TextBox.svelte";
    import TextArea from "../../Components/TextArea.svelte";
    import Counter from "../../Components/Counter.svelte";
    import Select from "../../Components/SelectList.svelte";
    import SelectMultiple from "@/Components/SelectMultiple.svelte";
    import Button from "../../Components/Button.svelte";
    import QuestionCreator from "../../Components/QuestionCreator.svelte";
    import { page,router } from  "@inertiajs/svelte";
    import PageSwitchLayout from '@/Layouts/PageSwitchLayout.svelte';
    import Notification from "@/Components/Notification.svelte";

    // On récupère les données de l'utilisateur
    let profile: User = $page.props.auth.user;

    // Mise en place des données de l'utilisateur
    let user = {
        pseudo: profile.name,
        role: profile.user_role,
        icon: false,
    }

    // Mise en place des différentes rapidités
    let items_speed = [
        {id: 1, name: 'Rapide'},
        {id: 2, name: 'Moyen'},
        {id: 3, name: 'Lent'}
    ];

    function Majuscule(mot : string) {
        return mot.charAt(0).toUpperCase() + mot.slice(1);
    }

    // Récupération de tous les tags de la base de données et mise en place dans un dict
    let items_tags = [{id: -1, name: 'Loading...'}];
    window.axios.get('/api/tags')
    .then(function (response) {
        // Pour chaque tag, on ajoute un objet dans le tableau
        items_tags = [];
        response.data['tags'].forEach((tag: { Tag_Id: number; Tag_Name: string; }) => {
            if (tag.Tag_Id == 1 && user.role == 'ADMIN') {
                items_tags.push({id: tag.Tag_Id, name: Majuscule(tag.Tag_Name)});
            } else if (tag.Tag_Id != 1) {
                items_tags.push({id: tag.Tag_Id, name: Majuscule(tag.Tag_Name)});
            };
        });
    })
    .catch(function (error) {
        console.log(error.response.data);
    });

    // Mise en place des paramètres de la session (modifiables par l'utilisateur)
    let session_parameters = {
        Session_Title: null,
        Session_Description: null,
        Session_MinUser: 1,
        Session_MaxUser: 10,
        Session_Speed: 0,
        Session_Tags: [],
    };

    // Fonction permettant de notifier l'utilisateur
    function notify(title, text, type, duration, format, position, input, placeholder, action, id) {
        if (id != "") {
            if (document.getElementById(id) != null) {
                return;
            }
        } else {
            id = undefined;
        }
        const notification = document.createElement('div');
        document.body.appendChild(notification);

        new Notification({
            target: notification,
            props: {
                title,
                text,
                type,
                duration,
                format,
                position,
                input,
                placeholder,
                action,
                id
            }
        });
    };

    // Fonction permettant de créer une session
    function create_session() {
        router.post('/quiz/store', [session_parameters, questions]);
    }

    // Mise en place de la liste des questions
    let questions = [
        {
            title: "",
            description: "",
            type: 0,
            options: [],
            index: 0
        },
    ];



</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<PageSwitchLayout>
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
                <div class="pb-3.5">
                    <TextBox bind:value={session_parameters.Session_Title} placeholder="Quiz super cool, 3ème B..." showIcon={false}/>
                </div>
                <p class="pb-2">Description du quiz</p>
                <div class="pb-3.5 h-25%">
                    <TextArea bind:value={session_parameters.Session_Description} placeholder="Un quiz trop génial réalisé par moi parce que les quiz c’est cool..."/>
                </div>
                <div class="flex flex-col">
                    <div class="flex flex-row gap-10">
                        <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-4 pb-2.5">
                            <img src="/img/landing/user.svg" alt="emoji" class="w-5 h-5">
                            <p>NOMBRE DE PARTICIPANTS</p>
                        </div>
                        <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-4 pb-2.5">
                            <img src="/img/landing/user.svg" alt="emoji" class="w-5 h-5">
                            <p>TAGS</p>
                        </div>
                    </div>
                    <div class="flex flex-row items-start">
                        <div class="flex gap-4 ml-[-1rem]">
                            <div class="flex flex-col items-center">
                                <p class="">Minimum</p>
                                <div class="scale-75">
                                <Counter bind:value={session_parameters.Session_MinUser} min={1} max={session_parameters.Session_MaxUser}/>
                                </div>
                            </div>
                            <div class="flex flex-col ml-2.5 items-center w-25%">
                                <p class="">Maximum</p>
                                <div class="scale-75">
                                    <Counter bind:value={session_parameters.Session_MaxUser} min={session_parameters.Session_MinUser} max={100}/>
                                </div>
                            </div>
                        </div>
                        <div class="pb-[0.5rem]">
                            <SelectMultiple
                                bind:values={session_parameters.Session_Tags}
                                items={items_tags}
                            />
                        </div>
                    </div>
                </div>
                <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-4 pb-2.5 mt-[-3rem]">
                    <img src="/img/landing/sablier.svg" alt="emoji" class="w-5 h-5">
                    <p>RAPIDITE</p>
                </div>
                <!-- L'utilisateur doit pouvoir choisir 3 tags maximum -->
                <div class="flex flex-row justify-between w-full">
                    <div class="flex flex-col items-center w-[8.75rem] ml-[1.25rem]">
                        <Select
                        bind:value={session_parameters.Session_Speed}
                        placeholder="Sélectionnez une valeur..."
                        items={items_speed}
                        width={180}
                    />
                    </div>
                    
                </div>
                <div class="flex items-center justify-end pt-2">
                    <Button action={create_session}>Créer la session</Button>
                </div>
            </div>
        </div>
        <div class="bg-white shadow rounded-2.5xl py-6 w-142 h-200">
                <div class="questioncreator">
                    <QuestionCreator bind:questions={questions} />
                </div>
        </div>
    </main>
</PageSwitchLayout>

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