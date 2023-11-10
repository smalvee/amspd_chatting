<div class="row">
    @foreach($charts as $chart)
        <div class="col-md-6">
            <div class="card text-start">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="{{ $chart['chart_id'] }}"></div>
                        <p class="highcharts-description">
                            This chart shows how data labels can ......</p>
                    </figure>

                    <script>
                        Highcharts.chart("{{ $chart['chart_id'] }}", {!! collect($chart['data']) !!});
                    </script>
                </div>
            </div>
        </div>
    @endforeach
</div>
