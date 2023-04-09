<script lang="ts" setup>
import { ArrowRightOnRectangleIcon, BellIcon } from '@heroicons/vue/20/solid';
import UserSVG from '../assets/user.svg'
import { ref } from 'vue'

const dropdownOpen = ref(false)
</script>

<template>
  <header class="flex items-center justify-end h-20 px-6 bg-white border-b">
    <div class="flex items-center">
      <div>
          <router-link to="/settings">
        <button
          class="transition-colors duration-300 rounded-lg sm:px-4 sm:py-2 focus:outline-none hover:bg-gray-100"
          @click="dropdownOpen = !dropdownOpen"
        >
          <div class="flex items-center md:-mx-2">
            <div
              class="hidden md:mx-2 md:flex md:flex-col md:items-end md:leading-tight"
            >
              <span class="font-semibold text-sm text-gray-800">Admin</span>
              <span class="text-sm text-gray-600">Administrator</span>
            </div>

            <img
              class="flex-shrink-0 w-10 h-10 overflow-hidden rounded-full md:mx-2"
              :src="UserSVG"
              alt="admin"
            />
          </div>
        </button>
        </router-link>
      </div>

      <div
        v-show="dropdownOpen"
        class="fixed inset-0 z-30"
        @click="dropdownOpen = false"
      ></div>

      <button
        class="relative p-2 mx-3 text-gray-400 transition-colors duration-300 rounded-full hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100"
      >
        <span class="sr-only">Notifications</span>
        <span
          class="absolute top-0 right-0 w-2 h-2 mt-1 mr-2 bg-blue-700 rounded-full"
        ></span>
        <span
          class="absolute top-0 right-0 w-2 h-2 mt-1 mr-2 bg-blue-700 rounded-full animate-ping"
        ></span>

        <BellIcon class="w-7 h-7 stroke-[1.8px] stroke-gray-400 fill-transparent" />
      </button>

      <button
        class="p-2 text-gray-400 transition-colors duration-300 rounded-full focus:outline-none hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100"
      >
        <span class="sr-only">Log out</span>
        <ArrowRightOnRectangleIcon class="w-7 h-7" />

      </button>
    </div>
  </header>
</template>
