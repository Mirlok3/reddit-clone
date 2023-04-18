<template>
    <img :src="post.post_file"
         v-if="
            post.file_ext === 'jpg' ||
            post.file_ext === 'png' ||
            post.file_ext === 'webp' ||
            post.file_ext === 'gif' ||
            post.file_ext === 'jpeg'
        "
    />
    <video controls muted
        v-if="
            post.file_ext === 'mp4' ||
            post.file_ext === 'webm' ||
            post.file_ext === 'ogg'
        "
    >

        <source :src="post.post_file" :type="'video/'+post.file_ext"/>
        Your browser does not support the video tag {{ post.file_ext }}.
    </video>
</template>

<script setup>
    defineProps({
        post: Object,
    })
</script>
