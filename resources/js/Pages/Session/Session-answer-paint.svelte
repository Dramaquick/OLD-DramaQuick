<script lang="ts">
    import Button from "../../Components/Button.svelte";
    import Notification from "../../Components/Notification.svelte";
    import {page} from "@inertiajs/svelte";
    import {onMount} from "svelte";

    let MyChannel;

    onMount(() => {
        MyChannel = window.Echo.join('dramaquick_database_result.session.' + session.Session_Id)
            .listenForWhisper('Result', (e) => {
                window.location.href = "/question/result/"+session.Session_Id+"/"+(question.position+1).toString() ;
            });
    });

    let session = $page.props.session;
    let question = $page.props.question;
    let user = $page.props.auth.user;
    let answers = $page.props.answers;

    // Mise en place des données de la session pour le texte
    let text = {
        session: "#" + session.Session_Id,
        page: question.position + "/" + session.number_of_questions,
        title: question.Question_Title,
    };

    let paints = [];
    answers.forEach(answer => {
        paints.push(answer.Answer_Values);
    });

    // Fonction qui permet de notifier l'utilisateur
    function notify(title, text, type, duration, format, position, input, placeholder, action, id) {
        if (id != undefined) {
            if (document.getElementById(id) != null) {
                return;
            }
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
    }

    function nextResult(MyChannel) {
        MyChannel.whisper('Result', {
            session: session.Session_Id,
        });
        window.location.href="/question/result/"+session.Session_Id+"/"+(question.position+1).toString();
    }
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="min-h-screen w-full overflow-hidden bg-cover bg-no-repeat">
    <h1 class="sitetitle font-semibold text-[2rem] text-black py-12 pl-56 w-full">DramaQuick</h1>
    <div class="modal-container flex justify-center items-center min-h-full">
        <div class="global-container flex flex-col bg-white w-4/6 min-h-156 h-max shadow rounded-2.5xl px-20 py-12 mb-2">
            <div class="header flex justify-between">
                <h1 class="title w-fit font-semibold text-[2.25rem] w-fit">Réponses</h1>
                <p class="page font-semibold text-[1.5rem] text-black text-right">{text.page}</p>
            </div>
            <div class="infos">
                <p class="session text-[1.5rem] color font-normal w-fit">Session {text.session}</p>
                <h1 class="subtitle py-2 font-semibold text-[1.75rem] w-full">{text.title} <i class="not-italic font-semibold text-[1.25rem]">({answers.length} réponses)</i></h1>
            </div>
            <div class="affichage my-8">
                <div class="textes-container">
                    {#each paints as paint}
                        <div class="texte text-[1rem] text-[#272727] w-full">
                            <img src={"/paints/"+paint} alt="Paint" class="w-full"/>
                        </div>
                    {/each}
                </div>
            </div>
            <div class="buttons flex justify-between">
                {#if user.id == session.Owner_Id}
                    <div class="button1 flex justify-start items-end">
                        <Button class="" action={() => {nextResult(MyChannel)}}>Passer à la page suivante</Button>
                    </div>
                    <div class="button flex justify-end items-end">
                        <Button class="outline" action={() => {notify("Quitter la session","Souhaitez-vous vraiment quitter la session ?","normal",0,"box","middle",false,"",() => {window.location.href ="/"},"leave")}}>Quitter la session</Button>
                    </div>
                {:else}
                    <div class="button1 flex justify-start items-end">
                        <i class="text-lightgray">En attente de l'hôte...</i>
                    </div>
                    <div class="button flex justify-end items-end">
                        <Button class="outline" action={() => {notify("Quitter la session","Souhaitez-vous vraiment quitter la session ?","normal",0,"box","middle",false,"",() => {window.location.href ="/"},"leave")}}>Quitter la session</Button>
                    </div>
                {/if}
            </div>
        </div>
    </div>
</main>

<style>
    main {
        background-image: url(/img/landing/back.png);
    }

    .affichage {
        scale: 0.9;
    }

    .shadow {
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    .color {
        color: #666666;
    }

    .page {
        overflow-wrap: anywhere;
    }

    .subtitle {
        overflow-wrap: anywhere;
    }

    .modal-container {
        min-height: 75vh;
    }

    .textes-container {
        max-height: 604px;
        overflow-y: auto;
    }

    @media screen and (max-width: 1100px) {
        .buttons {
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }
    }

    @media screen and (max-width: 900px) {
        .global-container {
            width: 95%;
        }
    }

    @media screen and (max-width: 650px) {
        .sitetitle {
            padding-left: 0;
            display: flex;
            justify-content: center;
        }
    }

    @media screen and (max-width: 550px) {
        .global-container {
            padding: 2rem;
        }
    }

    @media screen and (max-width: 450px) {
        .global-container {
            padding: 1rem;
        }

        .title {
            font-size: 1.75rem;
        }

        .subtitle {
            font-size: 1.25rem;
        }

        .page {
            font-size: 1.25rem;
        }

        .session {
            font-size: 1.25rem;
        }
    }
</style>