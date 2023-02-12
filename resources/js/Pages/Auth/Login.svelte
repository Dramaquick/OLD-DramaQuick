<script>
    import BreezeButton from "@/Components/Button.svelte";
    import BreezeCheckbox from "@/Components/Checkbox.svelte";
    import BreezeInput from "@/Components/TextBox.svelte";
    import BreezeValidationErrors from "@/Components/ValidationErrors.svelte";
    import { useForm } from "@inertiajs/inertia-svelte";
    import Link from "@/Components/Link.svelte";
    let err = {};
    export let errors = {};
    export let canResetPassword;
    export let status;

    const form = useForm({
        email: null,
        password: null,
        remember: false,
    });

    $: {
        err = errors;
    }

    const onSubmit = () => {
        $form.post("/login", {
            onSuccess: () => $form.reset(),
        });
    };
</script>

<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<main>
    <div class="right">
        <div class="right_content">
            <h1>Se connecter</h1>
            <h2>Entrez vos informations ci-dessous.</h2>
            <BreezeValidationErrors class="mb-4" errors={err} />

            {#if status}
                <div class="mb-4 font-medium text-sm text-green-600">
                    {status}
                </div>
            {/if}

            <form
                on:submit|preventDefault={onSubmit}
                class="flex flex-col gap-4"
            >
                <div class="w-full">
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
                    <div class="input">
                        <BreezeInput
                            bind:value={form.password}
                            required
                            type="password"
                            autocomplete="current-password"
                            placeholder="Entrez votre mot de passe..."
                            showIcon={false}
                            class="w-full"
                            on:input={(evt) => ($form.password = evt.detail)}
                        />
                    </div>
                </div>

                <div class="bottom-form">
                    <div>
                        <!-- svelte-ignore a11y-label-has-associated-control -->
                        <label
                            class="flex items-center justify-center"
                            style="width: 13.64rem;"
                        >
                            <BreezeCheckbox
                                name="remember"
                                bind:checked={form.remember}
                            />
                            <span class="remember">Se souvenir de moi</span>
                        </label>
                    </div>
                    <div class="spaceforget">
                        {#if canResetPassword}
                            <Link href="forgot-password">
                                Mot de passe oublié ?
                            </Link>
                        {/if}
                    </div>
                </div>
                <div class="submit">
                    <BreezeButton
                        sclass:opacity-25={form.processing}
                        disabled={form.processing}
                        style="width: 100%;"
                    >
                        Se connecter
                    </BreezeButton>
                </div>
                <div class="line">
                    <div>
                        <svg
                            width="211"
                            height="3"
                            viewBox="0 0 211 3"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M210.5 1.8125H0"
                                stroke="#B1B9B6"
                                stroke-opacity="0.5"
                                stroke-width="2"
                            />
                        </svg>
                    </div>
                    <div>
                        <p>Ou</p>
                    </div>
                    <div>
                        <svg
                            width="211"
                            height="3"
                            viewBox="0 0 211 3"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M210.5 1.8125H0"
                                stroke="#B1B9B6"
                                stroke-opacity="0.5"
                                stroke-width="2"
                            />
                        </svg>
                    </div>
                </div>
                <div class="bottom">
                    <div>
                        <h3>Toujours pas inscrit ?</h3>
                    </div>
                    <div class="space">
                        <Link href="register">Créer un compte</Link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<style>
    main {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(
            50deg,
            #f0e583 0%,
            #34ffad 98.31%,
            #cbef81 34.82%,
            #97f88f 67.07%
        );
    }

    .right {
        background-color: #fbfbfb;
        width: clamp(40rem, 35%, 50rem);
        height: 100%;
        min-height: inherit;
        margin-left: auto;
        padding: 4rem;
        min-width: 23rem;
        display: flex;
        align-items: center;
    }

    .right h1 {
        font-family: "Poppins";
        font-style: normal;
        font-weight: 600;
        font-size: 2rem;
        line-height: 3rem;
        color: #0d241b;
    }

    .right h2 {
        right: 100px;
        top: 275.69px;
        font-family: "Poppins";
        font-style: normal;
        font-weight: 400;
        font-size: 20px;
        line-height: 30px;
        color: #808a86;
        margin-right: 6.5rem;
    }

    form {
        margin-right: 100px;
        margin-top: 50px;
        width: 30.5rem;
    }

    label {
        font-family: "Poppins";
        font-style: normal;
        font-weight: 500;
        font-size: 1.3125rem;
        line-height: 2rem;
        color: #47524e;
    }

    .input {
        margin-top: 10px;
        margin-bottom: 30px;
    }

    .remember {
        font-family: "Poppins";
        font-style: normal;
        font-weight: 400;
        font-size: 1.125rem;
        margin-left: 1rem;
        color: #000000;
    }

    .bottom-form {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        margin-top: 30px;
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

    .right p {
        font-family: "Poppins";
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
        color: #808a86;
    }

    .space {
        margin-left: 0.71125rem;
    }

    /*Responsive at 40rem*/

    @media screen and (max-width: 40rem) {
        main {
            background: #fbfbfb;
            flex-direction: row;
            justify-content: center;
        }

        .right {
            width: 100%;
            margin-left: 11%;
            margin-right: 11%;
            min-width: 0;
            padding: 4rem 0;
            background-color: #fbfbfb;
            justify-content: center;
        }

        .right_content {
            height: 100%;
        }

        .right h1 {
            text-align: center;
        }

        .right h2 {
            margin-right: 0;
            text-align: center;
        }

        form {
            margin-right: 0;
            width: 100%;
        }

        .space {
            margin-left: 0.71125rem;
        }

        .bottom-form {
            flex-direction: column;
            align-items: flex-start;
            margin-top: 0;
        }

        .remember {
            margin-left: 0.71125rem;
        }

        .line {
            justify-content: space-around;
        }

        .spaceforget {
            margin-left: 0.24rem;
            margin-top: 1rem;
        }

        .space {
            margin-left: 0;
        }

        .bottom {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
    }

    @media screen and (max-height: 714px) {
        .right h1 {
            margin-top: 2rem;
        }

        .bottom-form {
            margin-top: 0;
        }

        @media screen and (max-height: 714px) and (max-width: 40rem) {
            .right h1 {
                margin-top: 1rem;
            }

            form {
                margin-top: 20px;
            }
        }
    }
</style>
