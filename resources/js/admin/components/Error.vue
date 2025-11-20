<template>
  <p v-if="message" class="text-red-600 text-sm mt-1">
    {{ message }}
  </p>
</template>

<script setup>
defineProps({
  message: {
    type: String,
    default: null
  }
})
</script>
