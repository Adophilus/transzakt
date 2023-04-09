<script lang="ts" setup>
import { defineEmits, defineProps } from 'vue'
import { TrashIcon } from '@heroicons/vue/20/solid'
const emit = defineEmits(['cancel', 'accept'])
const props = defineProps(['isOpen'])
</script>

<template>
  <div
    class="z-10 h-screen w-screen bg-black bg-opacity-50 fixed top-0 left-0 flex justify-center items-center"
    style="margin-top: 0"
    v-show="props.isOpen"
  >
    <div
      x-transition:enter="transition duration-300 ease-out"
      x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
      x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
      x-transition:leave="transition duration-150 ease-in"
      x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
      x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
      class="fixed inset-0 z-10 overflow-y-auto"
      aria-labelledby="modal-title"
      role="dialog"
      aria-modal="true"
    >
      <div
        class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0"
      >
        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >

        <div
          class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl rtl:text-right dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6"
        >
          <div>
            <div class="flex items-center justify-center">
              <TrashIcon class="w-8 h-8 text-gray-700 dark:text-gray-300" />
            </div>

            <div class="mt-2 text-center">
              <h3
                class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white"
                id="modal-title"
              >
                Delete User
              </h3>
              <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                Are you sure you want to delete this user?
              </p>
            </div>
          </div>

          <div class="mt-5 sm:flex sm:items-center sm:justify-end">
            <div class="sm:flex sm:items-center">
              <button
                @click="emit('cancel')"
                class="w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:mt-0 sm:w-auto sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40"
              >
                Cancel
              </button>

              <button
                @click="emit('accept')"
                class="w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:w-auto sm:mt-0 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
