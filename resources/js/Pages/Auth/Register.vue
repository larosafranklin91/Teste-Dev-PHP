<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Checkbox from '@/Components/Checkbox.vue';

const form = useForm({
    name: '',
    cpf: '',
    cep: '',
    rua: '',
    bairro: '',
    cidade: '',
    uf: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});
const formStep = ref(1);

const submit = () => {
    form.post(route('register'), {
        onSuccess: () => { form.reset(), (formStep.value = 1); },
    });
};
function nextStep() {

    if (formStep.value == 1) {
        form.post(route('store-first'), {
            onSuccess: () => {
                formStep.value++;
            },

        });
    }
    else if ((formStep.value == 2)) {
        form.post(route('store-second'), {
            onSuccess: () => {
                formStep.value++;
            },

        });
    }
}
function prevStep() {
    formStep.value--;
}


</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form method="get" action=".">
            <!--STEP 1 -->
            <div v-if="formStep == 1">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel for="cpf" value="CPF" />

                    <TextInput id="cpf" type="text" class="mt-1 block w-full" v-model="form.cpf" required autofocus
                        autocomplete="cpf" />

                    <InputError class="mt-2" :message="form.errors.cpf" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>


            </div>
            <!--STEP 2 -->
            <div v-if="formStep == 2">

                <div>
                    <InputLabel for="cep" value="CEP" />

                    <TextInput id="cep" type="text" class="mt-1 block w-full" v-model="form.cep" required autofocus
                        autocomplete="cep" />

                    <InputError class="mt-2" :message="form.errors.cep" />
                </div>
                <div class="mt-4">
                    <InputLabel for="rua" value="Rua" />

                    <TextInput id="rua" type="text" class="mt-1 block w-full" v-model="form.rua"/>

                    <InputError class="mt-2" :message="form.errors.rua" />
                </div>
                <div class="mt-4">
                    <InputLabel for="bairro" value="Bairro" />

                    <TextInput id="bairro" type="text" class="mt-1 block w-full" v-model="form.bairro" />

                    <InputError class="mt-2" :message="form.errors.bairro" />
                </div>
                <div class="mt-4">
                    <InputLabel for="cidade" value="Cidade" />

                    <TextInput id="cidade" type="text" class="mt-1 block w-full" v-model="form.cidade" />
                    <InputError class="mt-2" :message="form.errors.cidade" />
                </div>
                <div class="mt-4">
                    <InputLabel for="uf" value="Estado" />

                    <TextInput id="uf" type="text" class="mt-1 block w-full" v-model="form.uf" />

                    <InputError class="mt-2" :message="form.errors.uf" />
                </div>

            </div>
            <!--STEP 3 -->
            <div v-if="formStep == 3">

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                        v-model="form.password_confirmation" required autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>
                <div class="mt-4">
                    <InputLabel for="terms" value="Você deve concordar com nosso" />

                    <Checkbox type="checkbox" id="terms" v-model="form.terms"></Checkbox>

                    <InputError class="mt-2" :message="form.errors.terms" />
                </div>

            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Você já está cadastrado??
                </Link>

                <PrimaryButton class="ml-4" v-if="((formStep == 2) || (formStep == 3))" type="button" @click="prevStep">
                    Voltar
                </PrimaryButton>
                <PrimaryButton class="ml-4" v-if="((formStep == 1) || (formStep == 2))" type="button" @click="nextStep">
                    Avançar
                </PrimaryButton>
                <PrimaryButton class="ml-4" v-if="formStep == 3" type="button" @click="submit">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
