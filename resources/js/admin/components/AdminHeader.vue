<template>
  <header class="w-full bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">

    <!-- MOBILE BURGER -->
    <button
        class="md:hidden hover:text-brand-purple transition text-gray-400"
        @click="sidebar.openMobile"
    >
      <Menu size="26" />
    </button>

    <!-- Admin Title -->
    <h1 class="text-xl font-semibold text-brand-purple hidden md:block">
      Reflect-ON Admin
    </h1>

    <!-- Breadcrumbs -->
    <nav class="text-sm text-gray-500 mt-1 items-center hidden md:block">
      <ol class="flex items-center gap-2 flex-wrap">

        <!-- Dashboard link -->
        <li class="flex items-center gap-1">
          <a href="/admin" class="hover:text-brand-purple flex items-center gap-1">
            <NIcon size="14"><Home /></NIcon>
            <span>Dashboard</span>
          </a>
        </li>

        <!-- Dynamic crumbs -->
        <template v-for="(bc, index) in crumbs" :key="index">
          <li class="text-gray-400">›</li>
          <li>
            <a
                v-if="bc.route"
                :href="route(bc.route)"
                class="hover:text-brand-purple transition"
            >
              {{ bc.label }}
            </a>
            <span v-else>{{ bc.label }}</span>
          </li>
        </template>

      </ol>
    </nav>

    <!-- Right Buttons -->
    <div class="flex items-center gap-8">

      <!-- Link: Перейти на сайт -->
      <a
          href="/"
          target="_blank"
          class="flex items-center gap-1 hover:text-brand-purple transition text-gray-400"
      >
        <NIcon size="18"><Globe /></NIcon>
        <span class="hidden md:inline">Visit Site</span>
      </a>

      <!-- Link: Logout -->
      <form method="POST" action="/logout">
        <button
            type="submit"
            class="flex items-center gap-1 hover:text-red-600 transition text-gray-400"
        >
          <NIcon size="18"><LogOut /></NIcon>
          <span class="hidden md:inline">Logout</span>
        </button>
      </form>

    </div>

  </header>
</template>

<script setup>
import { Menu, Home, Globe, LogOut } from 'lucide-vue-next'
import { NIcon } from 'naive-ui'
import { useAdminSidebar } from '@/stores/adminSidebar'
import { useBreadcrumbs } from '@/admin/composables/useBreadcrumbs'

const sidebar = useAdminSidebar()
const { crumbs } = useBreadcrumbs()
</script>

