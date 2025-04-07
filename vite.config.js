import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig(({ mode }) => {
    return {
        plugins: [
            laravel({
                input: 'resources/js/app.ts',
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js'),
            },
        },
        server: {
            // Only use this in development
            host: mode === 'development' ? 'localhost' : '0.0.0.0',
            port: 5173,
            strictPort: true,
        },
        build: {
            manifest: true,  // Ensure assets are generated properly
            outDir: 'public/build', // Make sure the build folder is public
        },
    };
});
