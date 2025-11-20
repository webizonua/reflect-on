import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

export function useBreadcrumbs() {
    const pageProps = usePage().props

    const crumbs = computed(() => {
        const current = route().current()

        if (!current) return []

        let parts = current.split('.')   // ["admin","pages","create"]

        // Remove "admin"
        if (parts[0] === 'admin') {
            parts.shift()                // ["pages","create"]
        }

        // Remove last "index"
        if (parts[parts.length - 1] === 'index') {
            parts.pop()                  // ["pages"]
        }

        const base = parts[0]            // pages | dashboard | users | settings
        const action = parts[1] || null  // create | edit | undefined

        const items = []

        // SPECIAL CASE: DASHBOARD
        if (base === 'dashboard') {
            items.push({
                label: 'Dashboard',
                route: 'admin.dashboard'
            })
            return items
        }

        // COMMON CASE: resources (Pages, Users...)
        items.push({
            label: base.replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase()),
            route: `admin.${base}.index`
        })

        // Create
        if (action === 'create') {
            items.push({
                label: 'Create',
                route: null
            })
        }

        // Edit
        if (action === 'edit') {
            const title = pageProps?.page?.name || ''
            items.push({
                label: `Edit "${title}"`,
                route: null
            })
        }

        return items
    })

    return { crumbs }
}
