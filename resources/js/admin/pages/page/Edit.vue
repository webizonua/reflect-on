<template>
  <AdminLayout>
    <div class="w-full space-y-6">

      <!-- Заголовок -->
      <h1 class="text-xl font-semibold text-brand-text">
        Edit Page
      </h1>

      <n-card>

        <form @submit.prevent="submit" class="space-y-10">

          <!-- 2-колоночная сетка -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Левая колонка -->
            <div class="space-y-6">

              <!-- Name -->
              <div>
                <label class="form-label">Name</label>
                <n-input
                    v-model:value="form.name"
                />
                <Error :message="form.errors.name" />
              </div>

              <!-- Slug -->
              <div>
                <label class="form-label">Slug</label>
                <n-input
                    v-model:value="form.slug"
                    :disabled="form.slug === 'home'"
                />
                <Error :message="form.errors.slug" />
              </div>

              <!-- Is Active -->
              <div class="flex items-center gap-3">
                <n-switch v-model:value="form.is_active" />
                <span>Active</span>
                <Error :message="form.errors.is_active" />
              </div>

            </div>

            <!-- Правая колонка -->
            <div class="space-y-6">

              <!-- Title -->
              <div>
                <label class="form-label">Title (meta)</label>
                <n-input
                    v-model:value="form.title"
                />
                <Error :message="form.errors.title" />
              </div>

              <!-- Description -->
              <div>
                <label class="form-label">Description (meta)</label>
                <n-input
                    type="textarea"
                    :autosize="{ minRows: 3, maxRows: 8 }"
                    v-model:value="form.description"
                />
                <Error :message="form.errors.description" />
              </div>

              <!-- Keywords -->
              <div>
                <label class="form-label">Keywords</label>
                <n-input
                    v-model:value="form.keywords"
                />
                <Error :message="form.errors.keywords" />
              </div>

            </div>

          </div>

          <!-- Content (HTML) — на всю ширину -->
          <div>
            <label class="form-label">Content (HTML)</label>
            <Editor v-model="form.content" />
            <Error :message="form.errors.content" />
          </div>

          <!-- Submit button -->
          <div class="flex justify-end">
            <n-button
                type="primary"
                size="large"
                :loading="form.processing"
                attr-type="submit"
            >
              Update Page
            </n-button>
          </div>

        </form>
      </n-card>

    </div>
  </AdminLayout>
</template>


<script setup>
import AdminLayout from '@/admin/layouts/AdminLayout.vue'
import Error from '@/admin/components/Error.vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { useCrudNotifications } from '@/admin/composables/useCrudNotifications'
import Editor from '@/admin/components/Editor.vue'

const page = usePage().props.page

const form = useForm({
  name: page.name,
  slug: page.slug,
  title: page.title,
  description: page.description,
  keywords: page.keywords,
  content: page.content,
  is_active: page.is_active
})

const { success, error } = useCrudNotifications()

const submit = () => {
  form.put(route('admin.pages.update', page.id), {
    onSuccess: () => {
      success('Page was successfully updated.')
    },
    onError: () => {
      error('Please fix validation errors.')
    }
  })
}
</script>
