<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Records" />

    <AuthenticatedLayout>
        <template #header>
            <Link :href="route('record.create')">
                <button type="button" class="px-6 py-2 text-sm rounded shadow bg-blue-100 hover:bg-blue-200 text-cyan"><font-awesome-icon icon="fa-solid fa-plus"></font-awesome-icon> Add Record</button>
            </Link>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
