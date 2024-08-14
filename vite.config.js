import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
		    'resources/js/app.js',
		    'resources/scss/app.scss',
		    'resources/scss/components/attachment.scss',
		    'resources/js/admin/test-projects/attachments/create.js'
	    ],
            refresh: true,
        }),
    ],
});
