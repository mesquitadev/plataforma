@php
    $marketing_tools = getContent('marketing_tool.element');
@endphp
@if($marketing_tools)

    <section class="feature-section padding-top padding-bottom">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                @foreach($marketing_tools as $marketing_tool)
                    <div class="col-xl-12">
                        <div class="feature-item">
                            <div class="feature-header">
                                <div class="icon">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <h6 class="title">{{ __(@$marketing_tool->data_values->title) }}</h6>
                            </div>
                            <div class="feature-body">
                                <p>@php echo @$marketing_tool->data_values->description; @endphp</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


@endif
