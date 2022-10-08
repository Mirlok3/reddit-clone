<template>
    <Head title="Create a Subreddit"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a Subreddit.
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-md mx-auto bg-white m-2 p-6">
                    <form @submit.prevent="submit">
                        <div class="mt-4">
                            <BreezeLabel for="name" value="Name" />
                            <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                                autocomplete="name" />
                            <BreezeInputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="subreddit_image" value="Subreddit Logo" />
                            <BreezeInput id="subreddit_image" type="file" class="mt-1 block w-full"
                                @input="form.subreddit_image = $event.target.files[0]"/>
                            <BreezeInputError class="mt-2" :message="form.errors.subreddit_image" />
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="description" value="Description" />
                            <BreezeInput id="description" type="text" class="mt-1 block w-full" v-model="form.description"
                                autofocus autocomplete="description" />
                            <BreezeInputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Store
                            </BreezeButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>


</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    errors:Object,
});

const form = useForm({
    name: '',
    description: '',
    slug: '',
    subreddit_image: null,
});

const submit = () => {
    form.post(route('subreddits.store'));
};
</script>
