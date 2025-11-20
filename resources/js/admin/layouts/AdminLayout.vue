<template>
  <n-config-provider :theme-overrides="themeOverrides">
    <div class="min-h-screen flex flex-col bg-gray-50">

      <Head :title="computedTitle" />

      <!-- Header -->
      <AdminHeader/>

      <div class="flex flex-1">

        <!-- Desktop Sidebar -->
        <div class="hidden md:block">
          <AdminSidebar/>
        </div>

        <!-- Content -->
        <main class="flex-1 p-6">
          <slot/>
        </main>

      </div>

      <!-- Footer -->
      <AdminFooter/>

      <!-- Mobile Drawer -->
      <AdminMobileSidebar/>

    </div>
  </n-config-provider>
</template>

<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { NConfigProvider } from 'naive-ui'
import { adminThemeOverrides } from '../theme'
import AdminHeader from '../components/AdminHeader.vue'
import AdminSidebar from '../components/AdminSidebar.vue'
import AdminFooter from '../components/AdminFooter.vue'
import AdminMobileSidebar from '../components/AdminMobileSidebar.vue'

const themeOverrides = adminThemeOverrides

const page = usePage()

const computedTitle = computed(() => {
  const raw = page.component || ''     // например: "Users/Index"
  if (!raw) return ''

  // 1. Берём последнюю часть (Index → Index)
  let last = raw.split('/').pop()      // "UserProfile/EditPassword" → "EditPassword"

  // 2. CamelCase → разделение (EditPassword → Edit Password)
  last = last.replace(/([a-z])([A-Z])/g, '$1 $2')

  // 3. Дефисы и подчёркивания → пробелы (edit-password → edit password)
  last = last.replace(/[-_]/g, ' ')

  // 4. Приводим к нижнему (general settings)
  last = last.toLowerCase()

  // 5. Первая буква каждого слова — заглавная (General Settings)
  last = last.replace(/\b\w/g, (l) => l.toUpperCase())

  // 6. Дополнительная логика для CRUD страниц:
  //    Index → Users (если компонент Users/Index)
  if (/index/i.test(last) && raw.includes('/')) {
    // Пример: raw = "Users/Index"
    const parent = raw.split('/')[0]      // "Users"
        .replace(/([a-z])([A-Z])/g, '$1 $2') // UsersPage → Users Page
        .replace(/[-_]/g, ' ')
        .replace(/\b\w/g, (l) => l.toUpperCase())
    return parent
  }

  return last
})
</script>
