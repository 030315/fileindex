$(document).ready(function() {
    console.log('ready...');
});

$(document).on('click', '.folder', function(e) {
    $('.dir_index').html('<ul>');
    var path = $(e.target).data('path');
    $.ajax({
        url: 'getfileindex.php',
        type: 'GET',
        dataType: 'JSON',
        data: {
            dir_path: path,
        },
        success: function(response) {
            $('.pwd').html(path);
            $.each(response, function(key, obj) {
                var i = null;
                var span = null;
                if (obj.type == 'directory') {
                    i = '<i class="fas fa-folder mr-1"></i>';
                    span = '<span><a href="#" class="folder" data-path="' + obj.path + '">' + obj.name + '</a></span>';
                } else {
                    i = '<i class="fas fa-file mr-1"></i>';
                    span = '<span><a href="' + obj.path + '" class="file" data-path="' + obj.path + '" download="' + obj.name + '">' + obj.name +'</a></span>';
                }

                var li = $('<li>').append(i + span);
                $('.dir_index').append(li);
            });
        }
    })
});

