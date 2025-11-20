import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAdminSidebar = defineStore('adminSidebar', () => {
    const collapsed = ref(false)        // состояние: свернут/развернут
    const mobileOpen = ref(false)       // Drawer для мобильных

    const toggle = () => collapsed.value = !collapsed.value
    const openMobile = () => mobileOpen.value = true
    const closeMobile = () => mobileOpen.value = false

    return { collapsed, mobileOpen, toggle, openMobile, closeMobile }
})
