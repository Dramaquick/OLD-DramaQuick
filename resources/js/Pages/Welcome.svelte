<script>
    import Button from '../Components/Button.svelte';
    import Value from "@/Components/Value.svelte";
    import Nav from '@/Layouts/Nav.svelte';
    import Notification from "@/Components/Notification.svelte";

    window.Echo.channel('test-channel')
                .listen('TestEvent', (e) => {
                    alert(e);
                });

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
<Nav>
    <div class="contenu flex flex-row h-screen w-screen">
        <div class="pl-56 pt-45 w-1/2">
            <h1 class="font-semibold text-[3rem] text-black w-160">
                Une nouvelle version de DramaQuiz
            </h1>
            <p class="w-144 font-normal py-6 text-[1.5rem]">
                DramaQuick est une version de DramaQuiz accélérée ; des
                questionnaires temporaires, des sessions de quiz... Tout cela a
                été créé avec une idée : l’éphémérité !
            </p>
            <div class="gap-8 flex flex-row w-[35.5rem]">
                <Button class="" action={() => {notify("Rejoindre une session","","normal",0,"box","middle",true,"Entrer le code de session",() => {window.location.href ="/session-start"},"session")}}>Rejoindre une session</Button>
                <Button
                    class="outline"
                    action={() => {window.location.href ="/quiz/create"}}
                >Créer une session</Button
                >
            </div>
            <div class="flex flex-row gap-20 text-center py-20 w-fit">
                <div>
                    <Value value="15"/>
                    <p
                        class="text-2xl text-[#273C33] leading-9 font-w400 w-fit"
                    >
                        Quiz<br />réalisés
                    </p>
                </div>
                <div>
                    <Value value="3"/>
                    <p
                        class="text-2xl text-[#273C33] leading-9 font-w400 w-fit"
                    >
                        Sessions<br />actives
                    </p>
                </div>
                <div>
                    <Value value="124"/>
                    <p class="text-2xl text-[#273C33] leading-9 font-w400 w-fit">
                        Participa-<br />tions
                    </p>
                </div>
            </div>
        </div>
    </div>
</Nav>