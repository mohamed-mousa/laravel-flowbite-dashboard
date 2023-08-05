<script setup></script>

<template>
    <Link :href="route('notifications')" class="icon-style relative">
        <icon name="hi-bell" class="w-6 h-6" />
        <span
            v-if="
                $page.props.notification_count && $page.props.user.notification
            "
            class="absolute flex h-5 w-5 translate-y-1/2 translate-x-1/2 start-auto -top-2.5 end-3"
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
