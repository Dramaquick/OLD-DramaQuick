<script lang="ts">
    import Timer from "../../Components/Timer.svelte";
    import TextArea from "../../Components/TextArea.svelte";
    import Button from "../../Components/Button.svelte";
    import Notification from "../../Components/Notification.svelte";
    import PageSwitchLayout from "@/Layouts/PageSwitchLayout.svelte";
    import {page,router} from "@inertiajs/svelte";

    let session = $page.props.session;
    let question = $page.props.question;
    let user = $page.props.auth.user;

    // Mise en place du temps pour le timer
    let timer = {
        minutes: 0,
        seconds: 15,
    };

    // Mise en place des données de la session pour le texte
    let text = {
        session: "#"+session.Session_Id,
        page: question.number.toString() + "/" + session.number_of_questions.toString(),
        title: question.Question_Title,
        description: question.Question_Description,
    }

    // Mise en place du formulaire pour le textarea
    let form = {
        textArea: "",
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
            Answer_Values: form.textArea,
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

<!-- Contenu de la page -->

<PageSwitchLayout>
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
        <div class="slider flex justify-center items-center">
            <TextArea bind:value={form.textArea} placeholder="Blablabla"/>
        </div>
        <div class="timer-tags flex items-end">
            <Timer
                bind:minutes={timer.minutes}
                bind:seconds={timer.seconds}
                action = {[{time: [0, 0], action: () => {Next()}}]}
            />
        </div>
        <div class="button flex justify-end items-end">
            <Button class="outline" action={() => {notify("Quitter la session","Souhaitez-vous vraiment quitter la session ?","normal",0,"box","middle",false,"",() => {window.location.href ="/"},"leave")}}>Quitter la session</Button>
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

    .slider {
        grid-row: 2;
        grid-column: 1/3;
    }
</style>