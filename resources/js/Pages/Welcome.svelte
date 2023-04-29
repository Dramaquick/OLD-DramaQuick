<script lang="ts">
    import Button from '../Components/Button.svelte';
    import Value from "@/Components/Value.svelte";
    import Nav from '@/Layouts/Nav.svelte';
    import Notification from "@/Components/Notification.svelte";
    import PageSwitchLayout from '@/Layouts/PageSwitchLayout.svelte';
    import {router,page} from "@inertiajs/svelte";

    // Si on appuie sur echap et que la notification est ouverte, on la ferme
    document.addEventListener("keydown", (e) => {
        if (e.key == "Escape") {
            if (document.getElementById("session") != null) {
                document.getElementById("session").parentElement.remove();
            }
        }
    });

    let inputText : string = "";

    $: {
            // On met à jour status qui contient le code de status
            let status = $page.props.flash.status;
            console.log("status:"+status);

            // On crée une variable description qui contient la description des codes de status
            let description = {
                2129: "Impossible de rejoindre la session",
            }[status];

            // On vérifie si on a un code de status
            if(status) {

                // On vérifie si le code de status est une erreur
                let isError = status.toString()[1] == "1";

                // On affiche la notification
                if (isError) notify("Erreur", description, "error", 5000, "box", "corner-bottom-right", false, '', '', "error", false);
                else notify("Succès", description, "success", 5000, "box", "corner-bottom-right", false, '', '', "success", false);
            }
    }

    let sessionsFinished : string = "0";

    let sessionsInProgress : string = "0";

    let totalAsnwers : string = "0";

    window.axios.get("/api/sessions/finished").then((response) => {
        sessionsFinished = response.data['sessions'].toString();
    });

    window.axios.get("/api/sessions/inprogress").then((response) => {
        sessionsInProgress = response.data['sessions'].toString();
    });

    window.axios.get("/api/answers/all").then((response) => {
        totalAsnwers = response.data['answers'].toString();
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
                    <Button class="" action={() => {notify("Rejoindre une session","","normal",0,"box","middle",true,"Entrer le code de session",(inputText) => {
                        if(inputText == "") {
                            notify("Erreur","Veuillez entrer un code de session","error",5000,"box","corner-bottom-right",false,'','', "error", false);
                            return;
                        }
                        // On test que le code de session entré est bien un nombre
                        if(isNaN(parseInt(inputText))) {
                            notify("Erreur","Veuillez entrer un code de session valide","error",5000,"box","corner-bottom-right",false,'','', "error", false);
                            return;
                        }
                        window.location.href = "/quiz/"+inputText;
                        },"session", true)}}>Rejoindre une session</Button>
                    <Button
                        class="outline"
                        action={() => {window.location.href ="/quiz/create"}}
                    >Créer une session</Button
                    >
                </div>
                <div class="w-full max-[700px]:flex max-[700px]:flex-col max-[700px]:items-center">
                    <div class="flex flex-row gap-20 text-center pt-20 w-fit max-[700px]:flex max-[700px]:flex-col max-[700px]:items-center">
                        <div class="bg-white rounded-xl p-4 border-white max-[700px]:border-gray-300 border-2">
                            <Value value={sessionsFinished}/>
                            <p
                                class="text-2xl text-[#273C33] leading-9 font-w400 w-fit"
                            >
                                Quiz<br />réalisés
                            </p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border-white max-[700px]:border-gray-300 border-2">
                            <Value value={sessionsInProgress}/>
                            <p
                                class="text-2xl text-[#273C33] leading-9 font-w400 w-fit"
                            >
                                Sessions<br />actives
                            </p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border-white max-[700px]:border-gray-300 border-2">
                            <Value value={totalAsnwers}/>
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