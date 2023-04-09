<script setup>
import { ref } from 'vue'
import useSWRV from 'swrv'

import ArrowLongLeft from '../components/icons/arrow-long-left.vue'
import ArrowLongRight from '../components/icons/arrow-long-right.vue'
import ArrowLongUp from '../components/icons/arrow-long-up.vue'
import ArrowLongDown from '../components/icons/arrow-long-down.vue'
import ElipsisVertical from '../components/icons/elipsis-vertical.vue'
import PlusIcon from '../components/icons/plus.vue'
import SearchIcon from '../components/icons/search.vue'

import TransactionModal from '../components/transaction-modal.vue'
import TransactionMenuOption from '../components/transaction-menu-option.vue'
import UserDetailsTooltip from '../components/user-details-tooltip.vue'

const currentTransaction = ref()

const {
  data: transactions,
  mutate,
  isValidating,
  error
} = useSWRV('/api/transactions')
const showTransactionModal = ref(false)

const onTransactionFormSubmitted = async (event) => {
  mutate()
  showTransactionModal.value = false
}

const edit = (transaction) => {
  currentTransaction.value = transaction
  showTransactionModal.value = true
}

const deleteTransaction = async (transaction) => {
  try {
    await fetch(`/api/transactions/${transaction.id}`, {
      method: 'DELETE'
    })
    mutate()
  } catch (error) {
    console.warn(error)
  }
}
</script>

<template>
  <section
    class="flex flex-col w-full px-6 md:justify-between md:items-center md:flex-row"
  >
    <div>
      <h2 class="text-3xl font-medium text-gray-800">Transactions</h2>
      <p class="mt-2 text-sm text-gray-500">Client transactions</p>
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
        <TransactionModal
          :current-transaction="currentTransaction"
          @submit="onTransactionFormSubmitted($event)"
          @cancel="showTransactionModal = false"
          v-show="showTransactionModal"
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
                      <span>ID</span>

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
                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                  >
                    Type
                  </th>
                  <th
                    scope="col"
                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                  >
                    Status
                  </th>

                  <th
                    scope="col"
                    class="px-4 py-3.5 text-sm font-normal text-right rtl:text-right text-gray-500 dark:text-gray-400"
                  >
                    Amount
                  </th>

                  <th
                    scope="col"
                    class="px-4 py-3.5 text-sm font-normal text-center rtl:text-center text-gray-500 dark:text-gray-400"
                  >
                    User
                  </th>

                  <th scope="col" class="relative py-3.5 px-4">
                    <span class="sr-only">Actions</span>
                  </th>
                </tr>
              </thead>
              <tbody
                class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900"
              >
                <tr v-if="!!isValidating && !transactions">
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
                        Sorry, an error occurred while trying to load
                        transactions 🙁
                      </h4>
                    </div>
                  </td>
                </tr>
                <template v-else>
                  <template
                    v-if="
                      Array.isArray(transactions) && transactions.length > 0
                    "
                  >
                    <tr
                      v-for="transaction in transactions"
                      :key="transaction.id"
                    >
                      <td
                        class="px-4 py-4 text-sm font-medium whitespace-nowrap"
                      >
                        <div>
                          <h4 class="font-medium text-gray-800 dark:text-white">
                            {{ transaction.id }}
                          </h4>
                        </div>
                      </td>

                      <td class="px-4 py-4 text-sm whitespace-nowrap">
                        <div>
                          <h4
                            class="text-left text-gray-700 dark:text-gray-200"
                          >
                            <div
                              v-if="transaction.type === 'DEBIT'"
                              class="inline px-3 py-1 text-sm font-normal rounded-full text-red-600 gap-x-2 bg-red-200 dark:bg-gray-800 uppercase"
                            >
                              DEBIT
                            </div>
                            <div
                              v-else
                              class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-600 gap-x-2 bg-emerald-200 dark:bg-gray-800 uppercase"
                            >
                              CREDIT
                            </div>
                          </h4>
                        </div>
                      </td>

                      <td
                        class="px-4 py-4 text-sm text-left font-medium whitespace-nowrap"
                      >
                        <div>
                          <div
                            v-if="transaction.status === 'BLOCKED'"
                            class="inline px-3 py-1 text-sm font-normal rounded-full text-red-500 gap-x-2 bg-red-100/60 dark:bg-gray-800 uppercase"
                          >
                            BLOCKED
                          </div>
                          <div
                            v-else-if="transaction.status === 'FULFILLED'"
                            class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-600 gap-x-2 bg-emerald-200 dark:bg-gray-800 uppercase"
                          >
                            FULFILLED
                          </div>
                          <div
                            v-else-if="transaction.status === 'PENDING'"
                            class="inline px-3 py-1 text-sm font-normal rounded-full text-orange-600 gap-x-2 bg-orange-200 dark:bg-gray-800 uppercase"
                          >
                            PENDING
                          </div>
                          <div
                            v-else-if="transaction.status === 'CANCELLED'"
                            class="inline px-3 py-1 text-sm font-normal rounded-full bg-gray-300 dark:bg-gray-800 text-gray-800 dark:text-white gap-x-2 uppercase"
                          >
                            CANCELLED
                          </div>
                        </div>
                      </td>

                      <td
                        class="px-4 py-4 text-sm text-right font-medium whitespace-nowrap"
                      >
                        <div>
                          <code
                            :class="
                              transaction.type === 'DEBIT'
                                ? 'text-red-600'
                                : 'text-emerald-600'
                            "
                          >
                            {{ transaction.type === 'DEBIT' ? '-' : '+' }}
                            {{ transaction.amount }}
                          </code>
                        </div>
                      </td>
                      <td class="px-4 py-4 text-sm whitespace-nowrap">
                        <div class="flex justify-center">
                          <UserDetailsTooltip :user="transaction.user">
                            <button
                              class="inline px-3 py-1 text-sm font-normal rounded-full gap-x-2 bg-gray-300 dark:bg-gray-800 text-gray-800 dark:text-white uppercase"
                            >
                              {{ transaction.user.account_number }}
                            </button>
                          </UserDetailsTooltip>
                        </div>
                      </td>

                      <td class="px-4 py-4 text-sm whitespace-nowrap">
                        <TransactionMenuOption
                          @edit="edit(transaction)"
                          @delete="deleteTransaction(transaction)"
                        >
                          <button
                            class="group px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-300 hover:bg-gray-100"
                          >
                            <ElipsisVertical
                              class="w-6 h-6 group-hover:stroke-blue-700"
                            />
                          </button>
                        </TransactionMenuOption>
                      </td>
                    </tr>
                  </template>
                  <template v-else>
                    <td colspan="6" class="px-4 py-4 text-sm whitespace-nowrap">
                      <div>
                        <h4
                          class="text-center text-gray-700 dark:text-gray-200"
                        >
                          No transactions found!
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

    <div class="mt-6 sm:flex sm:items-center sm:justify-between">
      <div class="text-sm text-gray-800">
        Page <span class="font-medium text-gray-700">1 of 10</span>
      </div>

      <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
        <a
          href="#"
          class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800"
        >
          <ArrowLongLeft class="w-6 h-6" />

          <span> previous </span>
        </a>

        <a
          href="#"
          class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800"
        >
          <span> Next </span>

          <ArrowLongRight class="w-6 h-6" />
        </a>
      </div>
    </div>
  </section>
</template>
