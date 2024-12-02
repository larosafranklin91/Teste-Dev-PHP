<script setup>
import FileInput from '@/Components/FileInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page=usePage()

const cliente=ref(page.props.cliente);

const initialValues={
    name:cliente.value.name,
    email:cliente.value.email,
    phone:cliente.value.phone,
    cv:null
}

const form=useForm(initialValues)

const onSelectCv =(e) => {
console.log(e.target.files)
const files=e.target.files;
if(files.length){
    form.cv=files[0]
}
}
const submit=() => {
    form.post(route('cliente.update', cliente.value),{
        onSuccess:(e)=>{
            cliente.value=e.props.cliente;
        }

    })
}

</script>

<template>
    <Head title=" Editar Cliente" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Cliente</h2>
            <Link :href="route('cliente.index')">
                Listagem de Cliente
            </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center bg-white overflow-hidden shadow-sm sm:rounded-lg">
                   <form class="w-1/3 py-5 space-y-4" @submit.prevent="submit" >
                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-green-600 text-center">Cliente editado</p>
                </Transition>
            <div>
                <InputLabel for="name" value="Nome" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                    placeholder="Digite seu nome"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div>
                <InputLabel for="phone" value="Telefone" />

                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    placeholder="(41)0000-0000"
                />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    autofocus
                    autocomplete="name"
                    placeholder="user@laravel.pr"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div>
                <a :href="'/storage/'+ cliente.cv">Curriculum</a>
            </div>
            <div>
                <InputLabel for="cv" value="CV" />
                <FileInput name="CV" @change="onSelectCv"/>
                <InputError class="mt-2" :message="form.errors.cv" />
            </div>
            <div class="flex ml-60">
                <PrimaryButton>
                Editar Cliente
            </PrimaryButton>

            </div>
                   </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
