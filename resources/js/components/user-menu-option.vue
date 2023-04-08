<script setup>
import { defineEmits, defineProps } from 'vue'
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import {
  ChevronDownIcon,
  CheckCircleIcon,
  NoSymbolIcon,
  TrashIcon,
  CreditCardIcon,
  PencilSquareIcon
} from '@heroicons/vue/20/solid'

const emit = defineEmits(['block', 'unblock', 'transact', 'delete'])
const props = defineProps(['user'])
</script>

<template>
  <div>
    <Menu as="div" class="relative inline-block">
      <div>
        <MenuButton>
          <slot></slot>
        </MenuButton>
      </div>

      <transition
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0"
      >
        <MenuItems
          class="absolute right-0 z-10 -mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        >
          <div class="px-1 py-1">
            <MenuItem v-slot="{ active }">
              <button
                @click="emit('edit')"
                :class="[
                  active ? 'bg-blue-600 text-white' : 'text-gray-900',
                  'group flex w-full items-center rounded-md px-2 py-2 text-sm'
                ]"
              >
                <PencilSquareIcon
                  :active="active"
                  class="mr-2 h-5 w-5 text-blue-600 group-hover:text-white"
                  aria-hidden="true"
                />
                Edit
              </button>
            </MenuItem>
            <MenuItem v-slot="{ active }">
              <button
                @click="props.user.blocked ? emit('unblock') : emit('block')"
                :class="[
                  active ? 'bg-blue-600 text-white' : 'text-gray-900',
                  'group flex w-full items-center rounded-md px-2 py-2 text-sm'
                ]"
              >
                <NoSymbolIcon
                  v-show="!props.user.blocked"
                  :active="active"
                  class="mr-2 h-5 w-5 text-blue-600 group-hover:text-white"
                  aria-hidden="true"
                />
                <CheckCircleIcon
                  v-show="props.user.blocked"
                  :active="active"
                  class="mr-2 h-5 w-5 text-blue-600 group-hover:text-white"
                  aria-hidden="true"
                />

                {{ props.user.blocked ? 'Unblock' : 'Block' }}
              </button>
            </MenuItem>
            <MenuItem v-slot="{ active }">
              <button
                @click="emit('transact')"
                :class="[
                  active ? 'bg-blue-600 text-white' : 'text-gray-900',
                  'group flex w-full items-center rounded-md px-2 py-2 text-sm'
                ]"
              >
                <CreditCardIcon
                  :active="active"
                  class="mr-2 h-5 w-5 text-blue-600 group-hover:text-white"
                  aria-hidden="true"
                />
                Transact
              </button>
            </MenuItem>
            <MenuItem v-slot="{ active }">
              <button
                @click="emit('delete')"
                :class="[
                  active ? 'bg-blue-600 text-white' : 'text-gray-900',
                  'group flex w-full items-center rounded-md px-2 py-2 text-sm'
                ]"
              >
                <TrashIcon
                  :active="active"
                  class="mr-2 h-5 w-5 text-blue-600 group-hover:text-white"
                  aria-hidden="true"
                />
                Delete
              </button>
            </MenuItem>
          </div>
        </MenuItems>
      </transition>
    </Menu>
  </div>
</template>
