<script setup></script>

<template>
    <!-- Profile -->
    <div class="flex items-center ms-3">
        <div>
            <Btn
                class="profile-toggle"
                id="profile-menu"
                aria-expanded="false"
                data-dropdown-toggle="profile-dropdown"
            >
                <img
                    :src="$page.props.user.avatar || '/images/avatar.jpg'"
                    :alt="$page.props.user.name"
                />
            </Btn>
        </div>
        <!-- Dropdown menu -->
        <div class="profile-dropdown" id="profile-dropdown">
            <div role="none">
                <p class="name" role="none">
                    {{ $page.props.user.name }}
                </p>
                <p class="email" role="none">
                    {{ $page.props.user.email }}
                </p>
            </div>
            <ul role="none">
                <li>
                    <Link :href="route('profile.edit')" role="menuitem">{{
                        $t("navbar.profile")
                    }}</Link>
                </li>

                <li>
                    <Link
                        :href="route('logout')"
                        as="button"
                        method="post"
                        class="ps-4 py-1 dark:hover:bg-gray-600 text-start text-gray-600 dark:text-gray-300 hover:bg-gray-100 w-full"
                        role="menuitem"
                        >{{ $t("navbar.logout") }}</Link
                    >
                </li>
            </ul>
        </div>
    </div>
</template>
