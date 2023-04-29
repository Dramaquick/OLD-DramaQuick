<script lang="ts">
    import TextBox from "../../Components/TextBox.svelte";
    import TextArea from "../../Components/TextArea.svelte";
    import Counter from "../../Components/CounterCreate.svelte";
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

    $: {
        // On met à jour status qui contient le code de status
        let status = $page.props.flash.status;

        // On crée une variable description qui contient la description des codes de status
        let description = {
            2001: "La session a été créé avec succès",
            2101: "Le titre de la session est vide",
            2102: "Le titre de la session est trop long (max 100 caractères)",
            2103: "La description de la session est vide",
            2104: "La description de la session est trop longue (max 255 caractères)",
            2105: "La rapidité de la session n'est pas renseignée",
            2106: "La rapidité de la session n'est pas valide",
            2107: "Le minimum d'utilisateur n'est pas renseigné",
            2108: "Le minimum d'utilisateur est trop bas (minimum 1)",
            2109: "Le maximum d'utilisateur n'est pas renseigné",
            2110: "Le maximum d'utilisateur est trop bas (minimum 1)",
            2111: "Un tag renseigné n'existe pas",
            2112: "Aucune question n'a été renseignée",
            2113: "Le format de la liste des questions n'est pas valide",
            2114: "Le titre d'une question est vide",
            2115: "Le titre d'une question est trop long (max 100 caractères)",
            2116: "La description d'une question est vide",
            2117: "La description d'une question est trop longue (max 255 caractères)",
            2118: "Le type d'une question n'est pas valide",
            2119: "Le format de la liste des options n'est pas valide",
            2120: "Les options pour une question ne sont au bon format",
            2121: "Le minimum d'options pour une question n'est pas respecté (minimum 2)",
            2122: "Le maximum d'options pour une question n'est pas respecté (maximum 10)",
            2123: "Une option est vide",
            2124: "Une option est trop longue (max 100 caractères)",
            2125: "Le nombre d'options pour une question de type slider n'est pas respecté (3 options)",
            2126: "Une option pour une question de type slider n'est pas au bon format (number)",
            2127: "Le mninmum d'une option pour une question de type slider est plus grande que le maximum",
            2128: "Le type d'une option pour une question de type slider n'est pas valide"
        }[status];

        // On vérifie si on a un code de status
        if(status) {

            // On vérifie si le code de status est une erreur
            let isError = status.toString()[1] == "1";

            // On affiche la notification
            if (isError) notify("Erreur", description, "error", 5000, "box", "corner-top-right", false, '', '', "error");
            else notify("Succès", description, "success", 5000, "box", "corner-top-right", false, '', '', "success");
        };
    };

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

    // Function to delete indexp for all options
    function delete_indexp() {
        session_parameters.Session_Questions.forEach((question: { Question_Options: any; }) => {
            question.Question_Options.forEach((option: { indexp: any; }) => {
                delete option.indexp;
            });
        });
    }

    // Fonction permettant de créer une session
    function create_session() {
        // On supprime l'indexp pour chaque option
        delete_indexp();
        router.post('/quiz/store', session_parameters);
    }

    let session_parameters = {
        Session_Title: null,
        Session_Description: null,
        Session_MinUser: 1,
        Session_MaxUser: 10,
        Session_Speed: 0,
        Session_Tags: [],
        Session_Questions: [
            {
                Question_Title: "",
                Question_Description: "",
                Question_Type: null,
                Question_Options: [{
                value: "",
                indexp: 0
            },{
                value: "",
                indexp: 0
            }],
                index: 0,
                Question_Slider: {
                    min: 0,
                    max: 10,
                    type: 0,
                }
            },
        ],
    };


</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<PageSwitchLayout>
    <main class="min-h-screen w-full bg-cover bg-no-repeat pb-9">
        <div class="flex justify-center">
            <div class="infos-container flex flex-col w-5/6">
                <h1 class="font-semibold text-[2rem] text-black py-6">DramaQuick</h1>
                <div class="infos flex justify-evenly">
                <div class="main-infos grid bg-white shadow rounded-2.5xl px-14 py-6 w-142 h-full">
                    <div class="text h-fit">
                        <h1 class="title-style z-0 relative inline-block font-semibold text-[1.50rem]">Créer une session</h1>
                        <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-6 pb-2.5">
                            <img src="/img/landing/parametres.svg" alt="emoji" class="w-5 h-5">
                            <p>PARAMETRES GENERAUX</p>
                        </div>
                        <p class="pb-2">Titre du quiz</p>
                        <div class="pb-3.5 w-full">
                            <TextBox bind:value={session_parameters.Session_Title} placeholder="Quiz super cool, 3ème B..." showIcon={false} class="w-full" style="min-width: 0px !important;"/>
                        </div>
                        <p class="pb-2">Description du quiz</p>
                        <div class="pb-3.5 h-36 w-full">
                            <TextArea bind:value={session_parameters.Session_Description} placeholder="Un quiz trop génial réalisé par moi parce que les quiz c’est cool..."/>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="params-container flex flex-row items-start w-full">
                                <div class="participants-container flex gap-4 flex-col mr-4">
                                    <div class="flex items-center justify-center text-[#00E589] text-[1rem] gap-2 pt-4 pb-2.5">
                                        <img src="/img/landing/user.svg" alt="emoji" class="w-5 h-5">
                                        <p>NOMBRE DE PARTICIPANTS</p>
                                    </div>
                                    <div class="counter-container flex gap-4">
                                        <div class="flex flex-col items-center">
                                            <p class="">Minimum</p>
                                            <div class="">
                                            <Counter bind:value={session_parameters.Session_MinUser} min={1} max={session_parameters.Session_MaxUser}/>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <p class="">Maximum</p>
                                            <div class="">
                                                <Counter bind:value={session_parameters.Session_MaxUser} min={session_parameters.Session_MinUser} max={100}/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col pb-[0.5rem] gap-4">
                                    <div class="flex items-center text-[#00E589] text-[1rem] gap-2 pt-4 pb-2.5">
                                        <img src="/img/landing/user.svg" alt="emoji" class="w-5 h-5">
                                        <p>TAGS</p>
                                    </div>
                                    <SelectMultiple
                                        bind:values={session_parameters.Session_Tags}
                                        items={items_tags}
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="rapidite-container flex flex-col text-[#00E589] text-[1rem] gap-2 pt-4 pb-2.5 mt-[-3rem]">
                            <div class="flex">
                                <img src="/img/landing/sablier.svg" alt="emoji" class="w-5 h-5">
                                <p>RAPIDITE</p>
                            </div>
                            <div class="flex flex-col items-center w-fit">
                                <Select
                                bind:value={session_parameters.Session_Speed}
                                placeholder="Sélectionnez une valeur..."
                                items={items_speed}
                                width={190}
                            />
                            </div>
                        </div>
                        <!-- L'utilisateur doit pouvoir choisir 3 tags maximum -->
                        <div class="create-button flex items-center justify-end pt-2">
                            <Button action={create_session}>Créer la session</Button>
                        </div>
                    </div>
                </div>
                <div class="secondary-infos bg-white shadow rounded-2.5xl w-142 h-fit px-14 py-6">
                        <div class="questioncreator w-full">
                            <QuestionCreator bind:questions={session_parameters.Session_Questions} />
                        </div>
                </div>
            </div>
        </div>
    </main>
</PageSwitchLayout>

<style>
    main {
        background: linear-gradient(223.99deg, #F0E583 0%, #34FFAD 98.31%, #CBEF81 34.82%, #97F88F 67.07%);
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

    @media screen and (max-width: 1500px) {
        .infos {
            justify-content: space-between;
        }
    }

    @media screen and (max-width: 1400px) {
        .infos {
            flex-direction: column;
            align-items: center;
        }

        .infos .main-infos {
            margin-bottom: 2rem;
        }
    }

    @media screen and (max-width: 600px) {
        .main-infos {
            width: 100%;
        }

        .secondary-infos {
            width: 100%;
        }

        .params-container {
            flex-direction: column;
        }

        .rapidite-container {
            margin-top: 0;
        }

        .params-container {
            align-items: center;
        }

        .rapidite-container {
            align-items: center;
        }

        .participants-container {
            margin-right: 0;
        }

        .create-button {
            justify-content: center;
        }

        .counter-container {
            justify-content: center;
        }
    }

    @media screen and (max-width: 500px) {
        .main-infos {
            padding: 1.5rem 1rem 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .text {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .secondary-infos {
            padding: 1.5rem 1rem 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .infos-container {
            width: 95%;
        }
    }

    @media screen and (max-width: 400px) {
        .main-infos {
            padding: 1.5rem 0.5rem 1.5rem 0.5rem;
        }
    }
</style>