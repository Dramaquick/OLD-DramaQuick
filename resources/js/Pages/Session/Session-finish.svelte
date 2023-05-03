<script lang="ts">
    import { onMount } from "svelte";
    import { page,router } from '@inertiajs/svelte'
    import Button from "../../Components/Button.svelte";
    import Notification from "../../Components/Notification.svelte";

    let session = $page.props.session;

    let user = $page.props.auth.user;

    if (user.id == session.Owner_Id) {
            user.role = "OWNER";
    };

    let MyChannel = null;

    let nbusers = 1;

    onMount(() => {
        MyChannel = window.Echo.join('dramaquick_database_result.session.' + session.Session_Id)
            .here((users) => {
                nbusers = users.length;
                text.size = nbusers + "/" + totalusers;
            })
            .joining((user) => {
                nbusers = nbusers + 1;
                notify(user.name,"a terminé le quiz","success",5000,"box","corner-top-right",false,"",() => {},"join");
                text.size = nbusers + "/" + totalusers;
            })
            .leaving((user) => {
                nbusers = nbusers - 1;
                notify(user.name,"a quitté la session","error",5000,"box","corner-bottom-right",false,"",() => {},"quit");
                text.size = nbusers + "/" + totalusers;
            })
            .listenForWhisper('Result', (e) => {
                window.location.href = "/question/result/"+session.Session_Id+"/1" ;
            });
    });

    let totalusers : any = "NaN";

    let text = {
        session: "#" + session.Session_Id,
        size: nbusers + "/" + totalusers,
    };

    window.axios.get("/quiz/"+session.Session_Id+"/participants")
        .then((response) => {
            totalusers = response.data['users_count'];
            text.size = nbusers + "/" + totalusers;
        })
        .catch((error) => {
            console.log(error);
        });

    // fonction qui fait apparaitre une notification
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

    function startResult(MyChannel) {
        console.log("Session started");
        MyChannel.whisper('Result', {
            session: session.Session_Id,
        });
        window.location.href="/question/result/"+session.Session_Id+"/1";
    }
    
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="min-h-screen w-full overflow-hidden bg-cover bg-no-repeat">
    <h1 class="font-semibold text-[2rem] text-black py-12 pl-56">DramaQuick</h1>
    <div class="w-full flex justify-center mb-4">
        <div class="infos-container flex bg-white w-5/6 h-fit shadow rounded-2.5xl px-20 py-16 flex-col justify-between">
            <div>
                <p class="session text-[1.5rem] color font-normal w-fit">Session {text.session}</p>
                <p class="session font-semibold text-[1.5rem] text-black text-right">{text.size}</p>
                <h1 class="title py-8 font-semibold text-[2.25rem] w-fit">Vous avez terminé le quiz !</h1>
                <h2 class="desc bordered pl-6 font-normal text-[1.5rem] h-fit w-fit">En attente de l'hôte pour afficher les résultats,<br>sinon vous pouvez retourner à l'accueil.</h2>
            </div>
            <div class="button flex gap-2 justify-center items-center mt-8">
                {#if user.role == "OWNER"}
                    <Button class="outline" action={()=>{startResult(MyChannel)}}>Démarrer les résultats</Button>
                {/if}
                <Button class="" action={() => {window.location.href='/'}}>Retourner à l'accueil</Button>
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

    @media screen and (max-width: 880px) {
        .button {
            flex-direction: column;
        }
    }

    @media screen and (max-width: 650px) {
        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        main h1 {
            padding-left: 0px;
        }
    }

    @media screen and (max-width: 600px) {
        .infos-container {
            padding: 2rem;
        }
    }

    @media screen and (max-width: 400px) {
        .infos-container {
            width: 95%;
        }

        .infos-container h1 {
            font-size: 2rem;
        }

        .infos-container h2 {
            font-size: 1.25rem;
        }

        .infos-container p {
            font-size: 1.25rem;
        }
    }
</style>