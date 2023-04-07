<script setup>
import ChartBarIcon from './icons/chart-bar.vue'
import CogIcon from './icons/cog.vue'
import CreditCartIcon from './icons/credit-card.vue'
import UserIcon from './icons/user.vue'
</script>

<template>
        <aside id="sidebar" :class="isOpen ? 'translate-x-0 ease-in' : '-translate-x-full ease-out'" class="fixed inset-y-0 left-0 z-30 flex flex-col w-[4.5rem] min-h-screen space-y-6 overflow-y-auto text-gray-100 transition duration-200 transform bg-gray-800 lg:translate-x-0 lg:relative lg:inset-0">
            <div class="flex flex-col items-center flex-1 space-y-6">
                <a href="#" class="flex items-center justify-center w-full p-5 lg:p-0 lg:h-20 font-bold text-white truncate bg-blue-600 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </a>

                <nav class="flex flex-col items-center space-y-6">
                    <a href="#" class="p-2 transition-colors duration-300 rounded-lg group hover:bg-white">
                      <ChartBarIcon class="w-6 h-6 group-hover:stroke-blue-700"/>
                    </a>

                    <a href="#" class="p-2 transition-colors duration-300 rounded-lg group hover:bg-white">
                      <UserIcon class="w-6 h-6 group-hover:stroke-blue-700"/>
                    </a>

                    <a href="#" class="p-3 transition-colors duration-300 bg-white rounded-lg">
                      <CreditCartIcon class="w-6 h-6 group-hover:stroke-blue-700"/>
                    </a>
                </nav>
            </div>

            <div class="flex justify-center py-5 border-t border-gray-600">
                <a href="#" class="p-2 transition-colors duration-300 rounded-lg group hover:bg-white">
                      <CogIcon class="w-6 h-6 group-hover:stroke-blue-700"/>
                </a>
            </div>
        </aside>
        </template>
