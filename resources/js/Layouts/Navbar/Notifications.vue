<script setup></script>

<template>
    <Link :href="route('notifications')" class="notifications-toggle relative">
        <icon name="hi-solid-bell" />
        <span
            v-if="$page.props.notification_count"
            class="absolute flex h-5 w-5 translate-y-1/2 translate-x-1/2 start-auto -top-3 end-2"
        >
            <span
                class="animate-ping absolute flex h-full w-full rounded-full bg-red-400 opacity-75"
            ></span>
            <span
                class="relative flex justify-center items-center text-white text-xs font-extrabold rounded-full h-5 w-5 bg-red-500"
            >
                {{ $page.props.notification_count }}
            </span>
        </span>
    </Link>
</template>
