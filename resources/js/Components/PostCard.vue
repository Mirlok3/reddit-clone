<template>
    <div class="p-6 max-w-4xl flex bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="mr-3">Upvote</div>
        <div>
            <div class="flex m-2 p-2">
                <span class="font-semibold mr-3">r/{{ subreddit }}</span>
                <div class="flex">Posted by
                    <span class="font-semibold ml-1">{{ post.username }}</span>
                </div>
            </div>

            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ post.title }}</h5>
            </a>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ post.description }}</p>

            <div class="flex m-2 p-2">Comments</div>

            <a href="#" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white">Read More</a>
            <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"/>
        </div>
    </div>
</template>

<script setup>
    defineProps({
        post: Object,
        subreddit: String,
    });
</script>
