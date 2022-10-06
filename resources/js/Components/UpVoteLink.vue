<template>
    <Link :href="route('posts.upVote', slug)" preserve-scroll class="text-gray-600 hover:text-red-500 flex my-2 justify-center" method="post" as="button" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
        </svg>
    </Link>
</template>
<script setup>
    import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    slug: String,
});
</script>
