<script setup>
import NotAuthLayout from "@/Layouts/NotAuthLayout.vue";
</script>
<template>
    <NotAuthLayout>
        <Head title="Log in" />

        <div
            class="flex flex-col justify-center items-center px-6 mx-auto xl:px-0 dark:bg-gray-900"
        >
            <div class="block mb-5 md:max-w-md">
                <img
                    class="w-48"
                    src="/images/not-active.svg"
                    alt="maintenance image"
                />
            </div>
            <div class="text-center xl:max-w-4xl">
                <h1
                    class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl dark:text-white"
                >
                    {{ $t("not active") }}
                </h1>

                <Link
                    :href="route('logout')"
                    as="button"
                    method="post"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-3 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                >
                    {{ $t("navbar.logout") }}
                </Link>
            </div>
        </div>
    </NotAuthLayout>
</template>
