<template>
    <div v-if="$page.props.auth.auth_check" class="md:text-md text-sm">
        <BreezeDropdown align="right" width="12">
            <template #trigger>
                <span class="inline-flex rounded-md">
                    <button type="button"
                            class="bg-neutral-100 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150
                                   dark:bg-neutral-900 dark:text-white dark:hover:text-neutral-200">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </span>
            </template>

            <template #content>
                <div>
                    <BreezeDropdownLink :href="editHref"
                          v-if="$page.props.auth.user.id === id"
                    >

                        Edit
                    </BreezeDropdownLink>

                    <BreezeDropdownLink :href="deleteHref"
                          method="delete" as="button" type="button" v-if="$page.props.auth.user.id === id || $page.props.auth.user.is_admin || can_delete"
                    >

                        Delete
                    </BreezeDropdownLink>

                </div>
            </template>
        </BreezeDropdown>
    </div>
</template>

<script setup>
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';

defineProps({
    editHref: String,
    deleteHref: String,
    id: Number,
    can_delete: Boolean,
})
</script>
