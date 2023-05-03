<script lang="ts">
    import Timer from "../../Components/Timer.svelte";
    import SelectList from "../../Components/SelectList.svelte";
    import Button from "../../Components/Button.svelte";
    import Notification from "../../Components/Notification.svelte";
    import PageSwitchLayout from "@/Layouts/PageSwitchLayout.svelte";
    import {page,router} from "@inertiajs/svelte";
    import {onMount} from "svelte";

    let MyChannel;
    onMount(() => {
        MyChannel = window.Echo.join('dramaquick_database_session.' + session.Session_Id)
            .leaving((user) => {
                notify(user.name,"a quitté la session","error",5000,"box","corner-bottom-right",false,"",() => {},"quit");
            })
    });

    let session = $page.props.session;
    let question = $page.props.question;
    let user = $page.props.auth.user;

    function stringToArray(string) {
        let array = string.split(",");
        for (let i = 0; i < array.length; i++) {
            array[i] = array[i];
        }
        return array;
    }

    let options = stringToArray(question.Question_Options);

    // Mise en place du temps pour le timer
    let timer = {
        minutes: 0,
        seconds: 15,
    };

    if (session.Session_Speed == 1) {
        timer = {
            minutes: 0,
            seconds: 15,
        };
    } else if (session.Session_Speed == 2) {
        timer = {
            minutes: 0,
            seconds: 30,
        };
    } else if (session.Session_Speed == 3) {
        timer = {
            minutes: 0,
            seconds: 45,
        };
    }

    // Mise en place des choix pour la liste
    let items : any = [];

    options.forEach((option, index) => {
        items.push({
            id: index+1,
            name: option,
        })
        console.log(index)
    });

    // Mise en place des données de la session pour le texte
    let text = {
        session: "#"+session.Session_Id,
        page: question.position.toString() + "/" + session.number_of_questions.toString(),
        title: question.Question_Title,
        description: question.Question_Description,
    }

    // Mise en place du formulaire pour la selectlist
    let form = {
        selectValue: 0,
    }

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

    function Next() {
        let request = {
            Session_Id: session.Session_Id.toString(),
            Question_Id: question.Question_Id.toString(),
            Answer_Values: form.selectValue,
            User_Id: user.id.toString(),
        }
        console.log(request)
        router.post('/api/answer/store', request);
    }
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<PageSwitchLayout>
<!-- Contenu de la page -->
<main class="min-h-screen w-full overflow-hidden bg-cover bg-no-repeat">
    <h1 class="sitetitle font-semibold text-[2rem] text-black py-12 pl-56 w-full">DramaQuick</h1>
    <div class="w-full flex justify-center mb-4">
        <div class="container flex flex-col justify-between bg-white w-4/6 min-h-[39rem]  shadow rounded-2.5xl px-20 py-16">
            <div class="infos">
                <div class="header flex justify-between">
                    <p class="session text-[1.5rem] color font-normal w-fit">Session {text.session}</p>
                    <p class="page font-semibold text-[1.5rem] text-black text-right">{text.page}</p>
                </div>
                <div class="content">
                    <h1 class="title py-2 font-semibold text-[2.25rem] w-full">{text.title}</h1>
                    <h2 class="desc bordered pl-6 font-normal text-[1.5rem] h-fit w-full">{text.description}</h2>
                </div>
            </div>
            <div class="w-full flex justify-center my-16">
                <SelectList
                    bind:value={form.selectValue}
                    placeholder="Sélectionnez une valeur..."
                    items={items}
                />
            </div>
            <div class="timer-tags flex flex-row justify-between">
                <Timer
                    bind:minutes={timer.minutes}
                    bind:seconds={timer.seconds}
                    action = {[{time: [0, 0], action: () => {Next()}}]}
                />
                <Button class="outline" action={() => {notify("Quitter la session","Souhaitez-vous vraiment quitter la session ?","normal",0,"box","middle",false,"",() => {window.location.href ="/leave"},"leave")}}>Quitter la session</Button>
            </div>
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

    .color {
        color: #666666;
    }

    .session {
        overflow-wrap: break-word;
    }

    .page {
        overflow-wrap: break-word;
    }

    .title {
        overflow-wrap: break-word;
    }

    .desc {
        overflow-wrap: break-word;
    }

    .bordered {
        border-left: 4px solid #34FFAD;
    }

    @media screen and (max-width: 1000px) {
        .timer-tags {
            flex-direction: column;
            width: 100%;
            align-items: center;
        }
    }

    @media screen and (max-width: 700px) {
        .content h1 {
            font-size: 2rem;
        }

        .content h2 {
            font-size: 1.5rem;
        }

        main .container {
            padding: 2rem;
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

    @media screen and (max-width: 500px) {
        .header {
            flex-direction: column;
            align-items: center;
        }

        .content h1 {
            font-size: 1.5rem;
        }

        .content h2 {
            font-size: 1.25rem;
        }

        main .container {
            padding: 1rem;
        }
    }
</style>