import adapter from '@sveltejs/adapter-static';
import { vitePreprocess } from '@sveltejs/vite-plugin-svelte';

/** @type {import('@sveltejs/kit').Config} */
const config = {
	// Consult https://svelte.dev/docs/kit/integrations
	// for more information about preprocessors
	preprocess: vitePreprocess(),

	kit: {
		// Static adapter for production builds
		// Generates static HTML/CSS/JS files to be served by Nginx
		adapter: adapter({
			// Output directory for built files
			pages: 'build',
			assets: 'build',
			// Fallback page for client-side routing (SPA mode)
			fallback: 'index.html',
			// Don't precompress files (nginx will handle gzip)
			precompress: false,
			// Strict mode - fail build if pages can't be prerendered
			strict: false
		})
	}
};

export default config;
