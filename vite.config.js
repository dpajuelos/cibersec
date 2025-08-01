import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/usuario/index-usuario.css',
                'resources/js/usuario/app-usuario.js',
                'resources/js/admin/retos.js'
            ],
            refresh: true,
        }),
        react(),
    ],
    build: {
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
            },
            mangle: {
                properties: {
                    regex: /^_/
                }
            },
            format: {
                comments: false,
            },
        },
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
});
