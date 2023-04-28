<script lang="ts">
    import Timer from "../../Components/Timer.svelte";
    import Tag from "../../Components/Tag.svelte";
    import Member from "../../Components/Member.svelte";
    import Button from "../../Components/Button.svelte";
    import Notification from "../../Components/Notification.svelte";
    import { page,router } from '@inertiajs/svelte';
    import PageSwitchLayout from '@/Layouts/PageSwitchLayout.svelte';
    import { onMount } from 'svelte';


    export let session;

    // Mise en place des membres de la session
    let users: User[] = [];

    function reloadUsers() {
        let previous = users;
        users = [];
        users = previous;
    }

    onMount(() => {
        window.Echo.join('dramaquick_database_session.' + session.Session_Id)
            .here((current_users: User[]) => {
                for(let user of current_users) {
                    if (user.id == $page.props.session.Owner_Id) {
                        user.user_role = "OWNER";
                        users.unshift(user);
                        continue
                    };
                    users.push(user);
                }
                reloadUsers();
                console.log(users);
                if (Object.keys(users).length >= session.Session_MinUser) {
                    if (stop) {
                    stop = false;
                    }
                } else {
                    if (!stop) {
                    stop = true;
                    }
                }
                timer(timeroptions.minutes, timeroptions.seconds, stop, [{time: [0, 0], action: ()=>{startSession()}}]);
            })
            .joining((user: User) => {
                if (user.id == $page.props.session.Owner_Id) {
                    user.user_role = "OWNER";
                    users.unshift(user);
                    return;
                };
                users.push(user);
                reloadUsers();
                notify(user.name,"a rejoint la session","success",5000,"box","corner-top-right",false,"",() => {},"join");
                console.log(user);
                if (Object.keys(users).length >= session.Session_MinUser) {
                    if (stop) {
                    stop = false;
                    }
                } else {
                    if (!stop) {
                    stop = true;
                    }
                }
                timer(timeroptions.minutes, timeroptions.seconds, stop, [{time: [0, 0], action: ()=>{startSession()}}]);
            })
            .leaving((user: User) => {
                users = users.filter((u: User) => u.id != user.id);
                reloadUsers();
                notify(user.name,"a quitté la session","error",5000,"box","corner-bottom-right",false,"",() => {},"quit");
                console.log(user);
                if (Object.keys(users).length >= session.Session_MinUser) {
                    if (stop) {
                    stop = false;
                    }
                } else {
                    if (!stop) {
                    stop = true;
                    }
                }
                timer(timeroptions.minutes, timeroptions.seconds, stop, [{time: [0, 0], action: ()=>{startSession()}}]);
            })
    });


    // On récupère les données de l'utilisateur
    let profile: User = $page.props.auth.user;

    // Mise en place des données de l'utilisateur
    let user = {
        pseudo: profile.name,
        role: profile.user_role,
        icon: false,
    }

    // On vérifie si l'utilisateur est le créateur de la session
    if (profile.id == $page.props.session.Owner_Id) {
            user.role = "OWNER";
    } else {
            user.role = profile.user_role;
    }

    // Mise en place des tags de la session
    let session_tags = [{text: 'Loading', emoji: '⌛', color: '#BCBCBC'}];

    function ReverseArray(array : any) {
        let newarray = [];
        while (array.length > 0) {
            newarray.push(array.pop());
        }
        session_tags = newarray;
    }

    // On récupère les id des tags de la session
    window.axios.get('/api/session/tags/' + session.Session_Id)
    .then(function (response) {
        // Pour chaque tag, on ajoute un objet dans le tableau
        session_tags = [];
        while (response.data['tags'].length > 0) {
            let tag = response.data['tags'].pop();
            session_tags.push({text: tag.Tag_Name, emoji: tag.Tag_Emoji, color: tag.Tag_Color});
        }
        ReverseArray(session_tags);
    })
    .catch(function (error) {
        console.log(error.response.data);
    });

    // Mise en place du temps pour le timer
    let timeroptions = {
        minutes: 0,
        seconds: 5,
    };
    let stop = null;

    // Mise en place des données de la session pour le texte
    let text = {
        title : session.Session_Title,
        description : session.Session_Description,
        session : '#' + session.Session_Id,
        createur : $page.props.owner.name,
        size : Object.keys(users).length + "/" + session.Session_MaxUser,
    }

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

    // function to add a timer
    function timer(minutes, seconds, stop, action) {
        let div_timer = document.getElementById("timerparent");
        // SI il y a un element dans le div, on le supprime
        if (div_timer.firstChild) {
            div_timer.removeChild(div_timer.firstChild);
        }
        // On crée un nouveau timer
        const timer = document.createElement('div');
        div_timer.appendChild(timer);
        new Timer({
            target: timer,
            props: {
                minutes,
                seconds,
                stop,
                action
            }
        });
    }

    // function start session 
    function startSession() {
        console.log("start session");
        router.get('/api/nextquestion/' + session.Session_Id)
    }

    $: {
        text.size = Object.keys(users).length + "/" + session.Session_MaxUser;
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
        <div class="grid bg-white w-full h-156 shadow rounded-2.5xl px-20 py-16 min-w-[92rem] min-h-[39rem]">
            <p class="session text-[1.5rem] color font-normal">Session {text.session}</p>
            <p class="creator text-[1.25rem] font-normal text-right pr-12">Créé par : &nbsp;&nbsp;<i class="not-italic z-0 relative inline-block font-medium creator-style">{text.createur}</i></p>
            <p class="size font-semibold text-[1.5rem] text-black text-right">{text.size}</p>
            <div class="text">
                <h1 class="w-144 font-semibold text-[2.25rem]">{text.title}</h1>
                <h2 class="bordered mt-11.25 pl-6 w-144 font-normal text-[1.5rem] h-fit whitespace-normal break-words">{text.description}</h2>
            </div>
            {#if Object.keys(users).length > 0}
            <div class="members1 flex flex-col gap-3">
                {#each Object.keys(users) as id, i}
                    {#if i < 5}
                        <Member bind:user={users[id]}/>
                    {/if}
                {/each}
            </div>
            {/if}
            {#if Object.keys(users).length > 5}
            <div class="members2 flex flex-col gap-3 justify-left w-[16rem]">
                {#each Object.keys(users) as id, i}
                    {#if i === 9}
                        {#if Object.keys(users).length-9 === 1}
                        <p class="flex h-[3rem] items-center justify-left font-semibold">+{Object.keys(users).length-9} autre participant</p>
                        {:else}
                        <p class="flex h-[3rem] items-center justify-left font-semibold">+{Object.keys(users).length-9} autres participants</p>
                        {/if}
                    {/if}
                    {#if i >= 5 && i < 9}
                        <Member bind:user={users[id]}/>
                    {/if}
                {/each}
            </div>
            {/if}
            <div class="timer-tags flex flex-row items-center gap-10 min-w-[765px]">
                <div id="timerparent">
                </div>
                <div class="tags flex flex-row items-center gap-4">
                    {#each Object.keys(session_tags) as tag}
                        <Tag bind:tag={session_tags[tag]}/>
                    {/each}
                </div>
            </div>
            <div class="button flex flex-row items-center justify-end gap-4">
                {#if user.role == "OWNER"}
                    {#if Object.keys(users).length >= session.Session_MinUser}
                        <Button>Démarrer</Button>
                    {:else}
                        <Button disabled>Démarrer</Button>
                    {/if}
                {/if}
                <Button class="outline" action={() => {notify("Quitter la session","Souhaitez-vous vraiment quitter la session ?","normal", 0,"box","middle",false,"",() => {window.location.href ="/"},"leave")}}>Quitter la session</Button>
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

    .creator {
        grid-row: 1;
        grid-column: 1;
    }

    .session {
        grid-row: 1;
        grid-column: 1;
    }

    .size {
        grid-row: 1;
        grid-column: 3;
    }

    .color {
        color: #666666;
    }

    .text {
        grid-row: 2/4;
        grid-column: 1;
    }

    .bordered {
        border-left: 4px solid #34FFAD;
    }

    .members1 {
        grid-row: 2/4;
        grid-column: 2;
    }

    .members2 {
        grid-row: 2/4;
        grid-column: 3;
    }

    .timer-tags {
        grid-row: 4;
        grid-column: 1;
    }

    .button {
        grid-row: 4;
        grid-column: 2/4;
    }

    .creator-style::before {
        z-index: -1;
        color: black;
        width: 110%;
        position: absolute;
        bottom: 0.09rem;
        left: -5%;
        background-color: #34FFAD;
        height: 0.75rem;
        content: " ";
    }

    .tags {
        height: 100%;
        padding-top: 8px;
    }
</style>
