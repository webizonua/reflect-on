<template>
  <n-drawer
      v-model:show="adminUI.mobileOpen"
      width="260"
      placement="left"
  >
    <n-drawer-content>
      <AdminSidebar />
    </n-drawer-content>
  </n-drawer>
</template>

<script setup>
import { useAdminUI } from '@/stores/adminUI'
import AdminSidebar from './AdminSidebar.vue'

const adminUI = useAdminUI()
</script>
