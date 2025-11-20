<template>
  <AdminLayout>
    <div class="w-full space-y-6">

      <!-- Заголовок -->
      <h1 class="text-xl font-semibold text-brand-text">
        Create Page
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
                    placeholder="Über mich"
                />
                <Error :message="form.errors.name" />
              </div>

              <!-- Slug -->
              <div>
                <label class="form-label">Slug</label>
                <n-input
                    v-model:value="form.slug"
                    placeholder="ueber-mich"
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
                    placeholder="Über mich – Reflect-ON"
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
                    placeholder="Meta description..."
                />
                <Error :message="form.errors.description" />
              </div>

              <!-- Keywords -->
              <div>
                <label class="form-label">Keywords</label>
                <n-input
                    v-model:value="form.keywords"
                    placeholder="reflect-on, coaching, online-kurs"
                />
                <Error :message="form.errors.keywords" />
              </div>

            </div>

          </div>

          <!-- Content (HTML) — на всю ширину -->
          <div>
            <label class="form-label">Content (HTML)</label>
            <n-input
                type="textarea"
                :autosize="{ minRows: 6, maxRows: 20 }"
                v-model:value="form.content"
                placeholder="HTML content will be here (later GrapesJS)"
            />
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
              Create Page
            </n-button>
          </div>

        </form>
      </n-card>

    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/admin/layouts/AdminLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Error from '@/admin/components/Error.vue'
import { useCrudNotifications } from '@/admin/composables/useCrudNotifications'

const form = useForm({
  name: '',
  slug: '',
  title: '',
  description: '',
  keywords: '',
  content: '',
  is_active: true
})

const { success, error } = useCrudNotifications()

const submit = () => {
  form.post(route('admin.pages.store'), {
    onSuccess: () => {
      success('Page was successfully created.')
    },
    onError: () => {
      error('Please check the form fields.')
    }
  })
}

</script>
