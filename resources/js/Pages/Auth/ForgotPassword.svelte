<script>
    import BreezeButton from "@/Components/Button.svelte";
    import BreezeCheckbox from "@/Components/Checkbox.svelte";
    import BreezeInput from "@/Components/TextBox.svelte";
    import BreezeValidationErrors from "@/Components/ValidationErrors.svelte";
    import { useForm } from "@inertiajs/svelte";
    import Link from "@/Components/Link.svelte";
    let err = {};
    export let errors = {};
    export let status;
    $: {
        err = errors;
    }
    const form = useForm({
        email: "",
    });
    const onSubmit = () => {
        $form.post(window.route("password.email"));
    };
</script>

<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<main>
    <div class="right">
    </div>
    <div class="left">
        <h1>Mot de passe oublié</h1>
        <h2>Entrez vos informations ci-dessous.</h2>

        {#if status}
            <div class="mb-4 font-medium text-sm text-green-600">
                {status}
            </div>
        {/if}
    
        <BreezeValidationErrors class="mb-4" errors={err} />

    <form on:submit|preventDefault={onSubmit}>
        <div>
            <label for="email">Email</label>
            <div class="input">
            <BreezeInput
                value={form.email}
                required
                autofocus
                autocomplete="username"
                placeholder="Entrez votre email..."
                showIcon={false}
                style="width: 30.510625rem"
                on:input={(evt) => ($form.email = evt.detail)}
            />
        </div>
        </div>

        <div class="submit">
            <BreezeButton
                sclass:opacity-25={form.processing}
                disabled={form.processing}
                style="width: 100%;"
            >
                Envoyer mail de réinitialisation
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
        margin-top: 9rem;
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

    .input {
            
            margin-top: 10px;
            margin-bottom: 30px;
    
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

</style>