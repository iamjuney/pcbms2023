<script setup></script>

<template>
    <body class="h-full">
        <div class="min-h-full">
            <main
                class="custom-bg flex min-h-screen flex-col justify-center py-12 sm:px-6 lg:px-8"
            >
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <div class="flex flex-col items-center">
                        <img
                            src="images/vsu-logo.png"
                            class="h-12"
                            alt="VSU logo"
                        />
                        <h6 class="mt-4 text-xs font-medium text-primary">
                            Office of the Vice President of Research, Extension,
                            and Innovation
                        </h6>

                        <h1 class="mt-4 text-2xl font-extrabold text-primary">
                            Pasalubong Center
                        </h1>
                        <h2 class="text-2xl font-extrabold text-primary">
                            Business Management System
                        </h2>
                    </div>
                </div>
                <slot />
            </main>
        </div>
    </body>
</template>

<style>
.custom-bg {
    background: linear-gradient(
            to bottom,
            rgba(255, 255, 255, 0.2) 0%,
            rgba(255, 255, 255, 0.2) 100%
        ),
        url(images/searchfortruth.jpg);
    background-size: cover;
}
</style>
