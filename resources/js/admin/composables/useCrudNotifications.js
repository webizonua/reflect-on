import { useNotification } from 'naive-ui'

export function useCrudNotifications() {
    const notification = useNotification()

    const success = (message = 'Saved successfully') => {
        notification.success({
            title: 'Success',
            description: message,
            duration: 3000
        })
    }

    const error = (message = 'Something went wrong') => {
        notification.error({
            title: 'Error',
            description: message,
            duration: 4000
        })
    }

    return { success, error }
}
