// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  build:{
    outDir: 'public/build/',
  },
  plugins: [
    laravel({
      input: [
        'resources/sass/app.scss',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
  server: {
    proxy: {
      '/': 'http://localhost:8000/',
    },
  },
  debug: true, // Dodajte ovu opciju
});

