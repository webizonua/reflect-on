<template>
  <textarea :id="editorId"></textarea>
</template>

<script setup>
import {ref, onMounted, onBeforeUnmount, watch} from 'vue'

const props = defineProps({
  modelValue: {type: String, default: ""},
  height: {type: Number, default: 500},
  editorId: {
    type: String,
    default: () => "ckeditor-" + Math.random().toString(36).substring(2, 9)
  }
})

const emit = defineEmits(["update:modelValue"])

const editorInstance = ref(null)
const adminCssLinks = ref([])

function loadAdminCss() {
  adminCssLinks.value = [...document.querySelectorAll('link[rel="stylesheet"]')]
      .map(link => link.href)
      .filter(href => href.includes('fonts.googleapis.com') || href.includes('fonts.gstatic.com'))
}

function extractGoogleFontNames(url) {
  const result = []
  const families = url.match(/family=[^&]+/g)
  if (!families) return result

  families.forEach(f => {
    const name = f
        .replace('family=', '')
        .split(':')[0]
        .replace(/\+/g, ' ')
        .trim()
    if (name) result.push(name)
  })

  return result
}

function getGoogleFontsList() {
  const fonts = []
  adminCssLinks.value.forEach(url => {
    fonts.push(...extractGoogleFontNames(url))
  })
  return [...new Set(fonts)]
}

function initEditor() {
  const css1 = document.querySelector('meta[name="public-css-1"]')?.content || ''
  const css2 = document.querySelector('meta[name="public-css-2"]')?.content || ''
  const fonts = getGoogleFontsList()
  const fontList = fonts.map(f => `${f}/${f}`).join(';')

  if (!window.CKEDITOR) {
    console.error("CKEditor not loaded!")
    return
  }

  editorInstance.value = CKEDITOR.replace(props.editorId, {
    height: props.height,
    language: 'en',
    contentsCss: [css1, css2, ...adminCssLinks.value],
    font_names: fontList,
    allowedContent: true,
    removeDialogTabs: 'image:advanced;link:advanced',
    format_tags: 'h1;h2;h3;h4;p',
    filebrowserUploadUrl: '/admin/media/upload?_token=' + document.querySelector('meta[name="csrf-token"]').content,
    filebrowserImageUploadUrl: '/admin/media/upload?_token=' + document.querySelector('meta[name="csrf-token"]').content,
    uploadUrl: '/admin/media/upload?_token=' + document.querySelector('meta[name="csrf-token"]').content,
    filebrowserUploadMethod: 'form',
    toolbarGroups: [
      {name: 'clipboard', groups: ['clipboard', 'undo']},
      {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
      {name: 'links'},
      {name: 'insert'},
      {name: 'forms'},
      {name: 'tools'},
      {name: 'document', groups: ['mode', 'document', 'doctools']},
      {name: 'others'},
      '/',
      {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
      {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
      {name: 'styles'},
      {name: 'colors'},
      {name: 'about'}
    ],
  })

  editorInstance.value.on("change", () => {
    emit("update:modelValue", editorInstance.value.getData())
  })
  editorInstance.value.setData(props.modelValue)
}

onMounted(() => {
  loadAdminCss()
  initEditor()
})

onBeforeUnmount(() => {
  if (editorInstance.value) {
    editorInstance.value.destroy(true)
  }
})

watch(
    () => props.modelValue,
    (newVal) => {
      if (
          editorInstance.value &&
          newVal !== editorInstance.value.getData()
      ) {
        editorInstance.value.setData(newVal)
      }
    }
)
</script>
