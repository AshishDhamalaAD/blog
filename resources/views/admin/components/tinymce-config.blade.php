@props([
'id' => 'tinymce',
'category' => 'image',
])

@once
<script
    src="https://cdn.tiny.cloud/1/jpamoi4osp74tob1cw02x5sn5vu8g2hf8b77x8t16kew9tdk/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"
></script>
@endonce

<script>
    tinymce.init({
        selector: '#{{ $id }}',
        relative_urls: false,
        menubar: '',
        height: 400,
        plugins: ['image', 'link', 'wordcount', 'fullscreen', 'preview', 'table', 'lists'],
        toolbar1: 'blocks | bold italic underline strikethrough superscript subscript | forecolor backcolor | removeformat preview fullscreen',
        toolbar2: 'alignleft aligncenter alignright alignjustify | lineheight | bullist numlist outdent indent | image table link',
        file_picker_callback : function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = '/admin/laravel-filemanager?editor=' + meta.fieldname;
            if (meta.filetype == 'image') {
                cmsURL = cmsURL + "&type={{ $category }}";
            } else {
                cmsURL = cmsURL + "&type=file";
            }

            tinyMCE.activeEditor.windowManager.openUrl({
                url : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no",
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        }
    });
</script>