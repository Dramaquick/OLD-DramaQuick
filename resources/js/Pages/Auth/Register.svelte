<script>
    import BreezeButton from "@/Components/Button.svelte";
    import BreezeCheckbox from "@/Components/Checkbox.svelte";
    import BreezeInput from "@/Components/TextBox.svelte";
    import BreezeValidationErrors from "@/Components/ValidationErrors.svelte";
    import { inertia, useForm } from "@inertiajs/svelte";
    import Link from "@/Components/Link.svelte";
    export let errors = {};

    let form = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        terms: false,
    });

    let err = {};

    $: {
        err = errors;
    }

    if (document.getElementById("session") != null) {
        document.getElementById("session").remove();
    }

    const submit = () => {
        if (document.getElementById("login") != null) {
        document.getElementById("login").remove();
        }
        if (form.terms == true) {
        $form.post("/register", {
            onSuccess: () => $form.reset("password", "password_confirmation"),});
        }
        else {
            err = {error : "Vous devez accepter les conditions d'utilisation"};
        }
    };
    
</script>

<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<main>
    <div class="right">
    </div>
    <div class="left">
        <h1>S'inscrire</h1>
        <h2>Entrez vos informations ci-dessous.</h2>
            <BreezeValidationErrors errors={err} />

    <form on:submit|preventDefault={submit} class="flex flex-col gap-4">
        <div class="w-full">
            <label for="pseudo">Pseudo</label>
            <BreezeInput
                bind:value={form.name}
                required
                autofocus
                autocomplete="username"
                placeholder="Entrez votre pseudo..."
                showIcon={false}
                wrapperClass="w-full"
                class="w-full"
                on:input={(evt) => ($form.name = evt.detail)}
            />
        </div>

        <div>
            <label for="email">Email</label>
            <BreezeInput
                bind:value={form.email}
                required
                autofocus
                autocomplete="username"
                placeholder="Entrez votre email..."
                showIcon={false}
                wrapperClass="w-full"
                class="w-full"
                on:input={(evt) => ($form.email = evt.detail)}
            />
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <BreezeInput
                bind:value={form.password}
                required
                autocomplete="current-password"
                placeholder="Entrez votre mot de passe..."
                showIcon={false}
                type="password"
                class="w-full"
                on:input={(evt) => ($form.password = evt.detail)}
            />
            </div>
        <div>
            <label for="password">Confirmez votre mot de passe</label>
            <BreezeInput
                bind:value={form.password_confirmation}
                required
                autocomplete="current-password"
                placeholder="Confirmez votre mot de passe..."
                showIcon={false}
                type="password"
                wrapperClass="w-full"
                class="w-full"
                on:input={(evt) => ($form.password_confirmation = evt.detail)}
            />
        </div>

        <div class="bottom-form">
            <div>
                <!-- svelte-ignore a11y-label-has-associated-control -->
                <label class="flex items-center">
                    <BreezeCheckbox name="terms" bind:checked={form.terms} />
                    <span class="terms">J'accepte les CGU</span>
                </label>
            </div>
        </div>
        <div class="submit">
            <BreezeButton
                sclass:opacity-25={form.processing}
                disabled={form.processing}
                style="width: 100%;"
            >
                S'inscrire
            </BreezeButton>
        </div>
        <div class="line">
            <div>
                <svg width="211" height="3" viewBox="0 0 211 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M210.5 1.8125H0" stroke="#B1B9B6" stroke-opacity="0.5" stroke-width="2"/>
                </svg>  
            </div>
            <div>
                <p>Ou</p>
            </div>
            <div>
                <svg width="211" height="3" viewBox="0 0 211 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M210.5 1.8125H0" stroke="#B1B9B6" stroke-opacity="0.5" stroke-width="2"/>
                </svg> 
            </div>
        </div>
        <div class="bottom">
            <div>
                <h3>Je suis déjà inscrit !</h3>
            </div>
            <div class="space"> 
                <Link href="login">
                    Me connecter
                </Link>
            </div>
        </div>
    </form>
</div>
</main>


<style>
    main {

        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        height: 100vh;


    }

    .right {

        background: linear-gradient(223.99deg, #F0E583 0%, #34FFAD 98.31%, #CBEF81 34.82%, #97F88F 67.07%);
        width: 69.875rem;
        height: 100%;

    }
    .left {

        background-color: #FBFBFB;
        width: 50.125rem;
        height: 100%;

    }


    .left h1 {

        font-family: 'Poppins';
        font-style: normal;
        font-weight: 600;
        font-size: 2rem;
        line-height: 3rem;
        color: #0D241B;
        margin-top: 4rem;
        margin-left: 6.5rem;

    }

    .left h2 {

        left: 100px;
        top: 275.69px;
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        font-size: 20px;
        line-height: 30px;
        color: #808A86;
        margin-left: 6.5rem;

    }

    form {
            
        margin-left: 100px;
        margin-top: 50px;
        width: 30.5rem;

    }

    label {

        font-family: 'Poppins';
        font-style: normal;
        font-weight: 500;
        font-size: 1.3125rem;
        line-height: 2rem;
        color: #47524E;

    }
    
    .submit {

        margin-top: 1.875rem;

    }

    .line {

        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin-top: 1.875rem;

    }

    .left p {
            
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            font-size: 1.125rem;
            line-height: 1.6875rem;
            color: rgba(177, 185, 182, 0.5);
    }

    .bottom {

        display: flex;
        flex-direction: row;
        align-items: center;
        font-family: "Poppins";
        font-style: normal;
        font-weight: 400;
        font-size: 1.125rem;
        margin-top: 1.875rem;
        color: #808A86;

    }

    .space {
            
        margin-left: 0.71125rem;
            
    }

    .bottom-form {

        display: flex;
        flex-direction: row;
        align-items: center;
        margin-top: 30px;

    }

    .terms {

        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        font-size: 1.125rem;
        line-height: 1.6875rem;
        color: #000000;
        margin-left: 0.71125rem;

    }

</style>