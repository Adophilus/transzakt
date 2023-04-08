<script setup>
import { defineProps } from 'vue'
const props = defineProps(['user'])
</script>

<template>
  <div class="relative inline-block group">
    <slot></slot>

    <div
      class="absolute hidden group-hover:flex items-center w-48 p-3 text-gray-600 -translate-x-1/2 bg-white rounded-lg drop-shadow-lg -top-16 left-1/2 dark:shadow-none shadow-gray-200 dark:bg-gray-800 dark:text-white"
    >
      <div class="truncate">
        <p class="flex justify-between space-x-4 truncate">
          <span>Full name:</span>
          <span class="truncate"
            >{{ props.user?.first_name }} {{ props.user?.last_name }}</span
          >
        </p>
        <p class="flex justify-between space-x-4 truncate">
          <span>AC No.:</span>
          <span class="truncate">{{ props.user?.account_number }}</span>
        </p>
        <p class="flex justify-between space-x-4 truncate">
          <span>Email:</span>
          <span class="truncate">{{ props.user?.email }}</span>
        </p>
        <p class="flex justify-between space-x-4 truncate">
          <span>Balance:</span>
          <span class="truncate">${{ props.user?.balance }}</span>
        </p>
      </div>
    </div>
  </div>
</template>
