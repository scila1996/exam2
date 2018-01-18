<style>
    .cke_textarea_inline
    {
        padding: 10px;
        min-height: 50px;
        overflow: auto;
        box-shadow: 0px 0px 5px #C0C0C0;
    }
</style>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        (function () {
            CKEDITOR.plugins.addExternal('fill', '/asset/ext/ckeditor/plugins/fill/');
            CKEDITOR.plugins.addExternal('mathjax', '/asset/ext/ckeditor/plugins/mathjax/');
        })();
<?php if ($plugins): ?>
            CKEDITOR.config.extraPlugins = '<?= $plugins ?>';
<?php endif ?>
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.toolbarCanCollapse = true;
        CKEDITOR.config.toolbarStartupExpanded = false;
        CKEDITOR.config.height = 200;
        CKEDITOR.config.htmlEncodeOutput = false;
        CKEDITOR.config.entities = false;
        CKEDITOR.config.autoParagraph = false;
        CKEDITOR.config.showProcessingMessages = false;
        CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
        CKEDITOR.config.removePlugins = 'htmlwriter,elementspath';
        CKEDITOR.config.mathJaxLib = 'https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML';
        CKEDITOR.config.mathJaxClass = 'equation';
    });
</script>
