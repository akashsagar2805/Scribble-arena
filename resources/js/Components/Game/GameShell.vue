<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <main class="scribble-bg min-h-screen text-slate-900">
        <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-5 sm:px-6 lg:px-8">
            <header class="flex items-center justify-between gap-4">
                <Link :href="route('home')" class="flex items-center gap-3">
                    <span class="grid size-10 place-items-center rounded-full bg-fuchsia-500 text-xl font-black text-white shadow-md">
                        S
                    </span>
                    <span class="font-serif text-3xl font-black italic tracking-normal text-white drop-shadow sm:text-4xl">
                        Scribble Arena
                    </span>
                </Link>

                <slot name="nav" />
            </header>

            <slot />
        </div>
    </main>
</template>
