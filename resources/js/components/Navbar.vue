<style scoped>
    .dropdown{
        position: absolute;
        width: 100%;
        right: 0;
        top: 100%;
        margin-top: 13px;
        opacity: 1;
    }
    .dropdown::before{
        content: "";
        position: absolute;
        top: -10px;
        right: 0;
        margin-right: 20px;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid rgba(74, 85, 104,1);
    }
</style>

<template>
    <nav class="w-full py-5">
        <div class="container mx-auto">
            <ul class="flex t justify-between align-middle">
                <li class="rounded-lg text-white hover:bg-blue-100 transition ease-in-out duration-200 mx-1 my-auto"><a class="py-1 px-2 text-2xl font-bold text-blue-400 flex flex-no-wrap" href="/"><i class="my-auto mr-3" style="width: 30px; height: 30px; stroke-width: 1" data-feather="twitter"></i>Twitter</a></li>
                <li class="text-blue-400 flex justify-center align-middle" v-if="!user">
                    <a class="rounded-md hover:bg-blue-100 transition ease-in-out duration-200 px-3 py-1 mx-1 my-auto" href="/login">Login</a>
                    <a class="rounded-md hover:bg-blue-100 transition ease-in-out duration-200 px-3 py-1 mx-1 my-auto" href="/register">Register</a>
                </li>
                <li class="flex justify-center align-middle relative" v-if="user">
                    <button class="bg-transparent border-0 flex flex-no-wrap justify-center align-middle rounded-lg hover:bg-gray-700 px-4 py-2" @click="toggleDropdown">
                        <div class="w-16 h-16 rounded-full bg-indigo-900 mx-2 overflow-hidden flex">
                            <img class="w-full h-auto object-cover" :src="user.avatar" alt="Profile image">
                        </div>
                        <div class="flex flex-col my-auto">
                            <span class="text-white font-bold text-left">
                                {{user.name}}
                            </span>
                            <span class="text-gray-600 text-xs text-left">
                                {{user.handle}}
                            </span>
                        </div>
                        <i class="my-auto ml-3 text-white my-auto" style="width: 30px; height: 30px; stroke-width: 1" data-feather="chevron-down"></i>
                    </button>
                    <div class="dropdown bg-gray-700 border-gray-700 rounded-lg flex flex-no-wrap flex-col py-4 transition ease-in-out duration-100 z-40" v-if="dropdownExpanded">
                        <a class="text-white mx-3 px-3 my-1 py-3 text-center rounded-lg hover:bg-gray-600 flex flex-no-wrap transition ease-in-out duration-100" :href="'/u/' + this.user.handle"><i class="mr-3 text-white" style="stroke-width: 1; fill: currentColor; stroke: transparent; opacity: 0.5;" data-feather="user"></i> <span class="mx-auto">Profile</span></a>
                        <a class="text-white mx-3 px-3 my-1 py-3 text-center rounded-lg hover:bg-gray-600 flex flex-no-wrap transition ease-in-out duration-100" href="/logout"><i class="mr-3 text-white" style="stroke-width: 1" data-feather="log-out"></i> <span class="mx-auto">Logout</span></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        mounted() {
            feather.replace()
        },
        data(){
            return {dropdownExpanded: false}
        },
        updated() {
            feather.replace()
        },
        methods: {
            toggleDropdown() {
                this.dropdownExpanded = !this.dropdownExpanded
            }
        },
        props: {
            user: Object,
        }
    }
</script>


