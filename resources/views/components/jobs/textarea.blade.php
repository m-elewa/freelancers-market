@push('scripts')
<script src="{{ mix('node_modules/tinymce/tinymce.js') }}"></script>
<script>

var ed = new tinymce.Editor('description', {
    min_width: 300,
    height: 300,
    min_height: 300,

    setup: function (editor) {
        editor.on('input change', function (e) {
            $('textarea#description').val(editor.getContent())
        });
    }

}, tinymce.EditorManager);

ed.render();

$("button[type='submit']").click(function () {
    var editorContent = $('textarea#description').val();

    if (editorContent == '' || editorContent == null) {
        if (!$('#editor-error-message').length) {
            $('<span id="editor-error-message" class="invalid-feedback d-block"><strong>The description field is required.</strong></span>').insertAfter($(ed.getContainer()));
        }
    } else {
        // Remove error message
        if ($('#editor-error-message'))
            $('#editor-error-message').remove();
    }

})
</script>
@endpush