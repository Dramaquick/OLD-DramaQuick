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

    // Mise en place des membres de la session (il en faut 150)
    let users: User[] = [];

    function reloadUsers() {
        let previous = users;
        users = [];
        users = previous;
    }

    let MyChannel = null;

    onMount(() => {
        MyChannel = window.Echo.join('dramaquick_database_session.' + session.Session_Id)
            .here((current_users: User[]) => {
                for(let user of current_users) {
                    if (user.id == $page.props.session.Owner_Id) {
                        user.user_role = "OWNER";
                        users.unshift(user);
                    } else {
                    users.push(user);
                    };
                }
                reloadUsers();
            })
            .joining((user: User) => {
                if (user.id == $page.props.session.Owner_Id) {
                    user.user_role = "OWNER";
                    users.unshift(user);
                } else {
                users.push(user);
                };
                reloadUsers();
                notify(user.name,"a rejoint la session","success",5000,"box","corner-top-right",false,"",() => {},"join");
                MyChannel.whisper('Timer', timeroptions);
            })
            .leaving((user: User) => {
                users = users.filter((u: User) => u.id != user.id);
                reloadUsers();
                notify(user.name,"a quitté la session","error",5000,"box","corner-bottom-right",false,"",() => {},"quit");
            })

            setInterval(() => {
                MyChannel.listen('SessionStarted', (e: any) => {
                window.location.href='/nextquestion/' + session.Session_Id;
            })
            }, 3000);

    
            MyChannel.listenForWhisper('SessionStarted', (e: any) => {
                window.location.href='/nextquestion/' + session.Session_Id;
            })

            MyChannel.listenForWhisper('Timer', (e: any) => {
                timeroptions.minutes = e.minutes;
                timeroptions.seconds = e.seconds;
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
        minutes: 1,
        seconds: 0,
    };

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

    // function start session 
    function startSession(MyChannel) {
        ("Session started");
        MyChannel.whisper('SessionStarted', {
            session: session.Session_Id,
        });
        window.location.href='/nextquestion/' + session.Session_Id;
    }

    let timer = false;

    $: {
        text.size = Object.keys(users).length + "/" + session.Session_MaxUser;
        if (Object.keys(users).length >= session.Session_MinUser) {
            timer = true;
        } else {
            timer = false;
            timeroptions = {
                minutes: 1,
                seconds: 0,
            };
        }
    }

    $: secondString = timeroptions.seconds.toString().padStart(2, '0');

    $: {
        // On vérifie qu'on est bien connecté au channel
        if (!MyChannel) {
            // Si on ne l'est pas, on se connecte
            MyChannel = window.Echo.join('dramaquick_database_session.' + session.Session_Id)
        }
    }
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<PageSwitchLayout>
    <main class="global-container min-h-screen w-full overflow-hidden bg-cover bg-no-repeat">
        <h1 class="title font-semibold text-[2rem] text-black py-12 pl-56 w-full">DramaQuick</h1>
        <div class="w-full flex justify-center mb-4">
            <div class="infos-container flex bg-white shadow rounded-2.5xl px-20 py-16 min-h-[39rem] w-5/6 justify-between flex-col">
                <div class="header flex justify-between">
                    <p class="session text-[1.5rem] color font-normal">Session {text.session}</p>
                    <p class="creator text-[1.25rem] font-normal text-right">Créé par : &nbsp;&nbsp;<i class="not-italic z-0 relative inline-block font-medium creator-style">{text.createur}</i></p>
                    <p class="size font-semibold text-[1.5rem] text-black text-right">{text.size}</p>
                </div>
                <div class="flex flex-col w-full my-8">
                    <div class="text-users w-full flex justify-between">
                        <div class="text flex flex-col w-3/5 gap-4">
                            <h1 class="font-semibold text-[2.25rem] title-overflow">{text.title}</h1>
                            <h2 class="bordered pl-6 font-normal text-[1.5rem] h-fit whitespace-normal break-words">{text.description}</h2>
                        </div>
                        <div class="users flex flex-col justify-center">
                            <div class="lists-container flex justify-between gap-16">
                                {#if Object.keys(users).length > 0}
                                <div class="members1 flex flex-col gap-3 items-start">
                                    {#each Object.keys(users) as id, i}
                                        {#if i < 5}
                                            <Member bind:user={users[id]}/>
                                        {/if}
                                    {/each}
                                </div>
                                {/if}
                                {#if Object.keys(users).length > 5}
                                <div class="members2 flex flex-col gap-3 justify-left items-start">
                                    {#each Object.keys(users) as id, i}
                                        {#if i === 9}
                                            {#if Object.keys(users).length-9 === 1}
                                            <Member bind:user={users[id]}/>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tags-buttons w-full flex justify-between">
                    <div class="timer-tags flex flex-row items-center gap-10">
                        {#if timer}
                            <Timer bind:minutes={timeroptions.minutes} bind:seconds={timeroptions.seconds} action = {[{time: [0, 0], action: () => {startSession(MyChannel)}}]} />
                        {:else}
                        <div id="timer" class="flex gap-4 items-end">
                            <span id="time" class="flex items-end justify-start font-semibold text-[2.25rem] text-center text-black w-[5.5rem]">
                            {timeroptions.minutes}:{secondString} 
                            </span>
                            <p class="text-[1.5rem] text-[#666666] font-normal w-fit h-12 flex items-center">restantes</p>
                            </div>
                        {/if}
                        <div class="tags flex flex-row items-center gap-4">
                            {#each Object.keys(session_tags) as tag}
                                <Tag bind:tag={session_tags[tag]}/>
                            {/each}
                        </div>
                    </div>
                    <div class="button flex flex-row items-center justify-end gap-4">
                        {#if user.role == "OWNER"}
                            {#if Object.keys(users).length >= session.Session_MinUser}
                                <Button action={()=>{startSession(MyChannel)}}>Démarrer</Button>
                            {:else}
                                <Button disabled>Démarrer</Button>
                            {/if}
                        {/if}
                        <Button class="outline" action={() => {notify("Quitter la session","Souhaitez-vous vraiment quitter la session ?","normal", 0,"box","middle",false,"",() => {window.location.href ="/leave"},"leave")}} style="">Quitter la session</Button>
                    </div>
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

    .bordered {
        border-left: 4px solid #34FFAD;
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

    .title-overflow {
        overflow-wrap: break-word;
    }

    @media screen and (max-width: 1620px) {
        .infos-container {
            width: 90%;
        }
    }

    @media screen and (max-width: 1500px) {
        .infos-container {
            width: 95%;
            padding: 2.5rem;
        }

        .tags-buttons {
            flex-direction: column;
            gap: 1rem;
        }

        .tags-buttons .button {
            justify-content: center;
        }

        .tags-buttons .timer-tags {
            justify-content: center;
        }
    }

    @media screen and (max-width: 1200px) {
        .text-users {
            flex-direction: column;
            gap: 2rem;
        }

        .text-users div {
            width: 100%;
        }

        .text-users .users {
            align-items: center;
        }

        .text-users .users div {
            width: 50%;
        }

        .text-users .users .lists-container {
            gap: 2rem;
        }
    }

    @media screen and (max-width: 900px) {
        .timer-tags {
            gap: 0rem;
            flex-direction: column;
        }

        .text-users .users div {
            width: 80%;
        }
    }

    @media screen and (max-width: 700px) {
        .header {
            align-items: center;
            flex-direction: column;
            gap: 0.25rem;
        }
    }

    @media screen and (max-width: 650px) {
        .title {
            padding-left: 0;
            display: flex;
            justify-content: center;
        }
    }

    @media screen and (max-width: 600px) {
        .timer-tags .tags {
            gap: 0.5rem;
            flex-direction: column;
        }

        .button {
            flex-direction: column;
            gap: 0.5rem;
        }

        .text-users .users div {
            width: 100%;
        }
    }

    @media screen and (max-width: 500px) {
        .text h1 {
            font-size: 2rem;
        }

        .text h2 {
            font-size: 1.25rem;
        }
    }

    @media screen and (max-width: 500px) {
        .text h1 {
            font-size: 1.75rem;
        }

        .text h2 {
            font-size: 1.1rem;
        }

        .users .lists-container {
            flex-direction: column;
            gap: 0.75rem !important;
            align-items: center;
        }

        .users .lists-container div {
            width: 100%;
            align-items: center;
        }

        .infos-container {
            width: 95%;
            padding: 1rem;
        }
    }
</style>
