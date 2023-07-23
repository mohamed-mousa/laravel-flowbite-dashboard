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
                    src="/images/avatar.jpg"
                    :alt="$page.props.auth.user.name"
                />
            </Btn>
        </div>
        <!-- Dropdown menu -->
        <div class="profile-dropdown" id="profile-dropdown">
            <div role="none">
                <p class="name" role="none">
                    {{ $page.props.auth.user.name }}
                </p>
                <p class="email" role="none">
                    {{ $page.props.auth.user.email }}
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
                        role="menuitem"
                        >{{ $t("navbar.logout") }}</Link
                    >
                </li>
            </ul>
        </div>
    </div>
</template>
