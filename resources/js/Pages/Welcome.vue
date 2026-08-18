<script setup>
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const createForm = useForm({
    nickname: '',
    intent: 'create',
    room_code: '',
});

const joinForm = useForm({
    nickname: '',
    intent: 'join',
    room_code: '',
});

const submitCreate = () => {
    createForm.post(route('guest-player.store'));
};

const submitJoin = () => {
    joinForm.post(route('guest-player.store'));
};
</script>

<template>
    <Head title="Play" />

    <main class="min-h-screen bg-slate-950 text-white">
        <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-6 sm:px-6 lg:px-8">
            <header class="flex items-center justify-between gap-4">
                <Link :href="route('home')" class="flex items-center gap-3">
                    <span class="grid size-10 place-items-center rounded-lg bg-cyan-400 text-lg font-black text-slate-950">
                        SA
                    </span>
                    <span class="text-base font-semibold tracking-normal sm:text-lg">
                        Scribble Arena
                    </span>
                </Link>

                <nav v-if="canLogin" class="flex items-center gap-2 text-sm">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="rounded-lg border border-white/10 px-3 py-2 font-medium text-slate-200 transition hover:border-cyan-300 hover:text-white"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="rounded-lg px-3 py-2 font-medium text-slate-300 transition hover:text-white"
                        >
                            Log in
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="rounded-lg border border-white/10 px-3 py-2 font-medium text-slate-200 transition hover:border-cyan-300 hover:text-white"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </header>

            <section class="grid flex-1 items-center gap-10 py-10 lg:grid-cols-[1.05fr_0.95fr] lg:py-14">
                <div class="max-w-2xl">
                    <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-cyan-300/20 bg-cyan-300/10 px-3 py-1 text-sm font-medium text-cyan-100">
                        Realtime drawing party game
                    </div>

                    <h1 class="text-4xl font-black leading-tight tracking-normal text-white sm:text-5xl lg:text-6xl">
                        Draw fast. Guess faster.
                    </h1>

                    <p class="mt-5 max-w-xl text-base leading-7 text-slate-300 sm:text-lg">
                        Start as a guest, share a room code, and jump into a live drawing match with friends.
                    </p>

                    <div class="mt-8 grid max-w-xl grid-cols-3 gap-3 text-sm">
                        <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                            <div class="text-2xl font-black text-cyan-300">01</div>
                            <div class="mt-1 text-slate-300">Pick a nickname</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                            <div class="text-2xl font-black text-amber-300">02</div>
                            <div class="mt-1 text-slate-300">Create a room</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4">
                            <div class="text-2xl font-black text-rose-300">03</div>
                            <div class="mt-1 text-slate-300">Play live</div>
                        </div>
                    </div>
                </div>

                <div class="grid gap-4">
                    <form
                        class="rounded-lg border border-white/10 bg-white/[0.06] p-5 shadow-2xl shadow-cyan-950/40 backdrop-blur"
                        @submit.prevent="submitCreate"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-xl font-bold text-white">
                                    Create a room
                                </h2>
                                <p class="mt-1 text-sm text-slate-400">
                                    Become the host and invite players.
                                </p>
                            </div>
                            <span class="rounded-full bg-cyan-300 px-3 py-1 text-xs font-bold text-slate-950">
                                Host
                            </span>
                        </div>

                        <label class="mt-5 block text-sm font-medium text-slate-200" for="create-nickname">
                            Nickname
                        </label>
                        <input
                            id="create-nickname"
                            v-model="createForm.nickname"
                            autocomplete="nickname"
                            class="mt-2 block w-full rounded-lg border border-white/10 bg-slate-950/70 px-4 py-3 text-white placeholder:text-slate-500 focus:border-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300/30"
                            maxlength="24"
                            placeholder="e.g. PixelPro"
                            type="text"
                        />
                        <InputError class="mt-2" :message="createForm.errors.nickname" />

                        <button
                            class="mt-5 w-full rounded-lg bg-cyan-300 px-4 py-3 text-sm font-black text-slate-950 transition hover:bg-cyan-200 disabled:cursor-not-allowed disabled:opacity-60"
                            :disabled="createForm.processing"
                            type="submit"
                        >
                            Create Room
                        </button>
                    </form>

                    <form
                        class="rounded-lg border border-white/10 bg-white/[0.04] p-5 backdrop-blur"
                        @submit.prevent="submitJoin"
                    >
                        <h2 class="text-xl font-bold text-white">
                            Join with code
                        </h2>
                        <p class="mt-1 text-sm text-slate-400">
                            Have a room code from a friend? Enter it here.
                        </p>

                        <div class="mt-5 grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-slate-200" for="join-nickname">
                                    Nickname
                                </label>
                                <input
                                    id="join-nickname"
                                    v-model="joinForm.nickname"
                                    autocomplete="nickname"
                                    class="mt-2 block w-full rounded-lg border border-white/10 bg-slate-950/70 px-4 py-3 text-white placeholder:text-slate-500 focus:border-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-300/30"
                                    maxlength="24"
                                    placeholder="e.g. Sketchy"
                                    type="text"
                                />
                                <InputError class="mt-2" :message="joinForm.errors.nickname" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-200" for="room-code">
                                    Room code
                                </label>
                                <input
                                    id="room-code"
                                    v-model="joinForm.room_code"
                                    class="mt-2 block w-full rounded-lg border border-white/10 bg-slate-950/70 px-4 py-3 uppercase tracking-widest text-white placeholder:tracking-normal placeholder:text-slate-500 focus:border-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-300/30"
                                    maxlength="12"
                                    placeholder="ABCD12"
                                    type="text"
                                />
                                <InputError class="mt-2" :message="joinForm.errors.room_code" />
                            </div>
                        </div>

                        <button
                            class="mt-5 w-full rounded-lg bg-amber-300 px-4 py-3 text-sm font-black text-slate-950 transition hover:bg-amber-200 disabled:cursor-not-allowed disabled:opacity-60"
                            :disabled="joinForm.processing"
                            type="submit"
                        >
                            Join Room
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </main>
</template>
