<div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <div class="row g-3 mb-3">
        @foreach($nodes as $node)
            @livewire('charts.feature-wise-chart-for-node', ['node' => $node])
        @endforeach

        {{--    @foreach($nodes as $node)--}}
        {{--    <div class="col-md-6">--}}
        {{--        <div class="card text-start">--}}
        {{--            @livewire('charts.chart_1', ['id' => $node->node_id, 'name' => $node->name])--}}
        {{--        </div>--}}
        {{--    </div>--}}
        {{--    @endforeach--}}
        {{--    <div class="col-md-6">--}}
        {{--        <div class="card text-start">--}}
        {{--            @livewire('charts.chart_2')--}}
        {{--        </div>--}}
        {{--    </div>--}}
    </div>
</div>
