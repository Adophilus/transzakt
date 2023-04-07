
<script setup>
import UserSVG from '../assets/user.svg'
</script>

        <template>
        
            <header class="flex items-center justify-end h-20 px-6 bg-white border-b">

                <div class="flex items-center">
                    <div class="relative">
                        <button class="transition-colors duration-300 rounded-lg sm:px-4 sm:py-2 focus:outline-none hover:bg-gray-100" @click="dropdownOpen = !dropdownOpen">
                            <span class="sr-only">User Menu</span>
                            <div class="flex items-center md:-mx-2 ">
                                <div class="hidden md:mx-2 md:flex md:flex-col md:items-end md:leading-tight">
                                    <span class="font-semibold text-sm text-gray-800">Admin</span>
                                    <span class="text-sm text-gray-600">Administrator</span>
                                </div>
        
                                <img class="flex-shrink-0 w-10 h-10 overflow-hidden rounded-full md:mx-2" :src="UserSVG" alt="admin" >
                            </div>
                        </button>
                        
                        <transition
                            enter-active-class="transition duration-200 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0"
                        >
                            <div class="absolute right-0 z-50 w-56 p-2 bg-white border rounded-lg top-16 lg:top-20" v-show="dropdownOpen">
                                <div class="px-4 py-2 text-gray-800 transition-colors duration-300 rounded-lg cursor-pointer hover:bg-gray-100">Profile</div>
                                <div class="px-4 py-2 text-gray-800 transition-colors duration-300 rounded-lg cursor-pointer hover:bg-gray-100">Messages</div>
                                <div class="px-4 py-2 text-gray-800 transition-colors duration-300 rounded-lg cursor-pointer hover:bg-gray-100">To-Do's</div>
                            </div>
                        </transition>
                    </div>

                    <div v-show="dropdownOpen" class="fixed inset-0 z-30" @click="dropdownOpen = false"></div>

                    <button class="relative p-2 mx-3 text-gray-400 transition-colors duration-300 rounded-full hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100">
                        <span class="sr-only">Notifications</span>
                        <span class="absolute top-0 right-0 w-2 h-2 mt-1 mr-2 bg-blue-700 rounded-full"></span>
                        <span class="absolute top-0 right-0 w-2 h-2 mt-1 mr-2 bg-blue-700 rounded-full animate-ping"></span>
                        
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <button class="p-2 text-gray-400 transition-colors duration-300 rounded-full focus:outline-none hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100">
                        <span class="sr-only">Log out</span>
                        
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </header>

        </template>
