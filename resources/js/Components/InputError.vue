<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-red-600 mb-4">
            {{ message }}
        </p>
    </div>
</template>
