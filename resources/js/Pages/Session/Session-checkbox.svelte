<script lang="ts">
    import Timer from "../../Components/Timer.svelte";
    import CheckBox from "../../Components/Checkbox.svelte";
    import Button from "../../Components/Button.svelte";
    import Notification from "../../Components/Notification.svelte";

    // Mise en place du temps pour le timer
    let timer = {
        minutes: 1,
        seconds: 10,
    };

    // Mise en place des données pour les checkbox
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

    // Mise en place des données de la session pour le texte
    let text = {
        session: "#35878454",
        page: "4/10",
        title: "Pourquoi le Japon ?",
        description: "Bah oui c'est vrai mdr",
        placeholder: "Blablabla"
    }

    // Mise en place du formulaire pour les checkbox
    let form = {
        checked1: false,
        checked2: false,
        checked3: false,
        checked4: false,
        checked5: false,
        checked6: false,
        checked7: false,
        checked8: false,
        checked9: false,
        checked10: false,
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
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
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
        <div class="gridradio flex justify-center gap-40">
            <div class="radio1 flex flex-col gap-4">
                <div class="flex gap-4">
                    <CheckBox
                        bind:checked={form.checked1}
                    />
                    <p>Le saumon</p>
                </div>
                <div class="flex gap-4">
                    <CheckBox
                        bind:checked={form.checked2}
                    />
                    <p>Le saumon</p>
                </div>
                <div class="flex gap-4">
                    <CheckBox
                        bind:checked={form.checked3}
                    />
                    <p>Le saumon</p>
                </div>
                <div class="flex gap-4">
                    <CheckBox
                        bind:checked={form.checked4}
                    />
                    <p>Le saumon</p>
                </div> 
                <div class="flex gap-4">
                    <CheckBox
                        bind:checked={form.checked5}
                    />
                    <p>Le saumon</p>
                </div>
            </div>
            <div class="radio2 flex flex-col gap-4">
                <div class="flex gap-4">
                    <CheckBox
                        bind:checked={form.checked6}
                    />
                    <p>Le saumon</p>
                </div>
                <div class="flex gap-4">
                    <CheckBox
                        bind:checked={form.checked7}
                    />
                    <p>Le saumon</p>
                </div>
                <div class="flex gap-4">
                    <CheckBox
                        bind:checked={form.checked8}
                    />
                    <p>Le saumon</p>
                </div>
                <div class="flex gap-4">
                    <CheckBox
                        bind:checked={form.checked9}
                    />
                    <p>Le saumon</p>
                </div> 
                <div class="flex gap-4">
                    <CheckBox
                        bind:checked={form.checked10}
                    />
                    <p>Le saumon</p>
                </div>
            </div>
        </div>
        <div class="timer-tags flex flex-row items-end gap-1">
            <Timer
                bind:minutes={timer.minutes}
                bind:seconds={timer.seconds}
            />
        </div>
        <div class="button flex justify-end items-end">
            <Button class="outline" action={() => {notify("Quitter la session","Souhaitez-vous vraiment quitter la session ?","normal",0,"box","middle",false,"",() => {window.location.href ="/"},"leave")}}>Quitter la session</Button>
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

    .gridradio {
        grid-row: 2;
        grid-column: 1/3;
    }
</style>