const generalLevelScript = function () {
    'use strict';
    const initWysiwygEditor = () => {
        tinymce.init({
            selector: '.content-editor',
            plugins: 'code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'undo redo | insert | styleselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample | a11ycheck | casechange | checklist | code | formatpainter | insertfile | pageembed | permanentpen | table',
            relative_urls: false,
            remove_script_host: false,
            images_upload_url: './cms_admin/tinyMCE_img_upload',
            /* selector:'.content-editor',
            // toolbar: 'undo redo | image code',
            menubar: true,
            themes: 'monokai',
            plugins: [
                'a11ychecker advcode casechange formatpainter linkchecker lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinydrive tinymcespellchecker',
				'advlist autolink lists link image charmap print preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen',
				'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc',
            ],
            image_advtab: true,
            toolbar_drawer: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            image_advtab: true,
            automatic_uploads: false, */
        });
    }
    
    
    return {
        init: function () {
            initWysiwygEditor()
        }
    }

}();

$(() => {
    generalLevelScript.init()
})