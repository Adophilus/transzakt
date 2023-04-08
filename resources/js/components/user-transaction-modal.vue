<script lang="ts" setup>
import { ref, defineEmits } from 'vue'
const emit = defineEmits(['cancel', 'submit'])

const transactionType = ref()
const amount = ref()

const submitUserTransactionDetails = async (event) => {
  event.preventDefault()
  const userTransactionDetails = {
    transactionType: transactionType.value.value,
    amount: amount.value.value
  }

  emit('submit', userTransactionDetails)
  amount.value.value = ''
}
</script>

<template>
  <section
    class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800"
  >
    <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">
      Transaction details
    </h2>

    <form
      id="userTransactionForm"
      @submit="submitUserTransactionDetails($event)"
    >
      <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
        <div>
          <label class="text-gray-700 dark:text-gray-200" for="transactionType">
            Transaction type</label
          >
          <select
            id="transactionType"
            type="text"
            required
            ref="transactionType"
            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"
          >
            <option>CREDIT</option>
            <option>DEBIT</option>
          </select>
        </div>

        <div>
          <label class="text-gray-700 dark:text-gray-200" for="amount"
            >amount</label
          >
          <input
            id="amount"
            type="number"
            required
            ref="amount"
            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"
          />
        </div>
      </div>

      <div class="flex gap-x-6 justify-end mt-6">
        <button
          @click="emit('cancel')"
          class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-blue-700"
        >
          Save
        </button>
      </div>
    </form>
  </section>
</template>
