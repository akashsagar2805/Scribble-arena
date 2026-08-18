<script setup>
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    pendingRoomCode: {
        type: String,
        default: null,
    },
});

const resetGuest = () => {
    router.delete(route('guest-player.destroy'));
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
                    <span class="text-base font-semibold sm:text-lg">
                        Scribble Arena
                    </span>
                </Link>

                <div class="flex items-center gap-3 text-sm">
                    <span
                        v-if="$page.props.guestPlayer"
                        class="hidden rounded-lg border border-white/10 px-3 py-2 font-medium text-slate-200 sm:inline-flex"
                    >
                        {{ $page.props.guestPlayer.nickname }}
                    </span>
                    <button
                        v-if="$page.props.guestPlayer"
                        class="rounded-lg px-3 py-2 font-medium text-slate-300 transition hover:text-white"
                        type="button"
                        @click="resetGuest"
                    >
                        Change
                    </button>
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="rounded-lg border border-white/10 px-3 py-2 font-medium text-slate-200 transition hover:border-cyan-300 hover:text-white"
                    >
                        Dashboard
                    </Link>
                </div>
            </header>

            <section class="grid flex-1 items-center gap-8 py-10 lg:grid-cols-[0.85fr_1.15fr]">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-cyan-300">
                        Ready area
                    </p>
                    <h1 class="mt-3 text-4xl font-black leading-tight sm:text-5xl">
                        Build the room, then bring in the players.
                    </h1>
                    <p class="mt-5 max-w-xl text-base leading-7 text-slate-300">
                        This is the first game hub. In Phase 3, these actions will create real rooms, room codes, lobby players, and host controls.
                    </p>
                </div>

                <div class="grid gap-4 lg:grid-cols-2">
                    <section class="rounded-lg border border-white/10 bg-white/[0.06] p-5 shadow-2xl shadow-cyan-950/30">
                        <div class="flex items-center justify-between gap-3">
                            <h2 class="text-xl font-bold">
                                Create room
                            </h2>
                            <span class="rounded-full bg-cyan-300 px-3 py-1 text-xs font-bold text-slate-950">
                                Next
                            </span>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-slate-400">
                            Create a room code, configure rounds, and wait for friends in the lobby.
                        </p>
                        <button
                            class="mt-6 w-full cursor-not-allowed rounded-lg bg-cyan-300/60 px-4 py-3 text-sm font-black text-slate-950"
                            disabled
                            type="button"
                        >
                            Coming In Phase 3
                        </button>
                    </section>

                    <section class="rounded-lg border border-white/10 bg-white/[0.04] p-5">
                        <div class="flex items-center justify-between gap-3">
                            <h2 class="text-xl font-bold">
                                Join room
                            </h2>
                            <span
                                v-if="pendingRoomCode"
                                class="rounded-full bg-amber-300 px-3 py-1 text-xs font-bold text-slate-950"
                            >
                                {{ pendingRoomCode }}
                            </span>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-slate-400">
                            Join a friend by room code and sync into the realtime lobby.
                        </p>
                        <button
                            class="mt-6 w-full cursor-not-allowed rounded-lg bg-amber-300/60 px-4 py-3 text-sm font-black text-slate-950"
                            disabled
                            type="button"
                        >
                            Coming In Phase 3
                        </button>
                    </section>

                    <section class="rounded-lg border border-white/10 bg-white/[0.04] p-5 lg:col-span-2">
                        <h2 class="text-xl font-bold">
                            Player session
                        </h2>
                        <dl class="mt-4 grid gap-3 text-sm sm:grid-cols-3">
                            <div class="rounded-lg bg-slate-900 p-4">
                                <dt class="text-slate-500">
                                    Nickname
                                </dt>
                                <dd class="mt-1 font-bold text-white">
                                    {{ $page.props.guestPlayer?.nickname ?? 'Not set' }}
                                </dd>
                            </div>
                            <div class="rounded-lg bg-slate-900 p-4">
                                <dt class="text-slate-500">
                                    Room code
                                </dt>
                                <dd class="mt-1 font-bold text-white">
                                    {{ pendingRoomCode ?? 'Waiting' }}
                                </dd>
                            </div>
                            <div class="rounded-lg bg-slate-900 p-4">
                                <dt class="text-slate-500">
                                    Mode
                                </dt>
                                <dd class="mt-1 font-bold text-white">
                                    Guest play
                                </dd>
                            </div>
                        </dl>
                    </section>
                </div>
            </section>
        </div>
    </main>
</template>
