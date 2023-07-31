<script setup></script>

<template>
    <Btn
        data-dropdown-toggle="notification-dropdown"
        class="notifications-toggle"
    >
        <icon name="hi-solid-bell" />
    </Btn>
    <!-- Dropdown menu -->
    <div class="narbar-dropdowns" id="notification-dropdown">
        <div class="title">
            {{ $t("navbar.notifications") }}
        </div>
        <div>
            <Link href="#" class="notification-link">
                <div class="flex-shrink-0">
                    <img src="/images/avatar.jpg" alt="Jese image" />
                </div>
                <div class="w-full ps-3">
                    <div class="notification-container">
                        New message from
                        <span>Bonnie Green</span>: "Hey, what's up? All set for
                        the presentation?"
                    </div>
                    <div class="notification-time">a few moments ago</div>
                </div>
            </Link>
        </div>
        <Link href="#" class="all-notifications-link">
            <div>
                <icon name="hi-solid-eye" />
                {{ $t("navbar.all notifications") }}
            </div>
        </Link>
    </div>
</template>
