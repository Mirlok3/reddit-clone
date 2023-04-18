<template>
    <Head title="Edit your Subreddit"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Edit r/{{ props.subreddit.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="shadow-md dark:border dark:border-neutral-500 max-w-md mx-auto bg-white m-2 p-6 dark:bg-neutral-600 rounded-lg dark:text-white">
                    <form @submit.prevent="submit" method="post" enctype="multipart/form-data">
                        <div class="mt-4">
                            <BreezeLabel for="subreddit_image"
                                         class="flex flex-col justify-center items-centerh-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer hover:border-indigo-300
                                  dark:text-white dark:bg-neutral-800 ">
                                <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mb-3 w-10 h-10 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="mb-2 text-xs text-gray-500 font-semibold">Click to upload your subreddit's icon</p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG</p>
                                </div>
                                <BreezeInput id="subreddit_image" type="file" class="mt-1 block w-full file:hidden pl-4 pb-1"
                                             @input="form.subreddit_image = $event.target.files[0]" accept="image/*"/>
                            </BreezeLabel>
                        </div>
                        <BreezeInputError class="mt-2" :message="form.errors.subreddit_image" />
                        <div class="mt-4">
                            <BreezeLabel for="name" value="Name" class="dark:text-white"/>
                            <BreezeInput id="name" type="text" class="mt-1 block w-full dark:bg-neutral-800" v-model="form.name" autofocus
                                autocomplete="name" />
                            <BreezeInputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="description" value="Description" class="dark:text-white"/>
                            <textarea id="description" type="text" v-model="form.description"
                                      class="border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full dark:bg-neutral-800"
                                      autofocus autocomplete="description" rows="4"/>
                            <BreezeInputError class="mt-2" :message="form.errors.description"/>
                        </div>

                        <div class="mt-4 flex">
                            <BreezeLabel for="color" value="Subreddit Color:" class="dark:text-white my-auto p-2.5" />
                            <BreezeInput id="color" type="color" class="mt-1 block w-full dark:bg-neutral-800 border-gray-400 w-4/12 h-8 p-0.5" v-model="form.color"
                                         autocomplete="color" /> <!--TODO: value="" doesnt work properly. When selecting different color it doesnt change from the value -->
                            <BreezeInputError class="mt-2" :message="form.errors.color" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Edit Subreddit
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

const props = defineProps({
    subreddit: Object,
    errors: Object,
});

const form = useForm({
    name: props.subreddit.name,
    description: props.subreddit.description,
    color: props.subreddit.color,
    _method: 'put',
    subreddit_image: props.subreddit.subreddit_image,
});

const submit = () => {
    form.post(route("subreddits.update", props.subreddit.slug));
};
</script>
