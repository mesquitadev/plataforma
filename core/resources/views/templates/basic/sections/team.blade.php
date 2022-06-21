@php

    $teamTitle = getContent('team.content', true);
    $teams = getContent('team.element');
@endphp


<section class="team-section padding-top padding-bottom section-bg">
    <div class="container">
        <div class="section-header">
            <h2 class="title">@lang(@$teamTitle->data_values->heading)</h2>
            <p>@lang(@$teamTitle->data_values->sub_heading)</p>
        </div>
        <div class="row justify-content-center mb-30-none">
            @foreach($teams as $team)
                <div class="col-lg-3 col-md-6 col-sm-9">
                    <div class="team-item">
                        <div class="team-thumb">
                            <img src="{{ getImage('assets/images/frontend/team/'. @$team->data_values->image, '524x614') }}" alt="team">
                        </div>
                        <div class="team-content">
                            <h6 class="title">
                                @lang(@$team->data_values->name)
                            </h6>
                            <span class="info">{{@$team->data_values->designation}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



