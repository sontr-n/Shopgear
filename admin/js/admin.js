$(document).ready(function() {
    // $('#categoriesSelection').val('');
    // $('#subCategoriesSelection').val('');
    $('#categoriesSelection').change(function() {
        var cateId = $(this).find(":selected").data('id');
        $('#subCategoriesSelection').val('');
        $('#subCategoriesSelection option').hide();
        $('#subCategoriesSelection option[data-cateid=' + cateId +']').show();
    });
    tinymce.init({
        selector: "textarea",  // change this value according to your HTML
        plugins: "image"
    });
});