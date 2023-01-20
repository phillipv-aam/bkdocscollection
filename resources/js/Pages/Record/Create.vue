<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
  first_name: null,
  last_name: null,
  email: null,
})

function submit() {
  router.post('/record', form)
}
</script>

<template>
    <Head title="Create Record" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Record</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="submit">
                    <label for="first_name">First name:</label>
                    <input id="first_name" v-model="form.first_name" />
                    <label for="last_name">Last name:</label>
                    <input id="last_name" v-model="form.last_name" />
                    <label for="email">Email:</label>
                    <input id="email" v-model="form.email" />
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>