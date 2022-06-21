@php
    $subscribe = getContent('subscribe.content', true);
@endphp

<section id="subscribe" class="subscribe-section padding-top padding-bottom bg-overlay bg_img bg_fixed"
         data-background="{{getImage('assets/images/frontend/subscribe/' . @$subscribe->data_values->background_image, '1920x475')}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="subscribe-content">
                    <h4 class="title">@lang(@$subscribe->data_values->heading)</h4>
                    <form class="subscribe-form" method="post" action="{{route('subscriber.store')}}">
                        @csrf
                        <input type="email" name="email"  placeholder="@lang('Enter Your email address')" required>
                        <button type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
