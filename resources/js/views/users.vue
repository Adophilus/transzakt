<script setup>
import PlusIcon from '../components/icons/plus.vue'
</script>

<template>
<section class="flex flex-col w-full px-6 md:justify-between md:items-center md:flex-row">
                <div>
                    <h2 class="text-3xl font-medium text-gray-800">Users</h2>
                    <p class="mt-2 text-sm text-gray-500">Registered clients</p>
                </div>

                <div class="flex flex-col mt-6 md:flex-row md:-mx-1 md:mt-0">
                    <button class="px-6 py-3 focus:outline-none mt-4 text-white bg-blue-600 rounded-lg md:mt-0 md:mx-1 hover:bg-blue-500">
                        <div class="flex items-center justify-center -mx-1">
                          <PlusIcon class="w-6 h-6"/>
    
                            <span class="mx-1 text-sm capitalize">Add new user</span>
                        </div>
                    </button>
                </div>
            </section>
</template>
