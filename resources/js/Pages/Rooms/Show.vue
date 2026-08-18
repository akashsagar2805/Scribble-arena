<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    room: {
        type: Object,
        required: true,
    },
});

const colors = ['#111827', '#ef4444', '#f59e0b', '#facc15', '#22c55e', '#38bdf8', '#6366f1', '#d946ef'];
</script>

<template>
    <Head :title="`Room ${room.code}`" />

    <main class="scribble-bg min-h-screen px-4 py-5 text-slate-900">
        <div class="mx-auto max-w-6xl">
            <header class="mb-4 text-center">
                <Link :href="route('home')" class="inline-flex items-center gap-2">
                    <span class="grid size-10 place-items-center rounded-full bg-fuchsia-500 text-xl font-black text-white shadow-md">
                        S
                    </span>
                    <span class="font-serif text-4xl font-black italic text-white drop-shadow">
                        Scribble
                    </span>
                </Link>
            </header>

            <section class="rounded-md bg-white px-4 py-3 shadow-lg">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div class="text-lg font-bold">
                        Room: <span class="select-all tracking-widest text-blue-700">{{ room.code }}</span>
                    </div>
                    <div class="flex flex-wrap gap-3 text-sm font-semibold text-slate-600">
                        <span>Players: {{ room.players.length }}/{{ room.maxPlayers }}</span>
                        <span>Rounds: {{ room.roundsTotal }}</span>
                        <span>Timer: {{ room.drawingSeconds }}s</span>
                    </div>
                </div>
            </section>

            <section class="mt-2 grid gap-2 lg:grid-cols-[180px_1fr_240px]">
                <aside class="rounded-md bg-white/90 shadow-lg">
                    <div
                        v-for="(player, index) in room.players"
                        :key="player.id"
                        class="flex items-center gap-3 border-b border-slate-200 px-3 py-3 last:border-b-0"
                    >
                        <div class="grid size-10 shrink-0 place-items-center rounded-full bg-teal-500 text-sm font-black uppercase text-white">
                            {{ player.nickname.slice(0, 2) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="truncate text-sm font-bold">
                                {{ player.nickname }}
                                <span v-if="player.isHost" class="text-xs text-blue-600">(Host)</span>
                            </div>
                            <div class="text-xs text-slate-600">
                                Score: 0
                            </div>
                        </div>
                        <div class="text-2xl font-black text-fuchsia-600">
                            #{{ index + 1 }}
                        </div>
                    </div>

                    <div class="px-3 py-3 text-center text-xs font-semibold text-slate-500">
                        Waiting for more players
                    </div>
                </aside>

                <section class="overflow-hidden rounded-md bg-white shadow-lg">
                    <div class="flex items-center justify-between bg-white px-4 py-3">
                        <div class="font-bold">
                            Round: 1/{{ room.roundsTotal }}
                        </div>
                        <div class="rounded bg-slate-900 px-3 py-1 text-sm font-bold text-white">
                            00:{{ String(room.drawingSeconds).padStart(2, '0') }}
                        </div>
                    </div>

                    <div class="relative aspect-[4/3] border-y border-slate-200 bg-white">
                        <div class="absolute left-[16%] top-[22%] h-2 w-48 rotate-[-8deg] rounded-full bg-slate-900"></div>
                        <div class="absolute left-[27%] top-[40%] h-2 w-72 rotate-[9deg] rounded-full bg-slate-900"></div>
                        <div class="absolute bottom-[22%] left-[20%] h-24 w-24 rounded-md border-4 border-slate-900"></div>
                        <div class="absolute bottom-[26%] right-[18%] h-20 w-32 rounded-full border-4 border-slate-900"></div>
                    </div>

                    <div class="flex flex-wrap items-center justify-center gap-2 bg-slate-100 px-3 py-3">
                        <button
                            v-for="color in colors"
                            :key="color"
                            :style="{ backgroundColor: color }"
                            class="size-8 rounded border border-slate-300"
                            type="button"
                        ></button>
                        <button class="ml-2 rounded bg-white px-3 py-2 text-sm font-bold shadow-sm" type="button">
                            Pen
                        </button>
                        <button class="rounded bg-white px-3 py-2 text-sm font-bold shadow-sm" type="button">
                            Eraser
                        </button>
                        <button class="rounded bg-white px-3 py-2 text-sm font-bold text-red-600 shadow-sm" type="button">
                            Clear
                        </button>
                    </div>
                </section>

                <aside class="flex min-h-[360px] flex-col rounded-md bg-white/95 shadow-lg">
                    <div class="flex-1 space-y-2 overflow-hidden p-3 text-sm">
                        <p class="font-semibold text-blue-600">{{ room.players[0]?.nickname ?? 'Host' }} is setting up the room</p>
                        <p class="font-semibold text-emerald-600">Players can join with code {{ room.code }}</p>
                        <p><span class="font-bold">System:</span> waiting to start</p>
                    </div>
                    <div class="border-t border-slate-200 p-2">
                        <div class="grid grid-cols-[1fr_auto] gap-2">
                            <input
                                class="rounded border border-slate-300 px-3 py-2 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
                                disabled
                                placeholder="Type a Message"
                                type="text"
                            />
                            <button
                                class="rounded-full bg-emerald-500 px-4 py-2 font-black text-white"
                                disabled
                                type="button"
                            >
                                Go
                            </button>
                        </div>
                    </div>
                </aside>
            </section>
        </div>
    </main>
</template>
