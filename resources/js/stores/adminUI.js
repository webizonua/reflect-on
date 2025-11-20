import {defineStore} from 'pinia'
import {ref} from 'vue'

export const useAdminUI = defineStore('AdminUI', () => {
    const collapsed = ref(false)
    const mobileOpen = ref(false)

    const toggle = () => collapsed.value = !collapsed.value
    const openMobile = () => mobileOpen.value = true
    const closeMobile = () => mobileOpen.value = false

    const editorMode = ref(localStorage.getItem('editorMode') || 'ckeditor')
    const setEditorMode = (mode) => {
        editorMode.value = mode
        localStorage.setItem('editorMode', mode)
    }

    return {collapsed, mobileOpen, toggle, openMobile, closeMobile, editorMode, setEditorMode}
})
