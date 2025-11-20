<template>
  <div class="flex flex-wrap gap-2">
    <template v-for="(link, i) in links" :key="i">
      <div v-if="link.url === null"
           class="px-3 py-1 text-gray-400 text-sm"
           v-html="link.label" />
      <button
          v-else
          class="px-3 py-1 text-sm rounded hover:bg-gray-100 transition"
          :class="link.active ? 'bg-brand-purple text-white' : 'text-gray-700'"
          @click="go(link.url)"
          v-html="link.label"
      />
    </template>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
  links: Array
})

const go = (url) => {
  router.visit(url)
}
</script>
