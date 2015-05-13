<script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/pace.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/retina.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.cookies.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/jquery.autogrow-textarea.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.mousewheel.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.tagsinput.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toggles.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-timepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/colorpicker.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dropzone.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/codemirror/codemirror.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/codemirror/formatting.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/codemirror/mode/xml.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/codemirror/mode/javascript.js'); ?>"></script>
<script>
    jQuery(document).ready(function () {

        // Tags Input
        jQuery('#tags').tagsInput({width: 'auto'});

        // Textarea Autogrow
        jQuery('#autoResizeTA').autogrow();

        // Spinner
        var spinner = jQuery('#spinner').spinner();
        spinner.spinner('value', 0);

        // Form Toggles
        jQuery('.toggle').toggles({on: true});

        // Time Picker
        jQuery('#timepicker').timepicker({defaultTIme: false});
        jQuery('#timepicker2').timepicker({showMeridian: false});
        jQuery('#timepicker3').timepicker({minuteStep: 15});

        // Date Picker
        jQuery('#datepicker').datepicker();
        jQuery('#datepicker-inline').datepicker();
        jQuery('#datepicker-multiple').datepicker({
            numberOfMonths: 3,
            showButtonPanel: true
        });

        // Input Masks
        jQuery("#date").mask("99/99/9999");
        jQuery("#phone").mask("(999) 999-9999");
        jQuery("#ssn").mask("999-99-9999");

        // Select2
        jQuery("#select-basic, #select-multi").select2();
        jQuery('#select-search-hide').select2({
            minimumResultsForSearch: -1
        });

        function format(item) {
            return '<i class="fa ' + ((item.element[0].getAttribute('rel') === undefined) ? "" : item.element[0].getAttribute('rel') ) + ' mr10"></i>' + item.text;
        }

        // This will empty first option in select to enable placeholder
        jQuery('select option:first-child').text('');

        jQuery("#select-templating").select2({
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function (m) {
                return m;
            }
        });

        // Color Picker
        if (jQuery('#colorpicker').length > 0) {
            jQuery('#colorSelector').ColorPicker({
                onShow: function (colpkr) {
                    jQuery(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function (colpkr) {
                    jQuery(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
                    jQuery('#colorpicker').val('#' + hex);
                }
            });
        }

        // Color Picker Flat Mode
        jQuery('#colorpickerholder').ColorPicker({
            flat: true,
            onChange: function (hsb, hex, rgb) {
                jQuery('#colorpicker3').val('#' + hex);
            }
        });


    });
</script>
<script>

    CodeMirror.fromTextArea(document.getElementById("code"), {
        mode: {name: "xml", alignCDATA: true},
        lineNumbers: true
    });

    CodeMirror.fromTextArea(document.getElementById("code2"), {
        mode: {name: "javascript"},
        lineNumbers: true,
        theme: 'ambiance'
    });

    var editor = CodeMirror.fromTextArea(document.getElementById("code3"), {
        mode: {name: "javascript"},
        lineNumbers: true,
    });
    CodeMirror.commands["selectAll"](editor);

    function getSelectedRange() {
        return {from: editor.getCursor(true), to: editor.getCursor(false)};
    }

    function autoFormatSelection() {
        var range = getSelectedRange();
        editor.autoFormatRange(range.from, range.to);
    }

    function commentSelection(isComment) {
        var range = getSelectedRange();
        editor.commentRange(isComment, range.from, range.to);
    }

    jQuery(document).ready(function () {

        jQuery('.autoformat').click(function () {
            autoFormatSelection();
        });

        jQuery('.comment').click(function () {
            commentSelection(true);
        });

        jQuery('.uncomment').click(function () {
            commentSelection(false);
        });

    });

</script>

</body>
</html>
