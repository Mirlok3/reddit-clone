<script setup>
import { computed } from 'vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Email Verification" />
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-gray-600 dark:text-white ">
                <div class="max-w-md mx-auto bg-white m-2 p-6 dark:bg-neutral-600 rounded-lg text-center">
                    <div class="mb-6 text-sm">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </div>

                    <div class="mb-4 font-medium text-sm text-green-500 font-bold" v-if="verificationLinkSent" >
                        A new verification link has been sent to the email address you provided during registration.
                    </div>

                    <form @submit.prevent="submit">
                        <div class="mt-4 flex items-center justify-between">
                            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Resend Verification Email
                            </BreezeButton>

                            <Link :href="route('logout')" method="post" as="button"
                                  class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100">
                                Log Out
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
