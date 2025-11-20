<template>
  <div>
    <div class="flex gap-2 mb-4">
      <button
          @click.prevent="setMode('ckeditor')"
          :class="buttonClass(mode === 'ckeditor')"
      >
        CKEditor
      </button>

      <button
          @click.prevent="setMode('grapesjs')"
          :class="buttonClass(mode === 'grapesjs')"
      >
        GrapesJS
      </button>

      <button
          @click.prevent="setMode('raw')"
          :class="buttonClass(mode === 'raw')"
      >
        Raw HTML
      </button>
    </div>

    <!-- CKEditor -->
    <div v-if="mode === 'ckeditor'">
      <CKEditor v-model="localValue" />
    </div>

    <!-- GrapesJS -->
    <div v-if="mode === 'grapesjs'">
      <GrapesJSEditor v-model="localValue" />
    </div>

    <!-- Raw Editor -->
    <div v-if="mode === 'raw'" class="overflow-hidden">
      <CodeMirrorEditor v-model="localValue" :dark="false" />
    </div>

  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import CKEditor from './CKEditor.vue'
import GrapesJSEditor from './GrapesJSEditor.vue'
import CodeMirrorEditor from './CodeMirrorEditor.vue'
import { useAdminUI } from '@/stores/adminUI.js'

const props = defineProps({
  modelValue: { type: String, default: '' },
})

const emit = defineEmits(['update:modelValue'])

const localValue = ref(props.modelValue)

const ui = useAdminUI()
const mode = ref(ui.editorMode)

function setMode(newMode) {
  ui.setEditorMode(newMode)
  mode.value = newMode
}

watch(localValue, (v) => emit('update:modelValue', v))

watch(
    () => props.modelValue,
    (v) => (localValue.value = v)
)

function buttonClass(active) {
  return [
    'px-4 py-2 rounded-md font-semibold transition duration-150',
    'border border-gray-300',
    active
        ? 'bg-[#423B87] text-white shadow'
        : 'bg-white text-gray-700 hover:bg-gray-100'
  ]
}
</script>
