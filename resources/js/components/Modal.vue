<template>
    <Transition name="fade">
        <div
            v-if="showing"
            class="fixed inset-0 w-full h-full flex items-center justify-center bg-smoke z-50"
            v-on:click="close"
        >
            <div class="relative h-full w-full shadow-lg rounded-lg py-2 px-5 flex">
                <div class="overflow-auto h-full w-full relative overflow-auto rounded-md my-auto" style="max-height: 90vh" >
                    <slot />
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
    export default {
        props: {
            showing: {
                required: true,
                type: Boolean
            }
        },
        watch: {
            showing(value) {
                if (value) {
                    return document.querySelector('body').classList.add('overflow-hidden');
                }

                document.querySelector('body').classList.remove('overflow-hidden');
            }
        },
        methods: {
            close() {
                this.$emit('close');
            }
        }
    };
</script>
<style>
    .fade-enter-active,
    .fade-leave-active {
        transition: all 0.6s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }

    .bg-smoke-900 {background-color: rgba(0, 0, 0, 0.9)}
    .bg-smoke-800 {background-color: rgba(0, 0, 0, 0.75)}
    .bg-smoke-600 {background-color: rgba(0, 0, 0, 0.6)}
    .bg-smoke     {background-color: rgba(0, 0, 0, 0.5)}
    .bg-smoke-400 {background-color: rgba(0, 0, 0, 0.4)}
    .bg-smoke-200 {background-color: rgba(0, 0, 0, 0.25)}
    .bg-smoke-100 {background-color: rgba(0, 0, 0, 0.1)}

    div::-webkit-scrollbar-track
    {
        border-radius: 10px;
        background-color: #F5F5F500;
    }

    div::-webkit-scrollbar
    {
        width: 6px;
        background-color: #F5F5F500;
    }

    div::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        background-color: #C1C1C1;
    }
</style>
