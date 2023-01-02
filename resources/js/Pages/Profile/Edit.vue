<template>
    <BreezeGuestLayout>
        <Head title="Edit"/>

        <form @submit.prevent="submit" class="max-w-lg mx-auto bg-white shadow rounded-md p-6 dark:bg-neutral-700 dark:text-white">
            <div class="flex justify-center">
                <div class="pr-6">
                    <BreezeLabel for="user_image"
                           class="flex flex-col justify-center items-centerh-64 bg-gray-50 rounded-lg border-2 border-gray-400 border-dashed cursor-pointer hover:border-indigo-300
                                  dark:text-white dark:bg-neutral-800 ">
                        <div class="flex flex-col justify-center items-center pt-5 pb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mb-3 w-10 h-10 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="mb-2 text-xs text-gray-500 font-semibold">Click to upload your profile picture</p>
                            <p class="text-xs text-gray-500">SVG, PNG, JPG</p>
                        </div>
                        <BreezeInput id="user_image" type="file" class="mt-1 block w-full file:hidden pl-4 pb-1"
                                     @input="form.user_image = $event.target.files[0]" accept="image/*"/>
                        <BreezeInputError class="mt-2" :message="form.errors.user_image" />
                    </BreezeLabel>
                </div>

                <div>
                    <div>
                        <div>
                            <BreezeLabel for="name" value="Name" class="dark:text-white" />
                            <BreezeInput id="name" type="text" class="mt-1 block w-full dark:bg-neutral-800 border-gray-400" v-model="form.name" autofocus
                                         autocomplete="name"/>
                            <BreezeInputError class="mt-2" :message="form.errors.name"/>
                        </div>
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="username" value="Username" class="dark:text-white"/>
                        <BreezeInput id="username" type="text" class="mt-1 block w-full dark:bg-neutral-800 border-gray-400" v-model="form.username"
                                     autofocus
                                     autocomplete="username"/>
                        <BreezeInputError class="mt-2" :message="form.errors.username"/>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Email" class="dark:text-white"/>
                <BreezeInput id="email" type="email" class="mt-1 block w-full dark:bg-neutral-800 border-gray-400" v-model="form.email"
                             autocomplete="username"/>
                <BreezeInputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div class="mt-4">
                <BreezeLabel for="description" value="Description" class="dark:text-white"/>
                <textarea id="description" type="text" v-model="form.description"
                          class="border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full dark:bg-neutral-800"
                          autofocus autocomplete="description"/>
                <BreezeInputError class="mt-2" :message="form.errors.description"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <BreezeButton :class="{ 'opacity-75': form.processing }" :disabled="form.processing">
                    Log in
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>

<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';

const props = defineProps({
    user: Object,
    errors: Object,
});

const form = useForm({
    user_image: props.user?.user_image,
    name: props.user?.name,
    username: props.user?.username,
    description: props.user?.description,
    email: props.user?.email,
    _method: 'put',
});


const submit = () => {
    form.post(route("profile.update", props.user.id));
};
</script>
