<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page=usePage()
const clientes=ref(page.props.clientes);
const onDeleteSuccess=(e)=>{
    clientes.value=e.props.clientes;

}
</script>

<template>
    <Head title="Cliente" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cliente</h2>
            <Link :href="route('cliente.create')">
                Criar cliente
            </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                     <div className="relative overflow-x-auto">

                        <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" className="px-6 py-3">
                                        Nome
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Telefone
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        CV
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cliente in clientes" className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ cliente.name }}
                                    </th>
                                    <td className="px-6 py-4">
                                        {{ cliente.phone }}
                                    </td>
                                    <td className="px-6 py-4">
                                        {{ cliente.email }}
                                    </td>
                                    <td className="px-6 py-4">
                                       <a :href="'/storage/'+ cliente.cv">Curriculum</a>
                                    </td>
                                    <td className="px-6 py-4">
                                        <div class="space-x-4">
                                            <Link  :href="route('cliente.edit', cliente)">
                                                Editar
                                            </Link>
                                            <Link @success="onDeleteSuccess" :href="route('cliente.destroy', cliente)" method="delete" as="button">
                                                Eliminar
                                            </Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                     </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
