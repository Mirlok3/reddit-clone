<template>
    <div class="flex justify-center">
        <template v-for="(link, key) in links" :key="key">
            <div v-if="link.url === null" v-html="link.label"
            class="mb-1 mr-1 px-4 py-3 bg-gray-300 text-gray-700 text-md leading-4 rounded-full dark:bg-neutral-800 dark:text-white"
            ></div>

            <Link v-else :href="link.url" v-html="link.label"
            class="mb-1 mr-1 px-4 py-3 text-md font-semibold leading-4 rounded-full hover:bg-indigo-800 dark:hover:bg-indigo-500 bg-indigo-600 text-white"
            :class="{'bg-indigo-900' :link.active}"></Link>
        </template>
    </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'

defineProps({
    links: []
})

</script>
