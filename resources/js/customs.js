$(document).ready(function() {
    $(function () {
        $("#upload-image").change(function () {
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview");
                dvPreview.html("");
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                $($(this)[0].files).each(function () {
                    var file = $(this);
                    if (regex.test(file[0].name.toLowerCase())) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var img = $("<img />");
                            img.attr("style", "height:100px;width: 100px");
                            img.attr("src", e.target.result);
                            dvPreview.append(img);
                        }
                        reader.readAsDataURL(file[0]);
                    } else {
                        alert(file[0].name + " is not a valid image file.");
                        dvPreview.html("");
                        return false;
                    }
                });
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.store-comment', function (event) {
        event.preventDefault();

        var url = '/comments';
        var _this = $(this);
        var postId = parseInt($(this).data('post_id'));
        var content = $(this).parent().find('.comment-content').val();
        if (content == '') {
            errorEmptyContent();
        } else {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'post_id': postId,
                    'content': content,
                },
                cache: false,

                success: function (result) {
                    if (result.status) {
                        _this.parent().parent().find('.comments-list').append(result.comment);
                        $('.comment-content').val('');
                    } else {
                        errorMessage();
                    }
                },
                error: function () {
                    errorMessage();
                }
            });
        }
    });
    $("#upload-avatar").on('change', function () {
        //Get count of selected files

        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var imgSize = $(this).get(0).files[0].size;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder-avatar");
        image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {
                if (imgSize < 2048000) {
                    //loop for each file selected for uploaded.
                    for (var i = 0; i < countFiles; i++) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("<img />", {
                                "src": e.target.result,
                                "class": "thumb-image"
                            }).appendTo(image_holder);
                        }
                        image_holder.show();
                        $('.btn-avatar').show();
                        reader.readAsDataURL($(this)[0].files[i]);
                    }
                } else {
                    errorImageSize();
                }
            }
        } else {
            errorImages();
        }
    });
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides1");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {
            myIndex = 1
        }
        x[myIndex - 1].style.display = "block";
        setTimeout(carousel, 3000);
    }

    var changed = false;

    $('.edit-post-form').change(function () {
        changed = true;
    });

    $('.edit-post-form').submit(function () {
        if (!changed && $('.edit-image-input').val() == "") {
            nothingChanges();

            return false;
        } else if ($(this).find('.edit-post-textarea').val() == '') {
            errorEmptyContent();

            return false;
        }
    });

    $('.edit-post-modal').on('shown.bs.modal', function () {
        var postId = $(this).data('post-id');

        var url = '/posts/' + postId + '/get-images';

        $.ajax({
            url: url,
            type: 'GET',
            cache: false,
            success: function (result) {
                if (result.html.length != 0) {
                    $('.edit-image-holder.post-' + postId).html(result.html);
                }
            },
            error: function () {
                errorMessage();
            }
        });
    });

    $('.edit-post-modal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');

        $('.remove-image').hide();

        $(this).find('.edit-image-holder').empty();

        $(this).find('.edit-image-input').val('');
    })


    $('body').on('change', '.edit-image-input', function (event) {
        event.preventDefault();

        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var imgSize = $(this).get(0).files[0].size;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var edit_image_holder = $(this).parent().parent().parent().parent().prev();

        edit_image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {
                if (imgSize < 2048000) {
                    //loop for each file selected for uploaded.
                    for (var i = 0; i < countFiles; i++) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("<img />", {
                                "src": e.target.result,
                                "class": "thumb-image"
                            }).appendTo(edit_image_holder);
                        }
                        reader.readAsDataURL($(this)[0].files[i]);
                    }
                    edit_image_holder.show();

                    $('.remove-image').show();
                } else {
                    errorImageSize();
                }

            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            errorImages();
        }
    });

    $('body').on('click', '.remove-image', function (event) {
        event.preventDefault();

        var postId = $(this).data('post-id');

        $('.edit-image.post-' + postId).html('');

        $('.edit-image-input').val('');

        $(this).hide();
    });

});
$(document).ready(function () {
    var notificationNumber = $('.notification-count');
    notificationCount = parseInt(notificationCount);

    if (notificationCount == 0) {
        notificationNumber.hide();
    } else {
        notificationNumber.text(notificationCount);
    }

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('fa969bf3e498362c0eab', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('fluffs' + '_' + currentUserId);
    channel.bind('notification-event', function() {
        if (notificationCount == 0) {
            notificationNumber.show();
        }

        notificationCount++;

        notificationNumber.text(notificationCount);
    });

    // Show notification
    $('.dropdown-notifications').on('show.bs.dropdown', function () {
        var url = 'notifications/show-notifications';

        $.ajax({
            url: url,
            type: 'GET',
            cache: false,
            success: function (result) {
                $('.notification-block').html('');
                $('.notification-block').append(result.html);
            },
            error: function () {
                errorMessage();
            }
        })
    });

    $('.mark-all-as-read').on('click', function (event) {
        event.preventDefault();
        var url = '/notifications/mark-all';

        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            success: function (result) {
                if (result.status) {
                    $('.notification-block').html('');
                    $('.notification-block').append(result.html);

                    notificationCount = 0;
                    notificationNumber.hide();
                }
            },
            error: function () {
                errorMessage();
            }
        });
    });
});
$(document).ready(function () {
    $('body').on('click', '.more-comments', function (event) {
        event.preventDefault();

        var postId = $(this).data('post-id');
        var page = $(this).data('page');

        loadMoreComment(postId, page);
    });

    function loadMoreComment(postId, page) {
        var url = '/comment/load-more?page=' + page;
        var data = {
            'post_id': postId,
        }
        $.ajax({
            url: url,
            type: 'GET',
            data: data,
            cache: false,
            success: function (result) {
                if (result.status) {
                    if (result.html.length != '') {
                        if (page == 1) {
                            $('.comments-list.post-' + postId).html(result.html);
                        } else {
                            console.log(result.html);
                            $('.comments-list.post-' + postId).prepend(result.html);
                        }
                    } else {
                        $('.more-comments.post-' + postId).remove();
                    }

                    $('.more-comments.post-' + postId).data('page', page + 1);
                    $('.more-comments.post-' + postId).attr('data-page', page + 1);
                } else {
                    errorMessage();
                }
            },
            error: function () {
                errorMessage();
            }
        });
    };
})
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click', '.btn-react-post-like', function () {
        event.preventDefault();

        var _this = $(this);
        var reactClass = '.like-post';
        var unReactClass = '.not-like-post';

        reactAjax(reactClass, unReactClass, _this);
    });
    function reactAjax(reactClass, unReactClass, reactElement) {
        var reactableId = parseInt(reactElement.data('post-id'));
        var react = reactElement.find(reactClass);
        var unReact = reactElement.find(unReactClass);

        $.ajax({
            url: '/likes',
            type: 'POST',
            data: {
                'likeable_id': reactableId
            },
            cache: false,
            success: function (result) {
                if (result.status) {
                    if (!unReact.attr('hidden')) {
                        unReact.attr('hidden', '');
                    } else {
                        unReact.removeAttr('hidden');
                    }

                    if (react.attr('hidden')) {
                        react.removeAttr('hidden');
                    } else {
                        react.attr('hidden', '');
                    }

                    if (result.count_react == 1) {
                        $('.react-this-post-' + reactableId).removeAttr('hidden');
                    } else if (result.count_react == 0) {
                        $('.react-this-post-' + reactableId).attr('hidden', '');
                    }

                    reactElement.parent().parent().find('.count-reacts').text(result.count_react);
                    userReact.html();
                    userReact.html(result.view);
                } else {
                    errorMessage();
                }
            },
            error: function () {
                errorMessage();
            }
        });
    }
})

$(document).ready(function () {
    $('.action-follow').click(function(){
        var user_id = $(this).data('id');
        var cObj = $(this);

        $.ajax({
            type:'POST',
            url:'/follow',
            data:{ user_id: user_id },
            success: function (data) {
                successFollow();
            },
            error: function () {
                errorMessage();
            }
        });
    });
});

$(document).ready(function () {
    $('.search-people-result').hide();

    $('.search-people-input').on('keyup', function () {
        var inputString = $(this).val();
        if (inputString) {
            var url = '/search?name=' + inputString;

            $.ajax({
                url: url,
                type: 'GET',
                cache: false,
                success: function (result) {
                    if (result.count > 0) {
                        var resultDropdown = $('.search-people-result');

                        resultDropdown.show();
                        resultDropdown.html(result.html);
                    } else {
                        $('.search-people-result').hide();
                    }
                },
                error: function () {
                    errorMessage();
                }
            });
        } else {
            $('.search-people-result').hide();
        }
    });
})