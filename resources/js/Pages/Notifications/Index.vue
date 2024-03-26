<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'


defineProps({
    notifications: {}
});
const form = useForm({});
const deleteNotification = (id) => {
    form.delete(route('notifications.delete', id))
};
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Notifications</h2>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <section>
                        <header>
                            <Link :href="route('notifications.create')" method="get" as="button" type="button">Создать уведомление</Link>
                        </header>
                    </section>

                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-6">
                        <table v-if="notifications.length" class="max-w-7xl mx-auto back-crud-table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Заголовок</th>
                                    <th>Просмотров</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tr v-for="(notification, index) in notifications" :key="notification.id">
                                <td>{{notification.id}}</td>
                                <td>{{notification.title}}</td>
                                <td>{{notification.viewed}}</td>
                                <td>
                                    <Link :href="route('notifications.edit', notification.id)" method="get" as="button" type="button">изменить</Link>
                                    <DangerButton
                                        class="ms-3"
                                        @click="deleteNotification(notification.id)"
                                    >
                                        удалить
                                    </DangerButton>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

