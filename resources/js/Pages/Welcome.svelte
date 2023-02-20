<script>
    import Button from '../Components/Button.svelte';
    import NavLink from "@/Components/NavLink.svelte";
    import Value from "@/Components/Value.svelte";
    import UserButton from "@/Components/UserButton.svelte";
    import { page } from '@inertiajs/inertia-svelte';
    import Nav from '@/Layouts/Nav.svelte';
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
            <div class="gap-8 flex flex-row w-fit">
                <div class="space">
                    <Button class="" on:click={() => (window.location.href = "/login")}
                    >Rejoindre une session</Button
                    >
                </div>
                <Button
                    class="outline"
                    on:click={() => (window.location.href = "/login")}
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
        <div class="flex flex-row w-full items-center">
            <img class="pl-50 pt-40" src="/img/landing/arrow.svg" alt="" />
            <img class="pt-40" src="/img/landing/logo.svg" alt="" />
            <img class="pb-110" src="/img/landing/louping.svg" alt="" />
        </div>
    </div>
</Nav>