@extends($activeTemplate.'layouts.master')

@section('content')

    @include($activeTemplate.'layouts.breadcrumb')


    <section class="blog-section padding-bottom padding-top">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between">
                <div class="col-lg-12">
                    <div class="post-item post-details">

                        <div class="post-content">
                            <div class="entry-content">
                                <p>@php echo $terms->data_values->description; @endphp</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection






