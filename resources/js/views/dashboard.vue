<script setup>
import { ref } from 'vue'
import Navbar from '../components/navbar.vue'
import Sidebar from '../components/sidebar.vue'

const showSidebar = ref(false)
</script>

<template>
  <div class="relative min-h-screen lg:flex">
    <header class="text-gray-100 bg-gray-800 lg:hidden">
      <div class="container flex items-center justify-between p-4 mx-auto">
        <router-link to="/dashboard" class="text-white">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-8 h-8"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
            />
          </svg>
        </router-link>

        <button
          @click="showSidebar = !showSidebar"
          class="p-2 text-white rounded-lg focus:outline-none hover:bg-gray-700"
        >
          <svg
            v-show="!showSidebar"
            xmlns="http://www.w3.org/2000/svg"
            class="w-6 h-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M4 6h16M4 12h16m-7 6h7"
            />
          </svg>

          <svg
            v-show="showSidebar"
            class="w-6 h-6 transition duration-200 ease-in-out"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>
    </header>

    <div
      v-cloak
      :class="showSidebar ? 'block' : 'hidden'"
      @click="showSidebar = false"
      class="fixed inset-0 z-20 transition-opacity bg-black opacity-30 lg:hidden"
    ></div>

    <Sidebar :isOpen="showSidebar" />
    <main
      id="content"
      class="flex-1 pb-12 space-y-6 overflow-y-auto bg-gray-100 lg:h-screen md:space-y-8"
    >
      <Navbar />
      <router-view></router-view>
    </main>
  </div>
</template>
