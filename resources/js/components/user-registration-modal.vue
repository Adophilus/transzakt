<script lang="ts" setup>
import { ref, defineEmits, defineProps } from 'vue'
const emit = defineEmits(['submit'])
const props = defineProps(['current-user'])

const firstName = ref()
const lastName = ref()
const email = ref()
const accountNumber = ref()
const balance = ref()

const submitUserRegistrationDetails = async (event) => {
  event.preventDefault()
  const userRegistrationDetails = {
    firstName: firstName.value.value,
    lastName: lastName.value.value,
    email: email.value.value,
    accountNumber: accountNumber.value.value,
    balance: balance.value.value
  }

  try {
    let res
    if (!!props.currentUser) {
      res = await fetch(`/api/users/${props.currentUser.id}`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(userRegistrationDetails)
      })
    } else {
      await fetch('/api/users', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(userRegistrationDetails)
      })
    }
    firstName.value.value = ''
    lastName.value.value = ''
    email.value.value = ''
    accountNumber.value.value = ''
    balance.value.value = ''
    emit('submit')
  } catch (error) {
    console.log(error)
  }
}
</script>

<template>
  <section
    class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800"
  >
    <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">
      Account details
    </h2>

    <form
      id="userRegistrationForm"
      @submit="submitUserRegistrationDetails($event)"
    >
      <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
        <div>
          <label class="text-gray-700 dark:text-gray-200" for="firstName"
            >First Name</label
          >
          <input
            id="firstName"
            type="text"
            required
            ref="firstName"
            :value="props.currentUser?.first_name ?? ''"
            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"
          />
        </div>

        <div>
          <label class="text-gray-700 dark:text-gray-200" for="lastName"
            >Last Name</label
          >
          <input
            id="lastName"
            type="text"
            required
            ref="lastName"
            :value="props.currentUser?.last_name ?? ''"
            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"
          />
        </div>

        <div>
          <label class="text-gray-700 dark:text-gray-200" for="email"
            >Email Address</label
          >
          <input
            id="email"
            type="email"
            required
            ref="email"
            :value="props.currentUser?.email ?? ''"
            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"
          />
        </div>

        <div>
          <label class="text-gray-700 dark:text-gray-200" for="accountNumber"
            >Account Number</label
          >
          <input
            id="accountNumber"
            type="text"
            required
            ref="accountNumber"
            :value="props.currentUser?.account_number ?? ''"
            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"
          />
        </div>
        <div>
          <label class="text-gray-700 dark:text-gray-200" for="balance"
            >Balance</label
          >
          <input
            id="balance"
            type="number"
            required
            ref="balance"
            :value="props.currentUser?.balance ?? 0"
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
