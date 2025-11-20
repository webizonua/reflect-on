<script setup>
import AdminLayout from '@/admin/layouts/AdminLayout.vue'
</script>

<template>
  <AdminLayout>
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <n-grid :cols="4" :x-gap="24" :y-gap="24">
      <n-gi>
        <n-card>
          <h2 class="text-lg font-semibold mb-2">Users</h2>
          <p class="text-gray-500">34 registered users</p>
        </n-card>
      </n-gi>

      <n-gi>
        <n-card>
          <h2 class="text-lg font-semibold mb-2">Posts</h2>
          <p class="text-gray-500">12 blog posts</p>
        </n-card>
      </n-gi>

      <n-gi>
        <n-card>
          <h2 class="text-lg font-semibold mb-2">Orders</h2>
          <p class="text-gray-500">5 active orders</p>
        </n-card>
      </n-gi>

      <n-gi>
        <n-card>
          <h2 class="text-lg font-semibold mb-2">Revenue</h2>
          <p class="text-gray-500">$4,320 today</p>
        </n-card>
      </n-gi>

    </n-grid>
  </AdminLayout>
</template>
