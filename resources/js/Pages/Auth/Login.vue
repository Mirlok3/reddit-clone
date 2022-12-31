<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <div v-if="$page.props.flash.message" class="bg-green-400">
            <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                        <p class="ml-3 font-medium text-white truncate">
                            <span class="md:hidden">{{ $page.props.flash.message }}</span>
                            <span class="hidden md:inline">{{ $page.props.flash.message }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="max-w-md mx-auto bg-white shadow rounded-md p-6 dark:bg-neutral-700 dark:text-white">
            <div>
                <BreezeLabel for="email" value="Email" class="dark:text-white"/>
                <BreezeInput id="email" type="email" class="mt-1 block w-full border-gray-400 dark:bg-neutral-800" v-model="form.email" autofocus autocomplete="username" />
                <BreezeInputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" class="dark:text-white"/>
                <BreezeInput id="password" type="password" class="mt-1 block w-full border-gray-400 dark:bg-neutral-800" v-model="form.password" autocomplete="current-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600 dark:text-white">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')"
                      class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-white dark:hover:text-gray-300">
                    Forgot your password?
                </Link>

                <BreezeButton :class="{ 'opacity-75': form.processing }" :disabled="form.processing">
                    Log in
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
