jQuery(document).ready(function($) {
    $('.kermancopper-repeater-container').each(function() {
        var $container = $(this);
        var $itemsList = $container.find('.kermancopper-repeater-items');
        var $addButton = $container.find('.kermancopper-repeater-add');
        var $hiddenInput = $container.find('.kermancopper-repeater-value');
        var fieldsRaw = $container.attr('data-fields');
        var fields = fieldsRaw ? JSON.parse(fieldsRaw) : {};

        function updateValue() {
            var data = [];
            $itemsList.find('.kermancopper-repeater-item').each(function() {
                var itemData = {};
                $(this).find('input[data-field], textarea[data-field]').each(function() {
                    itemData[$(this).attr('data-field')] = $(this).val();
                });
                data.push(itemData);
            });
            $hiddenInput.val(JSON.stringify(data)).trigger('change');
        }

        function createItem() {
            var $item = $('<li class="kermancopper-repeater-item"></li>');
            var $header = $('<div class="kermancopper-repeater-item-header"><span class="dashicons dashicons-menu"></span><span class="kermancopper-repeater-item-title">آیتم جدید</span><button type="button" class="kermancopper-repeater-item-remove"><span class="dashicons dashicons-no-alt"></span></button></div>');
            var $content = $('<div class="kermancopper-repeater-item-content"></div>');
            
            $.each(fields, function(key, args) {
                var $fieldContainer = $('<div class="kermancopper-repeater-field"></div>');
                $fieldContainer.append('<label>' + args.label + '</label>');
                if (args.type === 'textarea') {
                    $fieldContainer.append('<textarea data-field="' + key + '"></textarea>');
                } else {
                    $fieldContainer.append('<input type="text" data-field="' + key + '" value="" />');
                }
                $content.append($fieldContainer);
            });

            $item.append($header).append($content);
            return $item;
        }

        $addButton.on('click', function() {
            var $newItem = createItem();
            $itemsList.append($newItem);
            updateValue();
        });

        $itemsList.on('click', '.kermancopper-repeater-item-remove', function() {
            $(this).closest('.kermancopper-repeater-item').remove();
            updateValue();
        });

        $itemsList.on('click', '.kermancopper-repeater-item-header', function(e) {
            if ($(e.target).closest('.kermancopper-repeater-item-remove').length) return;
            $(this).siblings('.kermancopper-repeater-item-content').slideToggle();
        });

        $itemsList.on('keyup change', 'input, textarea', function() {
            updateValue();
        });

        // Simple sortable using jQuery UI Sortable which is included in WP Customizer
        if (typeof $.fn.sortable !== 'undefined') {
            $itemsList.sortable({
                handle: '.dashicons-menu',
                update: function() {
                    updateValue();
                }
            });
        }
    });
});
