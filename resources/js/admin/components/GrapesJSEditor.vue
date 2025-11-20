<template>
  <div ref="editorHost" id="gjs"></div>
</template>


<script setup>
import { onMounted, onBeforeUnmount, ref, watch } from 'vue'
import grapesjs from 'grapesjs'
import grapesjsPresetWebpage from 'grapesjs-preset-webpage'
import 'grapesjs/dist/css/grapes.min.css'

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  }
})

const emit = defineEmits(['update:modelValue'])

const editorHost = ref(null)
let editorInstance = null
let initialized = false

function getPublicCss() {
  const css1 = document.head.querySelector('meta[name="public-css-1"]')?.content
  const css2 = document.head.querySelector('meta[name="public-css-2"]')?.content
  return [css1, css2].filter(Boolean)
}

onMounted(() => {
  editorInstance = grapesjs.init({
    container: editorHost.value,
    fromElement: false,
    height: '500px',
    width: '100%',
    storageManager: false,
    components: props.modelValue || '',
    style: '',
    canvas: {
      styles: getPublicCss(),
    },
    plugins: [grapesjsPresetWebpage],
    pluginsOpts: {
      [grapesjsPresetWebpage]: {
        formsOpts: false,
        navbarOpts: false,
        countdownOpts: false,
      }
    },

    assetManager: {
      upload: '/admin/media/upload',
      uploadName: 'file',
      autoAdd: true,
      credentials: 'include',
      multiUpload: false,
      embedAsBase64: false,
      allowedMimes: [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif'
      ],
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    },

    parser: {
      html: {
        cleanId: false,
        cleanClass: false,
      }
    },
    deviceManager: false,
  })

  initialized = true
})

// если вдруг props.modelValue изменится после инициализации (редкий кейс)
watch(
    () => props.modelValue,
    (val) => {
      if (!editorInstance) return
      if (!initialized && val) {
        editorInstance.setComponents(val)
        initialized = true
      }
    }
)

onBeforeUnmount(() => {
  if (editorInstance) {
    editorInstance.destroy()
    editorInstance = null
  }
})
</script>

<style>
.gjs-one-bg {
  background-color: #f8f8fc !important;
}
.gjs-two-color {
  color: #423B87 !important;
}
.gjs-three-bg {
  background-color: #9896D9 !important;
}
.gjs-four-color {
  color: white !important;
}
.gjs-pn-panel {
  border-color: #e5e7eb !important;
}
.gjs-pn-btn {
  color: #423B87 !important;
}
.gjs-pn-btn.gjs-pn-active {
  background: #423B87 !important;
  color: #fff !important;
}
</style>

