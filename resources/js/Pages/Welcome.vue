<script setup>
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const nickname = ref('');

const createForm = useForm({
    nickname: nickname.value,
    max_players: 8,
    rounds_total: 3,
    drawing_seconds: 60,
});

const joinForm = useForm({
    nickname: nickname.value,
    room_code: '',
});

const submitCreate = () => {
    createForm.nickname = nickname.value;
    createForm.post(route('rooms.store'));
};

const submitJoin = () => {
    joinForm.nickname = nickname.value;
    joinForm.post(route('rooms.join'));
};
</script>

<template>
    <Head title="Play" />

    <main class="scribble-bg flex min-h-screen items-center justify-center px-4 py-8 text-slate-900">
        <div class="w-full max-w-sm">
            <div class="mb-5 text-center">
                <div class="inline-flex items-center justify-center gap-3">
                    <span class="grid size-14 place-items-center rounded-full bg-fuchsia-500 text-3xl font-black text-white shadow-md">
                        S
                    </span>
                    <h1 class="font-serif text-5xl font-black italic text-white drop-shadow-md">
                        Scribble
                    </h1>
                </div>
            </div>

            <section class="rounded-md bg-white p-4 shadow-xl">
                <input
                    v-model="nickname"
                    autocomplete="nickname"
                    class="block w-full rounded border border-gray-300 px-4 py-3 text-base text-slate-900 outline-none transition placeholder:text-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    maxlength="24"
                    placeholder="Enter your name"
                    type="text"
                />
                <InputError
                    class="mt-2"
                    :message="createForm.errors.nickname || joinForm.errors.nickname"
                />

                <form @submit.prevent="submitCreate">
                    <div class="mt-3 grid grid-cols-3 gap-2">
                        <select
                            v-model="createForm.max_players"
                            aria-label="Max players"
                            class="rounded border border-gray-300 px-2 py-2 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >
                            <option :value="4">4 players</option>
                            <option :value="6">6 players</option>
                            <option :value="8">8 players</option>
                        </select>
                        <select
                            v-model="createForm.rounds_total"
                            aria-label="Rounds"
                            class="rounded border border-gray-300 px-2 py-2 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >
                            <option :value="1">1 round</option>
                            <option :value="3">3 rounds</option>
                            <option :value="5">5 rounds</option>
                        </select>
                        <select
                            v-model="createForm.drawing_seconds"
                            aria-label="Timer"
                            class="rounded border border-gray-300 px-2 py-2 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >
                            <option :value="45">45 sec</option>
                            <option :value="60">60 sec</option>
                            <option :value="90">90 sec</option>
                        </select>
                    </div>

                    <button
                        class="mt-3 w-full rounded bg-blue-600 px-4 py-3 text-base font-semibold text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60"
                        :disabled="createForm.processing"
                        type="submit"
                    >
                        Create a room
                    </button>
                </form>

                <div class="my-3 flex items-center gap-3 text-sm font-semibold text-gray-500">
                    <div class="h-px flex-1 bg-gray-200"></div>
                    <span>OR</span>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>

                <form class="grid grid-cols-[1fr_auto] gap-2" @submit.prevent="submitJoin">
                    <input
                        v-model="joinForm.room_code"
                        class="block w-full rounded border border-gray-300 px-4 py-3 text-base uppercase tracking-wider text-slate-900 outline-none transition placeholder:normal-case placeholder:tracking-normal placeholder:text-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
                        maxlength="6"
                        placeholder="Enter Room Id"
                        type="text"
                    />
                    <button
                        class="rounded bg-emerald-500 px-5 py-3 text-base font-semibold text-white transition hover:bg-emerald-600 disabled:cursor-not-allowed disabled:opacity-60"
                        :disabled="joinForm.processing"
                        type="submit"
                    >
                        Join
                    </button>
                    <InputError class="col-span-2" :message="joinForm.errors.room_code" />
                </form>
            </section>

            <div class="mt-4 text-center text-white drop-shadow">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="font-semibold underline decoration-white/50 underline-offset-4"
                >
                    Dashboard
                </Link>
                <div v-else-if="canLogin" class="flex justify-center gap-4 text-sm">
                    <Link :href="route('login')" class="font-semibold underline decoration-white/50 underline-offset-4">
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="font-semibold underline decoration-white/50 underline-offset-4"
                    >
                        Register
                    </Link>
                </div>
            </div>
        </div>
    </main>
</template>
