<template>
  <div ref="editor" class="cm-wrapper"></div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from 'vue'

import { EditorView, keymap } from '@codemirror/view'
import { EditorState } from '@codemirror/state'
import { html } from '@codemirror/lang-html'
import { oneDark } from '@codemirror/theme-one-dark'
import { basicLight } from '@fsegurai/codemirror-theme-basic-light'

const reflectOnLight = EditorView.theme({
  "&": {
    backgroundColor: "#ffffff",
    color: "#1f2937",
    fontFamily: "JetBrains Mono, Consolas, monospace"
  },
  ".cm-content": {
    caretColor: "#423B87"
  },
  "&.cm-editor.cm-focused": {
    outline: "2px solid #9896D9 !important"
  },
  ".cm-gutters": {
    backgroundColor: "#f9fafb",
    color: "#6b7280",
    borderRight: "1px solid #e5e7eb"
  },
  ".cm-lineNumbers .cm-gutterElement": {
    padding: "0 8px"
  },
  ".cm-tagName": { color: "#b03060" },
  ".cm-attributeName": { color: "#1d4ed8" },
  ".cm-attributeValue": { color: "#047857" },
  ".cm-string": { color: "#047857" },
  ".cm-comment": { color: "#6b7280" },
})

const props = defineProps({
  modelValue: { type: String, default: '' },
  dark: { type: Boolean, default: false }
})

const emit = defineEmits(['update:modelValue'])

const editor = ref(null)
let view = null

onMounted(() => {
  const startState = EditorState.create({
    doc: props.modelValue,
    extensions: [
      html(),
      keymap.of([]),

      props.dark ? oneDark : basicLight,

      EditorView.updateListener.of((update) => {
        if (update.docChanged) {
          const text = update.state.doc.toString()
          emit('update:modelValue', text)
        }
      }),

      EditorView.lineWrapping,
    ]
  })

  view = new EditorView({
    state: startState,
    parent: editor.value
  })
})

watch(
    () => props.modelValue,
    (newValue) => {
      if (view && newValue !== view.state.doc.toString()) {
        view.dispatch({
          changes: { from: 0, to: view.state.doc.length, insert: newValue }
        })
      }
    }
)

onBeforeUnmount(() => {
  if (view) view.destroy()
})
</script>

<style>
.cm-wrapper {
  border: 1px solid #d1d5db;
  border-radius: 6px;
  overflow: hidden;
}
</style>
