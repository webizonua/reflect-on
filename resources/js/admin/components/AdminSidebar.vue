<template>
  <aside
      class="bg-[#F8F8FC] bg-white border-r border-gray-200 h-full flex flex-col transition-all duration-300"
      :class="collapsed ? 'w-20' : 'w-64'"
  >

    <!-- МЕНЮ -->
    <div class="flex-1 overflow-y-auto p-2">
      <n-menu
          :options="menuOptions"
          :value="$page.url"
          :collapsed="collapsed"
          :collapsed-width="64"
          :accordion="true"
          :indent="18"
          @update:value="navigate"
      />
    </div>

    <!-- КНОПКА СВЕРНУТЬ -->
    <button
        @click="sidebar.toggle()"
        class="border-t py-3 text-brand-purple border-gray-200 hover:text-black transition flex items-center justify-center"
    >
      <ChevronLeft v-if="!collapsed" />
      <ChevronRight v-else />
    </button>

  </aside>
</template>

<script setup>
import { h } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import { LayoutDashboard, Users, Settings, ChevronLeft, ChevronRight, FileText } from 'lucide-vue-next'
import { useAdminSidebar } from '@/stores/adminSidebar'
import {storeToRefs} from "pinia";
const sidebar = useAdminSidebar()

const { collapsed } = storeToRefs(sidebar)

const navigate = (route) => router.visit(route)

const isActive = (key) => {
  const currentUrl = usePage().url

  return currentUrl.startsWith(key)
}

const menuOptions = [
  {
    label: "Dashboard",
    key: "/admin",
    icon: () => h(LayoutDashboard, { size: 18, color: '#423B87' })
  },
  {
    label: "Pages",
    key: "/admin/pages",
    icon: () => h(FileText, { size: 18, color: '#423B87' })
  },
  /*{
    label: "Users",
    key: "/admin/users",
    icon: () => h(Users, { size: 18, color: '#423B87' })
  },
  {
    label: "Settings",
    key: "/admin/settings",
    icon: () => h(Settings, { size: 18, color: '#423B87' })
  }*/
]
</script>

<style scoped>
/* Tailwind работает, но можно добавить плавность */
</style>
