<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-cyan-600">
                        Scribble Arena
                    </p>
                    <h2 class="text-2xl font-black leading-tight text-gray-900">
                        Player Dashboard
                    </h2>
                </div>
                <Link
                    :href="route('play')"
                    class="inline-flex items-center justify-center rounded-lg bg-slate-950 px-4 py-2 text-sm font-bold text-white transition hover:bg-cyan-700"
                >
                    Play Now
                </Link>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8">
                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-widest text-cyan-700">
                        Quick start
                    </p>
                    <h3 class="mt-3 text-3xl font-black text-gray-950">
                        Jump into a guest match first.
                    </h3>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-600">
                        Accounts will unlock saved match history, leaderboard identity, and achievements later. The game itself stays fast: pick a nickname and play.
                    </p>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        <Link
                            :href="route('home')"
                            class="rounded-lg border border-gray-200 p-4 transition hover:border-cyan-400 hover:bg-cyan-50"
                        >
                            <div class="text-base font-bold text-gray-950">
                                Create or join
                            </div>
                            <div class="mt-1 text-sm text-gray-600">
                                Open the guest entry screen.
                            </div>
                        </Link>
                        <Link
                            :href="route('profile.edit')"
                            class="rounded-lg border border-gray-200 p-4 transition hover:border-amber-400 hover:bg-amber-50"
                        >
                            <div class="text-base font-bold text-gray-950">
                                Profile
                            </div>
                            <div class="mt-1 text-sm text-gray-600">
                                Manage account details.
                            </div>
                        </Link>
                    </div>
                </section>

                <section class="grid gap-4">
                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <div class="text-sm font-semibold uppercase tracking-widest text-gray-500">
                            Recent games
                        </div>
                        <div class="mt-4 rounded-lg bg-gray-50 p-4 text-sm text-gray-600">
                            Match history will appear here after round logic is added.
                        </div>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <div class="text-sm font-semibold uppercase tracking-widest text-gray-500">
                            Leaderboard
                        </div>
                        <div class="mt-4 grid gap-2">
                            <div class="flex items-center justify-between rounded-lg bg-gray-50 px-4 py-3 text-sm">
                                <span class="font-bold text-gray-900">Fastest correct guess</span>
                                <span class="text-gray-500">Coming soon</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-gray-50 px-4 py-3 text-sm">
                                <span class="font-bold text-gray-900">Most wins</span>
                                <span class="text-gray-500">Coming soon</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
