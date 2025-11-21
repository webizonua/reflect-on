<template>
  <AdminLayout>

    <div class="w-full space-y-6">

      <!-- Заголовок + кнопка -->
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold text-brand-text">Pages</h1>

        <n-button
            type="primary"
            size="large"
            @click="goCreate"
        >
          Create Page
        </n-button>
      </div>

      <!-- Таблица -->
      <n-card>
        <div class="overflow-x-auto">
          <table class="min-w-full table-auto text-left border-collapse">

            <!-- Header -->
            <thead>
            <tr class="border-b border-gray-200 text-gray-600 bg-gray-50">
              <th class="py-3 px-3 font-medium">Name</th>
              <th class="py-3 px-3 font-medium">Slug</th>
              <th class="py-3 px-3 font-medium">Active</th>
              <th class="py-3 px-3 font-medium hidden md:table-cell">Updated</th>
              <th class="py-3 px-3 font-medium text-right">Actions</th>
            </tr>
            </thead>

            <!-- Rows -->
            <tbody>
            <tr
                v-for="page in pages.data"
                :key="page.id"
                class="border-b border-gray-200 hover:bg-gray-50 transition"
            >

              <!-- Name (clickable) -->
              <td
                  class="py-3 px-3 font-medium text-brand-purple cursor-pointer hover:underline"
                  @click="goEdit(page.id)"
              >
                {{ page.name }}
              </td>

              <!-- Slug -->
              <td class="py-3 px-3 text-gray-600">
                {{ page.slug }}
              </td>

              <!-- Active -->
              <td class="py-3 px-3">
                  <span
                      class="px-2 py-1 rounded text-xs font-semibold"
                      :class="page.is_active
                      ? 'bg-green-100 text-green-700'
                      : 'bg-red-100 text-red-700'"
                  >
                    {{ page.is_active ? 'Active' : 'Disabled' }}
                  </span>
              </td>

              <!-- Updated -->
              <td class="py-3 px-3 text-gray-600 text-sm hidden md:table-cell">
                {{ formatDate(page.updated_at) }}
              </td>

              <!-- Actions -->
              <td class="py-3 px-3">
                <div class="flex items-center justify-end gap-4">

                  <!-- Edit -->
                  <button
                      class="flex items-center gap-1 text-brand-purple hover:text-brand-purple-light cursor-pointer transition"
                      @click="goEdit(page.id)"
                  >
                    <NIcon size="16"><EditIcon /></NIcon>
                    <span class="hidden sm:inline text-sm">Edit</span>
                  </button>

                  <!-- Delete -->
                  <button
                      class="flex items-center gap-1 text-red-600 hover:text-red-700 cursor-pointer transition"
                      @click="confirmDelete(page.id)"
                  >
                    <NIcon size="16"><Trash2 /></NIcon>
                    <span class="hidden sm:inline text-sm">Delete</span>
                  </button>

                </div>
              </td>

            </tr>
            </tbody>

          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
          <Pagination :links="pages.links" />
        </div>
      </n-card>

    </div>

  </AdminLayout>
</template>

<script setup>
import { computed } from 'vue'
import AdminLayout from '@/admin/layouts/AdminLayout.vue'
import Pagination from '@/admin/components/Pagination.vue'
import { router, usePage } from '@inertiajs/vue3'
import { NButton, useDialog, useNotification } from 'naive-ui'
import { Edit as EditIcon, Trash2 } from 'lucide-vue-next'
import { NIcon } from 'naive-ui'

const pages = computed(() => usePage().props.pages)
const dialog = useDialog()
const notification = useNotification()

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('de-DE', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  })
}

const goCreate = () => {
  router.get(route('admin.pages.create'))
}

const goEdit = (id) => {
  router.get(route('admin.pages.edit', id))
}

const confirmDelete = (id) => {
  dialog.warning({
    title: 'Delete Page',
    content: 'Are you sure you want to delete this page?',
    positiveText: 'Delete',
    negativeText: 'Cancel',
    positiveButtonProps: {
      type: 'error'
    },
    onPositiveClick: () => {
      router.delete(
          route('admin.pages.destroy', id),
          {
            onSuccess: () => {
              router.reload({ only: ['pages'] })
              notification.success({
                title: 'Deleted',
                description: 'Page was successfully removed.',
                duration: 3000
              })
            }
          }
      )
    }
  })
}
</script>


