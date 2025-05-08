import path from 'path'
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/css/additional-styles/flatpickr.css',
        'resources/css/additional-styles/utility-patterns.css',
        'resources/css/datatable_style.css',
        'resources/css/form_style.css',
        'resources/css/MultiSelect.css',
        'resources/js/app.js',
        'resources/js/components/dashboard-card-01.js',
        'resources/js/components/dashboard-card-02.js',
        'resources/js/components/dashboard-card-03.js',
        'resources/js/components/dashboard-card-04.js',
        'resources/js/components/dashboard-card-05.js',
        'resources/js/components/dashboard-card-06.js',
        'resources/js/components/dashboard-card-07.js',
        'resources/js/components/dashboard-card-08.js',
        'resources/js/components/dashboard-card-09.js',
        'resources/js/components/dashboard-card-11.js',
        'resources/js/components/MultiSelect.js',
        'resources/js/bootstrap.js',
        'resources/js/utils.js',
      ],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '@tailwindConfig': path.resolve(__dirname, 'tailwind.config.js'),
    },
  },
  optimizeDeps: {
    include: [
      '@tailwindConfig',
    ]
  },   
});