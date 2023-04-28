<script lang="ts">
    import Button from '../Components/Button.svelte';
    import Value from "@/Components/Value.svelte";
    import Nav from '@/Layouts/Nav.svelte';
    import Notification from "@/Components/Notification.svelte";
    import { onMount } from 'svelte';
    import PageSwitchLayout from '@/Layouts/PageSwitchLayout.svelte';

    // Si on appuie sur echap et que la notification est ouverte, on la ferme
    document.addEventListener("keydown", (e) => {
        if (e.key == "Escape") {
            if (document.getElementById("session") != null) {
                document.getElementById("session").parentElement.remove();
            }
        }
    });
    

    // function for notifications
    function notify(title, text, type, duration, format, position, input, placeholder, action, id, blurBackground) {
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
                id,
                blurBackground
            }
        });
    }
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<PageSwitchLayout>
    <Nav>
        <div class="contenu flex flex-row min-h-screen w-screen max-h-fit">
            <div class="pl-56 pt-45 w-full max-[1300px]:pl-16 max-[1300px]:pr-16 max-[500px]:pl-8 max-[500px]:pr-8">
                <h1 class="font-semibold text-[3rem] text-black w-160 max-[750px]:text-[2rem] max-[750px]:w-full">
                    Une nouvelle version de DramaQuiz
                </h1>
                <p class="w-144 font-normal py-6 text-[1.5rem] max-[750px]:w-full max-[750px]:text-[1.2rem]">
                    DramaQuick est une version de DramaQuiz accélérée ; des
                    questionnaires temporaires, des sessions de quiz... Tout cela a
                    été créé avec une idée : l’éphémérité !
                </p>
                <div class="gap-8 flex flex-row w-[35.5rem] max-[700px]:flex-col max-[700px]:w-full max-[500px]:text-sm">
                    <Button class="" action={() => {notify("Rejoindre une session","","normal",0,"box","middle",true,"Entrer le code de session",() => {},"session", true)}}>Rejoindre une session</Button>
                    <Button
                        class="outline"
                        action={() => {window.location.href ="/quiz/create"}}
                    >Créer une session</Button
                    >
                </div>
                <div class="w-full max-[700px]:flex max-[700px]:flex-col max-[700px]:items-center">
                    <div class="flex flex-row gap-20 text-center py-20 w-fit max-[700px]:flex max-[700px]:flex-col max-[700px]:items-center">
                        <div class="bg-white rounded-xl p-4 border-white max-[700px]:border-gray-300 border-2">
                            <Value value="15"/>
                            <p
                                class="text-2xl text-[#273C33] leading-9 font-w400 w-fit"
                            >
                                Quiz<br />réalisés
                            </p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border-white max-[700px]:border-gray-300 border-2">
                            <Value value="3"/>
                            <p
                                class="text-2xl text-[#273C33] leading-9 font-w400 w-fit"
                            >
                                Sessions<br />actives
                            </p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border-white max-[700px]:border-gray-300 border-2">
                            <Value value="124"/>
                            <p class="text-2xl text-[#273C33] leading-9 font-w400 w-fit">
                                Participa-<br />tions
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Nav>
</PageSwitchLayout>