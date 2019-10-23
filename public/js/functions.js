var get_offers_by_region = (function (region_id) {
    $("#offers-block").html('');
    $.ajax({
            url: base_url + "/store/offers",
            data: {region_id: region_id},
            type: "GET",
            success: function (res) {
                if(res) {
                    $("#offers-block").html(res);
                }
            },
            error: function () {
                console.log("offers ajax error");
            }
    });
});

var add_to_cart = (function(item_id, item_type, count, delivery_place, csrf_token) {
    var html = '';
    $.ajax({
        url: base_url+"/store/add-to-cart",
        data: {_token: csrf_token, item_id: item_id, item_type: item_type, delivery_place: delivery_place, count: count},
        type: "POST",
        dataType: "json",
        headers: {token: csrf_token},
        success: function (res) {
            // var json = $.parseJSON(res);
            var json = res;
            if(json['status'] == 0) {
                html += '<h3>'+json['message']+'</h3>';
                html += '<div class="alert alert-danger alert-dismissable"><ul>';
                if(json['errors']) {
                    $.each(json['errors'], function (i, t) {
                        html += '<li>' + t + '</li>';
                    });
                }
                html += '</ul></div>';
            }else if(json['status'] == 1) {
                html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
                if(item_type==1){
                    window.location.href = base_url + '/store/product-details/'+item_id+'/'+item_id
                }else{
                    window.location.href = base_url + '/store/offer-details/'+item_id+'/'+item_id

                }

            }
            $("#addToCartModal").find(".modal-body").html(html);
            $("#addToCartModal").modal("show");
        },
        error: function () {
            console.log("ajax error!");
        }
    });
});

var remove_from_cart = (function(item_id, item_type, csrf_token) {
    var html = '';
    $.ajax({
        url: base_url+"/store/remove-from-cart",
        data: {_token: csrf_token, item_id: item_id, item_type: item_type},
        type: "POST",
        dataType: "json",
        headers: {token: csrf_token},
        success: function (res) {
            var json = res;
            if(json['status'] == 0) {
                html += '<h3>'+json['message']+'</h3>';
                html += '<div class="alert alert-danger alert-dismissable"><ul>';
                if(json['errors']) {
                    $.each(json['errors'], function (i, t) {
                        html += '<li>' + t + '</li>';
                    });
                }
                html += '</ul></div>';
            }else if(json['status'] == 1) {
                html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
            }
            window.location.href = base_url+"/store/shopping-cart";
            $("#removeFromCartModal").find(".modal-body").html(html);
            $("#removeFromCartModal").modal("show");
        },
        error: function () {
            console.log("ajax error!");
        }
    });
});

var add_to_wish_List = (function(item_id, item_type, csrf_token) {
    var html = '';
    $.ajax({
        url: base_url+"/store/add-to-wish-list",
        data: {_token: csrf_token, item_id: item_id, item_type: item_type},
        type: "POST",
        dataType: "json",
        headers: {token: csrf_token},
        success: function (res) {
            // var json = $.parseJSON(res);
            var json = res;
            if(json['status'] == 0) {
                html += '<h3>'+json['message']+'</h3>';
                html += '<div class="alert alert-danger alert-dismissable"><ul>';
                if(json['errors']) {
                    $.each(json['errors'], function (i, t) {
                        html += '<li>' + t + '</li>';
                    });
                }
                html += '</ul></div>';
            }else if(json['status'] == 1) {
                html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
                window.location.href = base_url + '/store/product-details/' + item_id +'/' + item_id;
            }
            $("#addToWishListModal").find(".modal-body").html(html);
            $("#addToWishListModal").modal("show");
        },
        error: function () {
            console.log("ajax error!");
        }
    });
});

var delete_shipping_address = (function (item_id, csrf_token) {
    var html = '';
    $("#st_msg").html("");

    $.ajax({
        url: base_url+"/delete-shipping-address",
        data: {_token: csrf_token, item_id: item_id},
        type: "DELETE",
        dataType: "json",
        headers: {token: csrf_token},
        success: function (res) {
            // var json = $.parseJSON(res);
            var json = res;
            if(json['status'] == 0) {
                html += '<h3>'+json['message']+'</h3>';
                html += '<div class="alert alert-danger alert-dismissable"><ul>';
                if(json['errors']) {
                    $.each(json['errors'], function (i, t) {
                        html += '<li>' + t + '</li>';
                    });
                }
                html += '</ul></div>';
            }else if(json['status'] == 1) {
                html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
                $("#item"+item_id).remove();
            }
            $("#st_msg").html(html);
        },
        error: function () {
            console.log("ajax error!");
        }
    });
});

//var set_main_shipping_address = (function (item_id, csrf_token) {
//    var html = '';
//    $("#st_msg").html("");
//
//    return $.ajax({
//        url: base_url+"/set-main-shipping-address",
//        data: {_token: csrf_token, item_id: item_id},
//        type: "POST",
//        dataType: "json",
//        headers: {token: csrf_token}
//        //success: function (res) {
//        //    // var json = $.parseJSON(res);
//        //    var json = res;
//        //    if(json['status'] == 0) {
//        //        html += '<h3>'+json['message']+'</h3>';
//        //        html += '<div class="alert alert-danger alert-dismissable"><ul>';
//        //        if(json['errors']) {
//        //            $.each(json['errors'], function (i, t) {
//        //                html += '<li>' + t + '</li>';
//        //            });
//        //        }
//        //        html += '</ul></div>';
//        //    }else if(json['status'] == 1) {
//        //        window.location.href = base_url+'/shipping-addresses';
//        //        html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
//        //    }
//        //    $("#st_msg").html(html);
//        //},
//        //error: function () {
//        //    console.log("ajax error!");
//        //}
//    });
//});

var compare_product = (function(item_id, csrf_token) {
    var html = '';
    $.ajax({
        url: base_url+"/store/post-compare-product",
        data: {_token: csrf_token, item_id: item_id},
        type: "POST",
        dataType: "json",
        headers: {token: csrf_token},
        success: function (res) {
            // var json = $.parseJSON(res);
            var json = res;
            if(json['status'] == 0) {
                html += '<h3>'+json['message']+'</h3>';
                html += '<div class="alert alert-danger alert-dismissable"><ul>';
                if(json['errors']) {
                    $.each(json['errors'], function (i, t) {
                        html += '<li>' + t + '</li>';
                    });
                }
                html += '</ul></div>';
            }else if(json['status'] == 1) {
                html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
            }
            $("#compareModal").find(".modal-body").html(html);
            $("#compareModal").modal("show");
        },
        error: function () {
            console.log("ajax error!");
        }
    });
});

var remove_compared = (function(item_id, csrf_token) {
    var html = '';
    $.ajax({
        url: base_url+"/store/remove-compare-product",
        data: {_token: csrf_token, item_id: item_id},
        type: "DELETE",
        dataType: "json",
        headers: {token: csrf_token},
        success: function (res) {
            // var json = $.parseJSON(res);
            var json = res;
            if(json['status'] == 0) {
                html += '<h3>'+json['message']+'</h3>';
                html += '<div class="alert alert-danger alert-dismissable"><ul>';
                if(json['errors']) {
                    $.each(json['errors'], function (i, t) {
                        html += '<li>' + t + '</li>';
                    });
                }
                html += '</ul></div>';
            }else if(json['status'] == 1) {
                html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
            }
            $("#compareModal").find(".modal-body").html(html);
            $("#compareModal").modal("show");
        },
        error: function () {
            console.log("ajax error!");
        }
    });
});