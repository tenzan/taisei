<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';

defineProps(['locations']);

const form = useForm({
    name: '',
});
</script>

<template>
    <Head title="Locations" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('locations.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.name"
                    placeholder="Enter Location name"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.name" class="mt-2" />
                <PrimaryButton class="mt-4">Add Location</PrimaryButton>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Location
                    v-for="location in locations"
                    :key="location.id"
                    :location="location"
                />
            </div>

        </div>
    </AuthenticatedLayout>


</template>
