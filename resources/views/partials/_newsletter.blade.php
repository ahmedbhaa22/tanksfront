<div class="container">
    <h3 class="white-txt text-center">
        {{__('_newsletter.special_offers')}}
    </h3>
    {{--<h5 class="white-txt text-center">--}}
        {{--{{__('_newsletter.special_offers')}}--}}
    {{--</h5>--}}
    <div class="text-center news-letter-div">
        <div class="news-letter">
            <form method="post" id="newsletter-form">
                <input value="" name="email" id="newsletter-email" type="email" placeholder="{{__('_newsletter.enter_email')}}" />
                <a href="#" class="cstm-subscribe-btn add-newsletter">
                    {{__('_newsletter.register')}}
                </a>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="newsletterModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('_newsletter.close')}}</button>
            </div>
        </div>

    </div>
</div>

<script>
    $(function () {
        $(".add-newsletter").click(function (e) {
           e.preventDefault();
            e.stopPropagation();

            var html = '';
            $.ajax({
                url: base_url+"/newsletter",
                data: {_token: '{{csrf_token()}}', email: $("#newsletter-email").val()},
                type: "POST",
                dataType: "json",
                success: function (res) {
                    var json = res;
                    if(json['status'] == 0) {
                        html += '<h3 style="color: #000">'+json['message']+'</h3>';
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
                    $("#newsletterModal").find(".modal-body").html(html);
                    $("#newsletterModal").modal("show");
                },
                error: function () {
                    console.log("ajax error!");
                }
            });
        });
    });
</script>