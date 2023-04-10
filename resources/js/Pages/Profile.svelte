<script>
    import NavLink from "@/Components/NavLink.svelte";
    import TextBox from "../Components/TextBox.svelte";
    import { page, router } from "@inertiajs/svelte";
    import Notification from "../Components/Notification.svelte";

    let profile = $page.props.auth.user;

    let user = {
        pseudo: profile.name,
        email: profile.email,
        avatar: "/avatars/" + profile.id + ".webp" + "?" + Date.now(),
    }

    let index = "Profil";
    let modify = false;

    let infos = {
        pseudo: user.pseudo,
        email: user.email,
    }

    /* ---------------------------- */
    /*      ERRORS CREATIONS        */
    /* ---------------------------- */

    $: {

        profile = $page.props.auth.user

        user = {
            pseudo: profile.name,
            email: profile.email,
            avatar: "/user/avatar/" + profile.id + "?" + Date.now(),
        }

        modify = false;

        let status = $page.props.flash.status;

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
        }[status];

        if(status) {
            let isError = status.toString()[1] == "1";

            if (isError) notify("Erreur", description, "error", 5000, "box", "corner-bottom-right", false, '', '', "error");
            else notify("Succès", description, "success", 5000, "box", "corner-bottom-right", false, '', '', "success");
        }
    }   

    

    /* ---------------------------- */
    /*      UPDATE FUNCTIONS        */
    /* ---------------------------- */

    function updateUsername() {
        router.put("/user/username", { username: infos.pseudo })
    }

    function updateEmail() {
        router.put("/user/email", { email: infos.email })
    }

    function updateAvatar() {
        router.post("/user/avatar", { avatar: user.avatar })
    }

    /* ---------------------------- */
    /*    NOTIFICATION FUNCTION     */
    /* ---------------------------- */

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
<main class="h-screen w-full overflow-hidden bg-no-repeat">
    <nav class="flex justify-between w-full py-12 px-56">
        <h1 class="font-semibold text-[2rem] text-black">DramaQuick</h1>
        <div class="content flex flex-row gap-2">
            <NavLink href="/" activate={true}>Accueil</NavLink>
            <NavLink href="" action={() => {notify("Rejoindre une session","","normal",0,"box","middle",true,"Entrer le code de session",() => {window.location.href ="/session-start"},"session")}}>Rejoindre une session</NavLink>
            <NavLink type={"button"} inertiaction={{ href: "/logout", method: "post" }}>Se déconnecter</NavLink>
        </div>
    </nav>
    <div class="contenu flex flex-row relative px-56 pt-8 gap-100">
        <div class="py-20 w-[17.75rem]">
            <img src={user.avatar} alt="avatar" class="rounded-full w-[17.75rem] h-[17.75rem] object-cover" />
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
            <h1 class="font-semibold text-[3rem] text-black mt-8">{user.pseudo}</h1>
        </div>
        <div class="bg-[#FBFBFB] w-[48.75rem] h-[44rem] rounded-lg p-8">
            <div class="flex flex-row rounded-lg bg-[#F2F2F2] justify-between p-4">
                {#if index === "Profil"}
                <button class="text-[1.25rem] text-black px-8 rounded-lg bg-[#34FFAD]" on:click={() => index = "Profil"}>Profil</button>
                <div class="w-0.5 h-[2.75rem] bg-[#C5C5C5]"></div>
                <button class="text-[1.25rem] text-black px-8 rounded-lg" on:click={() => index = "Préférences"}>Préférences</button>
                <div class="w-0.5 h-[2.75rem] bg-[#C5C5C5]"></div>
                <button class="text-[1.25rem] text-black px-8 rounded-lg" on:click={() => index = "Informations personnelles"}>Informations personnelles</button>
                {:else if index === "Préférences"}
                <button class="text-[1.25rem] text-black px-8 rounded-lg" on:click={() => index = "Profil"}>Profil</button>
                <div class="w-0.5 h-[2.75rem] bg-[#C5C5C5]"></div>
                <button class="text-[1.25rem] text-black px-8 rounded-lg bg-[#34FFAD]" on:click={() => index = "Préférences"}>Préférences</button>
                <div class="w-0.5 h-[2.75rem] bg-[#C5C5C5]"></div>
                <button class="text-[1.25rem] text-black px-8 rounded-lg" on:click={() => index = "Informations personnelles"}>Informations personnelles</button>
                {:else if index === "Informations personnelles"}
                <button class="text-[1.25rem] text-black px-8 rounded-lg" on:click={() => index = "Profil"}>Profil</button>
                <div class="w-0.5 h-[2.75rem] bg-[#C5C5C5]"></div>
                <button class="text-[1.25rem] text-black px-8 rounded-lg" on:click={() => index = "Préférences"}>Préférences</button>
                <div class="w-0.5 h-[2.75rem] bg-[#C5C5C5]"></div>
                <button class="text-[1.25rem] text-black px-8 rounded-lg bg-[#34FFAD]" on:click={() => index = "Informations personnelles"}>Informations personnelles</button>
                {/if}
            </div>
            <div class="flex flex-col mt-8 px-8">
            {#if index === "Profil"}
            <div class="flex items-center gap-4">
                <h1 class="font-semibold text-[1.375rem] text-black">Pseudo</h1>
                <button class="underline text-[1rem] text-[#B7B7B7]" on:click={() => modify = "pseudo"}>Changer de pseudo</button>
            </div>
            <div class="pt-4 flex gap-4 items-center">
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
            <div class="flex items-center gap-4">
                <h1 class="font-semibold text-[1.375rem] text-black">Email</h1>
                <button class="underline text-[1rem] text-[#B7B7B7]" on:click={() => modify = "email"}>Changer d'email</button>
            </div>
            <div class="pt-4 flex gap-4 items-center">
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
            <h1 class="font-semibold text-[1.25rem] text-[#4B4B4B] pt-4">{user.email}</h1>
            {/if}
            </div>
            {/if}
            </div>
        </div>
    </div>
</main>

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
        border-radius: 50%;
        cursor: pointer;
        position: absolute;
        top: 20rem;
        left: 28rem;
    }

    .valider {
        display: flex;
        background-color: #34FFAD;
        border-radius: 50%;
        cursor: pointer;
        width: 2.5rem;
        height: 2.5rem;
        justify-content: center;
        align-items: center;
    }

    .valider path {
        fill: black;
    }


</style>