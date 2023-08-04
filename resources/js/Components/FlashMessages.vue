<template>
    <Transition mode="out-in">
        <div>
            <div
                v-if="
                    $page.props.flash.success && show && $page.props.user.alert
                "
                id="alert-border-2"
                class="flex fixed bottom-0 z-50 w-full justify-center text-center items-center p-4 text-white bg-green-500"
                role="alert"
            >
                <svg
                    class="flex-shrink-0 w-4 h-4"
                    @click="show = false"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                    />
                </svg>
                <div class="ms-3 text-sm font-medium text-center">
                    {{ $page.props.flash.success }}
                </div>
            </div>

            <div
                v-if="
                    ($page.props.flash.error ||
                        Object.keys($page.props.errors).length > 0) &&
                    show &&
                    $page.props.user.alert
                "
                id="alert-border-2"
                class="flex fixed bottom-0 z-50 w-full justify-center text-center items-center p-4 text-gray-100 dark:text-gray-200 bg-red-500"
                role="alert"
            >
                <svg
                    class="flex-shrink-0 w-4 h-4"
                    @click="show = false"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                    />
                </svg>
                <div class="ms-3 text-sm font-medium text-center">
                    <p v-if="$page.props.flash.error">
                        {{ $page.props.flash.error }}
                    </p>
                    <p v-else>
                        <span
                            v-if="Object.keys($page.props.errors).length === 1"
                        >
                            {{ $t("one error") }}
                        </span>
                        <span v-else>
                            {{
                                $t("errors", [
                                    Object.keys($page.props.errors).length,
                                ])
                            }}</span
                        >
                    </p>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
export default {
    data() {
        return {
            show: true,
        };
    },

    watch: {
        "$page.props.flash": {
            handler() {
                this.show = true;
                setTimeout(() => (this.show = false), 3000);
            },
            deep: true,
        },
    },
};
</script>
