<script lang="ts">
    import NavLink from "@/Components/NavLink.svelte";
    import TextBox from "../Components/TextBox.svelte";
    import { page, router } from "@inertiajs/svelte";
    import Notification from "../Components/Notification.svelte";
    import PageSwitchLayout from "@/Layouts/PageSwitchLayout.svelte";

    // On récupère les données de l'utilisateur
    let profile = $page.props.auth.user;

    // On crée un objet user qui contient les données de l'utilisateur
    let user = {
        pseudo: profile.name,
        email: profile.email,
        avatar: "/avatars/" + profile.id + ".webp" + "?" + Date.now(),
    }

    // On initialise la variable modify à false qui permet de savoir si on est en train de modifier les informations de l'utilisateur
    // On initialise la variable index qui permet de savoir sur quelle partie de la page on se trouve
    let index = "Profil";
    let modify : any = false;

    // On crée un objet infos qui contient les données de l'utilisateur qui sont modifiables sur la page
    let infos = {
        pseudo: user.pseudo,
        email: user.email,
    }

    /* ---------------------------- */
    /*      ERRORS CREATIONS        */
    /* ---------------------------- */

    $: {

        // On récupère les données de l'utilisateur
        profile = $page.props.auth.user

        // On met à jour user qui contient les données de l'utilisateur
        user = {
            pseudo: profile.name,
            email: profile.email,
            avatar: "/api/user/avatar/" + profile.id + "?" + Date.now(),
        }

        // On remet modify à false
        modify = false;

        // On met à jour status qui contient le code de status
        let status = $page.props.flash.status;

        // On crée une variable description qui contient la description des codes de status
        let description = {
            1001: "Le nom d'utilisateur a été modifié avec succès",
            1002: "L'email a été modifié avec succès",
            1003: "L'avatar a été modifié avec succès",
            1101: "Le nom d'utilisateur est vide",
            1102: "Le nom d'utilisateur est trop long (max 20 caractères)",
            1103: "L'email est déjà utilisé",
            1104: "L'email est vide",
            1105: "L'email est invalide",
            1106: "L'avatar est trop lourd (A définir)",
            1107: "L'avatar n'est pas au bon format (jpeg, png ou webp)",
            1108: "L'avatar est vide",
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

    let inputText : string = "";    

    /* ---------------------------- */
    /*      UPDATE FUNCTIONS        */
    /* ---------------------------- */

    // Fonction qui permet de modifier le pseudo de l'utilisateur
    function updateUsername() {
        router.put("/user/username", { username: infos.pseudo })
    }

    // Fonction qui permet de modifier l'email de l'utilisateur
    function updateEmail() {
        router.put("/user/email", { email: infos.email })
    }

    // Fonction qui permet de modifier l'avatar de l'utilisateur
    function updateAvatar() {
        router.post("/user/avatar", { avatar: user.avatar })
    }

    // Si on appuie sur echap et que la notification est ouverte, on la ferme
    document.addEventListener("keydown", (e) => {
        if (e.key == "Escape") {
            if (document.getElementById("session") != null) {
                document.getElementById("session").parentElement.remove();
            }
        }
    });

    /* ---------------------------- */
    /*    NOTIFICATION FUNCTION     */
    /* ---------------------------- */

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
    <main class="h-full w-full overflow-hidden bg-no-repeat min-h-screen">
        <nav class="navbar-container flex justify-between w-full py-12 px-56 bg-white">
            <h1 class="font-semibold text-[2rem] text-black">DramaQuick</h1>
            <div class="content flex items-center flex-row gap-2">
                <NavLink href="/" activate={true}>Accueil</NavLink>
                <NavLink href="" action={() => {notify("Rejoindre une session","","normal",0,"box","middle",true,"Entrer le code de session",(inputText) => {
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
                    },"session", true)}}>Rejoindre une session</NavLink>
                <NavLink type={"button"} inertiaction={{ href: "/logout", method: "post" }} href>Se déconnecter</NavLink>
            </div>
        </nav>
        <div class="contenu flex flex-row relative pt-28 justify-evenly">
            <div class="w-[284px] flex flex-col items-center">
                <img src={user.avatar} alt="avatar" class="rounded-full w-[284px] h-[284px] object-cover" />
                <div class="inputfile">
                    <input type="file" id="file" accept="image/png, image/jpeg"
                    name="avatar"
                    class="hidden"
                    on:input={e => { user.avatar = e.target.files[0]; updateAvatar(); }}
                    >
                    <label for="file" class=""><svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.3765 1.59618C24.6441 0.836093 23.6514 0.40918 22.6164 0.40918C21.5814 0.40918 20.5887 0.836093 19.8563 1.59618L2.33476 19.8077C1.833 20.3263 1.43516 20.9431 1.16425 21.6225C0.893342 22.302 0.754748 23.0305 0.756486 23.766V26.0648C0.756486 26.3618 0.869989 26.6466 1.07203 26.8566C1.27406 27.0666 1.54808 27.1845 1.83381 27.1845H4.04555C4.75309 27.1866 5.454 27.0428 6.10771 26.7614C6.76141 26.48 7.35492 26.0666 7.85388 25.5452L25.3765 7.33262C26.1075 6.57141 26.518 5.53987 26.518 4.4644C26.518 3.38892 26.1075 2.35738 25.3765 1.59618ZM6.33054 23.9619C5.72294 24.5893 4.90198 24.9425 4.04555 24.945H2.91113V23.766C2.91004 23.3247 2.99317 22.8875 3.15572 22.4799C3.31827 22.0722 3.557 21.7021 3.85809 21.391L17.1555 7.57L19.6333 10.1454L6.33054 23.9619ZM23.8521 5.7493L21.1523 8.5565L18.6745 5.98669L21.3753 3.17949C21.538 3.01076 21.7311 2.87698 21.9435 2.7858C22.156 2.69462 22.3836 2.64783 22.6135 2.64809C22.8433 2.64835 23.0708 2.69566 23.2831 2.78732C23.4953 2.87898 23.6881 3.01319 23.8505 3.18229C24.0128 3.3514 24.1415 3.55208 24.2293 3.77288C24.317 3.99369 24.362 4.23029 24.3617 4.46918C24.3615 4.70807 24.316 4.94456 24.2278 5.16517C24.1396 5.38577 24.0105 5.58616 23.8478 5.7549L23.8521 5.7493Z" fill="white"/>
                        </svg></label>
                </div>
                <h1 class="display-pseudo font-semibold text-[3rem] text-black mt-8">{user.pseudo}</h1>
            </div>
            <div class="infos bg-[#FBFBFB] w-[48.75rem] h-max rounded-lg p-8">
                <div class="inner-nav flex flex-row rounded-lg bg-[#F2F2F2] justify-between p-4">
                    <button class="text-[1.25rem] text-black px-8 rounded-lg transition {index === "Profil" ? "bg-[#34FFAD]" : "bg-transparent"}" on:click={() => index = "Profil"}>Profil</button>
                    <div class="w-0.5 h-[2.75rem] bg-[#C5C5C5]"></div>
                    <!--<button class="text-[1.25rem] text-black px-8 rounded-lg transition {index === "Préférences" ? "bg-[#34FFAD]" : "bg-transparent"}" on:click={() => index = "Préférences"}>Préférences</button>
                    <div class="w-0.5 h-[2.75rem] bg-[#C5C5C5]"></div>-->
                    <button class="infos-perso-button text-[1.25rem] max-[400px]:text-[1rem] text-black px-8 rounded-lg transition {index === "Informations personnelles" ? "bg-[#34FFAD]" : "bg-transparent"}" on:click={() => index = "Informations personnelles"}>Informations personnelles</button>
                </div>
                <div class="flex flex-col mt-8">
                {#if index === "Profil"}
                <div class="actions-pseudo flex items-center gap-4">
                    <h1 class="font-semibold text-[1.375rem] text-black">Pseudo</h1>
                    <button class="underline text-[1rem] text-[#B7B7B7]" on:click={() => modify = "pseudo"}>Changer de pseudo</button>
                </div>
                <div class="modify-pseudo pt-4 flex gap-4 items-center">
                {#if modify === "pseudo"}
                <TextBox placeholder="Pseudo" bind:value={infos.pseudo} showIcon={false}/>
                <button class="text-[1rem] text-[#B7B7B7] underline valider" on:click={() => {updateUsername()}}><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_18_95)">
                    <path d="M5.81189 15.497C5.30095 15.4972 4.81093 15.2941 4.44994 14.9325L0.332296 10.8164C-0.110765 10.3732 -0.110765 9.65476 0.332296 9.21156C0.775498 8.7685 1.49393 8.7685 1.93713 9.21156L5.81189 13.0863L16.0629 2.83535C16.5061 2.39229 17.2245 2.39229 17.6677 2.83535C18.1108 3.27855 18.1108 3.99698 17.6677 4.44018L7.17384 14.9325C6.81286 15.2941 6.32284 15.4972 5.81189 15.497Z" fill="#3DED2F"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_18_95">
                    <rect width="18" height="18" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg></button>
                {:else}
                <h1 class="font-semibold text-[1.25rem] text-[#4B4B4B] pt-4">{user.pseudo}</h1>
                {/if}
                </div>
                {/if}
                {#if index === "Informations personnelles"}
                <div class="actions-email flex items-center gap-4">
                    <h1 class="font-semibold text-[1.375rem] text-black">Email</h1>
                    <button class="underline text-[1rem] text-[#B7B7B7]" on:click={() => modify = "email"}>Changer d'email</button>
                </div>
                <div class="modify-email pt-4 flex gap-4 items-center">
                {#if modify === "email"}
                <TextBox placeholder="Email" bind:value={infos.email} showIcon={false} required/>
                <button class="text-[1rem] text-[#B7B7B7] underline valider" on:click={() => {updateEmail()}}><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_18_95)">
                    <path d="M5.81189 15.497C5.30095 15.4972 4.81093 15.2941 4.44994 14.9325L0.332296 10.8164C-0.110765 10.3732 -0.110765 9.65476 0.332296 9.21156C0.775498 8.7685 1.49393 8.7685 1.93713 9.21156L5.81189 13.0863L16.0629 2.83535C16.5061 2.39229 17.2245 2.39229 17.6677 2.83535C18.1108 3.27855 18.1108 3.99698 17.6677 4.44018L7.17384 14.9325C6.81286 15.2941 6.32284 15.4972 5.81189 15.497Z" fill="#3DED2F"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_18_95">
                    <rect width="18" height="18" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg></button>
                {:else}
                <h1 class="display-email font-semibold text-[1.25rem] text-[#4B4B4B] pt-4">{user.email}</h1>
                {/if}
                </div>
                {/if}
                </div>
            </div>
        </div>
    </main>
</PageSwitchLayout>

<style>
    main {
        background-image: url("/img/landing/demiback.png");
        /* le background prend la moitié basse de la page, le haut reste blanc */
        background-position: bottom;
    }

    .inputfile path {
        fill: black;
    }

    .inputfile svg {
        width: 2rem;
        height: 2rem;
    }

    .inputfile label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 4rem;
        height: 4rem;
        background-color: #34FFAD;
        border-radius: 300px;
        cursor: pointer;
        position: relative;
        top: -5rem;
        left: 7rem;
    }

    .valider {
        display: flex;
        background-color: #34FFAD;
        border-radius: 300px;
        cursor: pointer;
        width: 2.5rem;
        height: 2.5rem;
        justify-content: center;
        align-items: center;
    }

    .valider path {
        fill: black;
    }


    @media screen and (max-width: 1200px) {
        main nav div {
            display: none;
        }

        main {
            background: linear-gradient(223.99deg, #F0E583 0%, #34FFAD 98.31%, #CBEF81 34.82%, #97F88F 67.07%);
        }

        .contenu {
            flex-direction: column;
            align-items: center;
        }

        main .infos {
            margin-top: 50px;
            margin-bottom: 100px;
        }
    }


    @media screen and (max-width:800px) {
        .infos {
            width: 90%;
        }

        .inner-nav {
            flex-direction: column;
            gap: 1rem;
        }

        .inner-nav div {
            display: none;
        }

        .inner-nav button {
            padding: 0.5rem 0 0.5rem 0;
        }

        .display-pseudo {
            font-size: 2rem;
        }

        .navbar-container {
            padding: 2rem 7rem 2rem 7rem;
        }
    }


    @media screen and (max-width: 500px) {
        .actions-pseudo {
            flex-direction: column;
        }

        .modify-pseudo {
            flex-direction: column;
        }

        .display-pseudo {
            font-size: 1.5rem;
        }

        .actions-email {
            flex-direction: column;
        }

        .modify-email {
            flex-direction: column;
        }

        .display-email {
            font-size: 1rem;
        }

        .navbar-container {
            padding: 2rem 0 2rem 0;
            display: flex;
            justify-content: center;
        }
    }

    
    @media screen and (max-width: 400px) {
        .infos-perso-button {
            font-size: 0.8rem;
        }
    }


</style>