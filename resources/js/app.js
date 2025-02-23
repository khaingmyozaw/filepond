import './bootstrap';

// jquery
import $ from 'jquery';
window.$ = window.jQuery = $;

// Filepond
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';

// File plugin 'preview image'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

const pond = $('.pond').get(0);

FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.create(pond, {
    credits: false,
    server: {
        process: '/upload/process',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        allowMultiple: true
    }
});