jQuery(document).ready(function($) {
    // Initialize jQuery UI tabs
    $('.ssl-settings-tabs').tabs();

    // Handle form submission
    $('#ssl-settings').on('submit', function(e) {
        e.preventDefault();

        var $form = $(this);
        var $responseWrap = $('.response-wrap');
        
        // Get toggle elements
        var $demoImportCheckbox = $form.find('input[name="ssl_disable_demo_import"]');
        var $discountWidgetCheckbox = $form.find('input[name="ssl_disable_discount_widget"]');
        
        // Get toggle states
        var demoImport = $demoImportCheckbox.is(':checked') ? 1 : 0;
        var discountWidget = $discountWidgetCheckbox.is(':checked') ? 1 : 0;

        $.ajax({
            url: ssl_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'ssl_save_settings',
                nonce: ssl_ajax_object.nonce,
                ssl_disable_demo_import: demoImport,
                ssl_disable_discount_widget: discountWidget
            },
            success: function(response) {
                if (response.success) {
                    $responseWrap.html(
                        $('<div>')
                            .addClass('notice notice-success is-dismissible')
                            .append($('<p>').text(response.data.message))
                    );
                } else {
                    $responseWrap.html(
                        $('<div>')
                            .addClass('notice notice-error is-dismissible')
                            .append($('<p>').text(response.data.message || 'An error occurred while saving settings'))
                    );
                }
            },
            error: function(xhr, status, error) {
                var errorMessage = 'An error occurred while saving settings';
                if (xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message) {
                    errorMessage = xhr.responseJSON.data.message;
                } else if (xhr.responseText) {
                    errorMessage += ': ' + xhr.responseText.substring(0, 100); // Truncate for safety
                }
                $responseWrap.html(
                    $('<div>')
                        .addClass('notice notice-error is-dismissible')
                        .append($('<p>').text(errorMessage))
                );
            },
            complete: function(xhr) {
                console.log('AJAX request completed, raw response:', xhr.responseText);
            }
        });
    });
});