jQuery(function($){
    var frame;
    var currentUrlField;
    var container = $('#kermancopper-ad-excel-forms');
    var index = parseInt(container.data('index'), 10) || 0;
    var strings = window.kermancopperAdsAdmin || {};
    function openMedia(){
        if (frame) {
            frame.open();
            return;
        }
        frame = wp.media({
            title: strings.mediaTitle || '',
            button: { text: strings.mediaButton || '' },
            multiple: false
        });
        frame.on('select', function(){
            var attachment = frame.state().get('selection').first().toJSON();
            if (currentUrlField) {
                currentUrlField.val(attachment.url);
            }
        });
        frame.open();
    }
    function buildRow(rowIndex){
        var row = $('<div class="kermancopper-ad-excel-row">\
            <div>\
                <label class="kermancopper-ad-excel-label">' + (strings.formNameLabel || '') + '</label>\
                <input type="text" name="kermancopper_ad_excel_forms[' + rowIndex + '][name]" class="widefat kermancopper-ad-excel-name" placeholder="' + (strings.formNamePlaceholder || '') + '" value="" />\
            </div>\
            <div>\
                <label class="kermancopper-ad-excel-label">' + (strings.formFileLabel || '') + '</label>\
                <div class="kermancopper-ad-excel-row-actions">\
                    <input type="text" name="kermancopper_ad_excel_forms[' + rowIndex + '][url]" class="widefat kermancopper-ad-excel-url" readonly value="" />\
                    <div class="kermancopper-ad-excel-buttons">\
                        <button type="button" class="button kermancopper-ad-excel-select">' + (strings.selectFileText || '') + '</button>\
                        <button type="button" class="button kermancopper-ad-excel-remove">' + (strings.removeText || '') + '</button>\
                    </div>\
                </div>\
            </div>\
        </div>');
        return row;
    }
    $('#kermancopper_ad_excel_add').on('click', function(e){
        e.preventDefault();
        container.append(buildRow(index));
        index++;
        container.data('index', index);
    });
    container.on('click', '.kermancopper-ad-excel-select', function(e){
        e.preventDefault();
        currentUrlField = $(this).closest('.kermancopper-ad-excel-row').find('.kermancopper-ad-excel-url');
        openMedia();
    });
    container.on('click', '.kermancopper-ad-excel-remove', function(e){
        e.preventDefault();
        $(this).closest('.kermancopper-ad-excel-row').remove();
    });
    if (window.jalaliDatepicker) {
        window.jalaliDatepicker.startWatch();
    }
    var drawer = $('#kermancopper-requests-drawer');
    if (drawer.length) {
        var drawerBody = drawer.find('.kermancopper-requests-drawer-body');
        function closeDrawer() {
            drawer.removeClass('is-open').attr('aria-hidden', 'true');
        }
        function openDrawer(requestId, row) {
            drawerBody.html('<div class="kermancopper-requests-loading">در حال بارگذاری...</div>');
            drawer.addClass('is-open').attr('aria-hidden', 'false');
            $.post(strings.ajaxUrl, {
                action: 'kermancopper_ad_request_detail',
                request_id: requestId,
                nonce: strings.requestNonce
            }).done(function(response){
                if (response && response.success && response.data && response.data.html) {
                    drawerBody.html(response.data.html);
                    if (row) {
                        row.removeClass('kermancopper-requests-new');
                    }
                    var badge = $('#adminmenu a[href="edit.php?post_type=kermancopper_ad&page=kermancopper-ad-requests"] .update-plugins .plugin-count');
                    if (badge.length) {
                        var count = parseInt(badge.text(), 10) || 0;
                        if (count > 0) {
                            badge.text(count - 1);
                        }
                    }
                } else {
                    drawerBody.html('<div class="kermancopper-requests-empty">جزئیات در دسترس نیست.</div>');
                }
            }).fail(function(){
                drawerBody.html('<div class="kermancopper-requests-empty">جزئیات در دسترس نیست.</div>');
            });
        }
        $(document).on('click', '.kermancopper-requests-open', function(){
            var requestId = $(this).data('request-id');
            var row = $(this).closest('tr');
            if (requestId) {
                openDrawer(requestId, row);
            }
        });
        drawer.on('click', '.kermancopper-requests-drawer-backdrop, .kermancopper-requests-drawer-close', function(){
            closeDrawer();
        });
    }
});
