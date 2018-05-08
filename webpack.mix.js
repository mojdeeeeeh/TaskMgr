let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .copy('resources/assets/css/main.css','public/css')

    .js('resources/assets/js/main.js','public/js')
    .js('resources/assets/js/task-index.js','public/js')
    .js('resources/assets/js/CKEditorHelper.js','public/js')


   .copyDirectory('resources/assets/ckeditor/','public/CKEditor/')
   .copyDirectory('resources/assets/theme/','public/theme/')

   .version();
