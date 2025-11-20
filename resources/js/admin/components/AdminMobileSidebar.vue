<template>
  <n-drawer
      v-model:show="sidebar.mobileOpen"
      width="260"
      placement="left"
  >
    <n-drawer-content>
      <AdminSidebar />
    </n-drawer-content>
  </n-drawer>
</template>

<script setup>
import { useAdminSidebar } from '@/stores/adminSidebar'
import AdminSidebar from './AdminSidebar.vue'

const sidebar = useAdminSidebar()
</script>
