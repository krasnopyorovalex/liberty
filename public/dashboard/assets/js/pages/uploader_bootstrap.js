/* ------------------------------------------------------------------------------
*
*  # Bootstrap multiple file uploader
*
*  Specific JS code additions for uploader_bootstrap.html page
*
*  Version: 1.1
*  Latest update: Dec 11, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {
    // AJAX upload
    const fileInputAjax = jQuery(".file-input-ajax"),
        uploadUrl = jQuery('#images form input[name=uploadUrl]').val(),
        _images_box = jQuery("#_images_box");
    let _images_box_mob = jQuery("#_images_box-mob");

    fileInputAjax.fileinput({
        uploadUrl: uploadUrl,
        uploadAsync: true,
        //maxFileCount: 4,
        initialPreview: [],
        browseLabel: 'Выбрать',
        removeLabel: 'Удалить',
        uploadLabel: 'Загрузить',
        dropZoneTitle: 'Перетащите файлы сюда …',
        msgSelected: '{n} выбрано файлов',
        fileActionSettings: {
            removeTitle: 'Удалить файл',
            uploadTitle: 'Загрузить файл',
            removeIcon: '<i class="icon-bin"></i>',
            removeClass: 'btn btn-link btn-xs btn-icon',
            uploadIcon: '<i class="icon-upload"></i>',
            uploadClass: 'btn btn-link btn-xs btn-icon',
            indicatorNew: '<i class="icon-file-plus text-slate"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        },
        uploadExtraData: function () {
            return {
                isMobile: $('#images form').find('select').val()
            };
        }
    }).on('fileuploaded', function() {
        return jQuery.ajax({
            url: uploadUrl,
            type: "GET",
            data: {
                'isMobile': $('#images form').find('select').val() === '1'
            },
            success: function(data) {
                $('#images form').find('select').val() === '1'
                    ? _images_box_mob.html(data.images)
                    : _images_box.html(data.images);
                $('.file-input .file-preview .kv-file-remove').trigger('click');
                return startDnDImages();
            }
        });
    });
});
