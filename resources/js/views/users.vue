<script setup>
import { ref, computed, watch } from 'vue'
import { useRoute } from 'vue-router'
import useSWRV from 'swrv'

import ArrowLongLeft from '../components/icons/arrow-long-left.vue'
import ArrowLongRight from '../components/icons/arrow-long-right.vue'
import ArrowLongUp from '../components/icons/arrow-long-up.vue'
import ArrowLongDown from '../components/icons/arrow-long-down.vue'
import ElipsisVertical from '../components/icons/elipsis-vertical.vue'
import PlusIcon from '../components/icons/plus.vue'
import SearchIcon from '../components/icons/search.vue'

import UserMenuOption from '../components/user-menu-option.vue'
import UserRegistrationModal from '../components/user-registration-modal.vue'
import UserTransactionModal from '../components/user-transaction-modal.vue'
import DeleteUserModalVue from '../components/delete-user-modal.vue'

const route = useRoute()

const currentTransactingUser = ref()
const currentEditingUser = ref()
const currentDeletingUser = ref()
const usersApiUrl = ref('/api/users')

watch(
  () => route.query.cursor,
  () => {
    const url = new URL(usersApiUrl.value, window.location.origin)
    if (route.query.cursor) {
      url.searchParams.set('cursor', route.query.cursor)
    }
    usersApiUrl.value = url.toString()
  }
)

const { data, mutate, isValidating, error } = useSWRV(() => usersApiUrl.value)

const users = computed(() => data.value?.data)
const showUserRegistrationModal = ref(false)
const showUserTransactionModal = ref(false)
const showUserDeletingModal = ref(false)

const onUserRegistrationFormSubmitted = () => {
  mutate()
  showUserRegistrationModal.value = false
}

const onUserTransactionFormSubmitted = async (event) => {
  const user = currentTransactingUser.value
  try {
    await fetch(`/api/users/${user.id}/transactions`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        amount: event.amount,
        type: event.type,
        status: event.status
      })
    })
    mutate()
    showUserTransactionModal.value = false
  } catch (error) {
    console.warn(error)
  }
}

const block = async (user) => {
  try {
    await fetch(`/api/users/${user.id}/block`, {
      method: 'POST'
    })
    mutate()
  } catch (error) {
    console.warn(error)
  }
}

const unblock = async (user) => {
  try {
    await fetch(`/api/users/${user.id}/unblock`, {
      method: 'POST'
    })
    mutate()
  } catch (error) {
    console.warn(error)
  }
}

const edit = (user) => {
  currentEditingUser.value = user
  showUserRegistrationModal.value = true
}

const initiateTranaction = (user) => {
  showUserTransactionModal.value = true
}

const deleteUser = async (user) => {
  try {
    await fetch(`/api/users/${user.id}`, {
      method: 'DELETE'
    })
    mutate()
    showUserDeletingModal.value = false
  } catch (error) {
    console.warn(error)
  }
}

const onDeleteUser = (user) => {
  currentDeletingUser.value = user
  showUserDeletingModal.value = true
}
</script>

<template>
  <DeleteUserModalVue
    :isOpen="showUserDeletingModal"
    @accept="deleteUser(currentDeletingUser)"
    @cancel="showUserDeletingModal = false"
  />
  <section
    class="flex flex-col w-full px-6 md:justify-between md:items-center md:flex-row"
  >
    <div>
      <h2 class="text-3xl font-medium text-gray-800">Users</h2>
      <p class="mt-2 text-sm text-gray-500">Registered clients</p>
    </div>

    <div class="flex flex-col mt-6 md:flex-row md:-mx-1 md:mt-0">
      <button
        class="px-6 py-3 focus:outline-none mt-4 text-white bg-blue-600 rounded-lg md:mt-0 md:mx-1 hover:bg-blue-500"
        @click="showUserRegistrationModal = true"
      >
        <div class="flex items-center justify-center -mx-1">
          <PlusIcon class="w-6 h-6" />

          <span class="mx-1 text-sm capitalize">Add new user</span>
        </div>
      </button>
    </div>
  </section>
  <section class="container px-4 mx-auto">
    <div class="mt-6 md:flex md:items-center md:justify-end">
      <div class="relative flex items-center mt-4 md:mt-0">
        <span class="absolute">
          <SearchIcon class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600" />
        </span>

        <input
          type="text"
          placeholder="Search"
          class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
        />
      </div>
    </div>

    <div class="flex flex-col mt-6">
      <div class="mb-6">
        <UserTransactionModal
          @submit="onUserTransactionFormSubmitted($event)"
          @cancel="showUserTransactionModal = false"
          v-show="showUserTransactionModal"
        />
      </div>
      <div class="mb-6">
        <UserRegistrationModal
          @submit="onUserRegistrationFormSubmitted()"
          @cancel="showUserRegistrationModal = false"
          :current-user="currentEditingUser"
          v-show="showUserRegistrationModal"
        />
      </div>
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div
            class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg"
          >
            <table
              class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
            >
              <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                  <th
                    scope="col"
                    class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                  >
                    <button
                      class="flex items-center gap-x-3 focus:outline-none"
                    >
                      <span>Full name</span>

                      <a href="#" class="flex">
                        <ArrowLongUp
                          class="w-4 h-4 -mr-1 text-gray-400 dark:text-gray-600"
                        />
                        <ArrowLongDown
                          class="w-4 h-4 -ml-1 text-gray-400 dark:text-gray-600"
                        />
                      </a>
                    </button>
                  </th>

                  <th
                    scope="col"
                    class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                  >
                    Email
                  </th>

                  <th
                    scope="col"
                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                  >
                    Account Number
                  </th>

                  <th
                    scope="col"
                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                  >
                    Status
                  </th>

                  <th
                    scope="col"
                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                  >
                    Balance
                  </th>

                  <th scope="col" class="relative py-3.5 px-4">
                    <span class="sr-only">Actions</span>
                  </th>
                </tr>
              </thead>
              <tbody
                class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900"
              >
                <tr v-if="!!isValidating && !users">
                  <td colspan="6" class="px-4 py-4 text-sm whitespace-nowrap">
                    <div>
                      <h4 class="text-center text-gray-700 dark:text-gray-200">
                        Loading...
                      </h4>
                    </div>
                  </td>
                </tr>
                <tr v-else-if="!!error">
                  <td colspan="6" class="px-4 py-4 text-sm whitespace-nowrap">
                    <div>
                      <h4 class="text-center text-gray-700 dark:text-gray-200">
                        Sorry, an error occurred while trying to load users 🙁
                      </h4>
                    </div>
                  </td>
                </tr>
                <template v-else>
                  <template v-if="Array.isArray(users) && users.length > 0">
                    <tr v-for="user in users" :key="user.id">
                      <td
                        class="px-4 py-4 text-sm font-medium whitespace-nowrap"
                      >
                        <div>
                          <h2 class="font-medium text-gray-800 dark:text-white">
                            {{ user.first_name }}
                          </h2>
                          <p
                            class="text-sm font-normal text-gray-600 dark:text-gray-400"
                          >
                            {{ user.last_name }}
                          </p>
                        </div>
                      </td>

                      <td>
                        <div>
                          <h4
                            class="text-left text-gray-700 dark:text-gray-200"
                          >
                            {{ user.email }}
                          </h4>
                        </div>
                      </td>

                      <td
                        class="px-12 py-4 text-sm font-medium whitespace-nowrap"
                      >
                        <div>
                          <code class="text-gray-700 dark:text-gray-200">{{
                            user.account_number
                          }}</code>
                        </div>
                      </td>
                      <td class="px-4 py-4 text-sm whitespace-nowrap">
                        <div
                          v-if="user.blocked"
                          class="inline px-3 py-1 text-sm font-normal rounded-full text-red-500 gap-x-2 bg-red-100/60 dark:bg-gray-800 uppercase"
                        >
                          Blocked
                        </div>
                        <div
                          v-else
                          class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800 uppercase"
                        >
                          Active
                        </div>
                      </td>
                      <td class="px-4 py-4 text-sm whitespace-nowrap">
                        <div>
                          <code class="text-gray-700 dark:text-gray-200"
                            >${{ user.balance }}</code
                          >
                        </div>
                      </td>

                      <td class="px-4 py-4 text-sm whitespace-nowrap">
                        <UserMenuOption
                          :user="user"
                          @block="block(user)"
                          @unblock="unblock(user)"
                          @edit="edit(user)"
                          @transact="
                            () => {
                              initiateTranaction(user)
                              currentTransactingUser = user
                            }
                          "
                          @delete="onDeleteUser(user)"
                        >
                          <button
                            class="group px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-300 hover:bg-gray-100"
                          >
                            <ElipsisVertical
                              class="w-6 h-6 group-hover:stroke-blue-700"
                            />
                          </button>
                        </UserMenuOption>
                      </td>
                    </tr>
                  </template>
                  <template v-else>
                    <td colspan="6" class="px-4 py-4 text-sm whitespace-nowrap">
                      <div>
                        <h4
                          class="text-center text-gray-700 dark:text-gray-200"
                        >
                          No users found!
                        </h4>
                      </div>
                    </td>
                  </template>
                </template>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-6 sm:flex sm:items-center sm:justify-end">
      <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
        <router-link
          :to="{ name: 'admin-users', query: { cursor: data?.prev_cursor } }"
          class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800"
          v-show="!!data?.prev_cursor"
        >
          <ArrowLongLeft class="w-6 h-6" />

          <span> Previous </span>
        </router-link>

        <router-link
          :to="{ name: 'admin-users', query: { cursor: data?.next_cursor } }"
          class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800"
          v-show="!!data?.next_cursor"
        >
          <span> Next </span>

          <ArrowLongRight class="w-6 h-6" />
        </router-link>
      </div>
    </div>
  </section>
</template>
