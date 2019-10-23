<div class="modal fade" id="addToCartModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">اغلق</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="removeFromCartModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">اغلق</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="addToWishListModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">اغلق</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="compareModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">اغلق</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="check-visit" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">طلب زيارة فحص</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="">تاريخ الزيارة</label>
                        <input type="date" class="form-control" id="">
                    </div>

                    <div class="form-group  float-label-control">
                        <label for="name">الاسم</label>
                        <input type="text" class="form-control" id="name">
                    </div>

                    <div class="form-group  float-label-control">
                        <label for="mobile">رقم الموبيل</label>
                        <input type="tel" class="form-control" id="mobile">
                    </div>

                    <div class="form-group  float-label-control">
                        <label for="visit">الزيارة</label>
                        <input type="text" class="form-control" id="visit">
                    </div>
                    <button class="btn  btn-block-blue col-xs-12 no-padding">
                        طلب
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">اغلق</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ratingModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

                <div class="form-group">
                    <label for="" class="pull-left col-xs-12 no-padding">تقييمك</label>
                    <div class="clearfix"></div>
                    <span id="err-span" hidden style="color: red;">من فضلك أدخل التقييم</span>
                    <fieldset class="rating">
                        <input class="start-rating" type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                        {{--<input class="start-rating" type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>--}}
                        <input class="start-rating" type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                        {{--<input class="start-rating" type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>--}}
                        <input class="start-rating" type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                        {{--<input class="start-rating" type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>--}}
                        <input class="start-rating" type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                        {{--<input class="start-rating" type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>--}}
                        <input class="start-rating" type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                        {{--<input class="start-rating" type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>--}}
                    </fieldset>
                </div>
                <div class="clearfix"></div>
                <div class="form-group  float-label-control">
                    <label for="comment">تعليقك</label>
                    <textarea name="user_comment" class="form-control" id="comment"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit-review-btn" class="btn btn-success" data-dismiss="modal">حفظ</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">اغلق</button>
            </div>
        </div>

    </div>
</div>