<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'

const echoNotifications = ref([]);
Echo.private(`notifications`)
    .listen('NotificationCreated', (e) => {
        echoNotifications.value.push(e.notification);

        setTimeout(() => {
            router.post(route('notifications.viewed', e.notification.id));
            echoNotifications.value.shift();
        }, 5000)
    });
</script>

<template>
    <transition name="fade">
        <div v-if="echoNotifications.length"
             class="echo-notification">
            <div class="echo-notification-title">
                {{echoNotifications[0].title}}
            </div>
            <div class="echo-notification-text">
                {{echoNotifications[0].text}}
            </div>
        </div>
    </transition>
</template>
