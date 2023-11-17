<?php

namespace App\Http\Livewire\Charts;

use App\Models\NodeInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class FeatureWiseChartForNode extends Component
{
    public NodeInfo $nodeInfo;
    public function mount($node){
        $this->nodeInfo = $node;
    }

    public function render()
    {
        return view('livewire.charts.feature-wise-chart-for-node', [
            'charts' => $this->chart_generator()
        ]);
    }

    public function chart_generator(){
        $charts = [];
        foreach ($this->nodeInfo->features as $feature){
            switch ($feature->name) {
                case 'fms':
                    $data = $this->fms_data_maker($feature->data_table_name);
                    break;
                case 'cam':
                    $data = $this->fms_data_maker($feature->data_table_name);
                    break;
//                case 'fms':
//                    $charts[] = 'fms';
//                    break;
//                case 'fms':
//                    $charts[] = 'fms';
                    break;
                default:
            }

            if ($data != null) {
                $charts[] = [
                    'chart_id' => "fms_" . rand(11111, 99999),
                    'data' => $data
                ];
            }
        }
        return $charts;
    }

    public function fms_data_maker($data_table_name = null){
        if(!$data_table_name || !Schema::hasTable($data_table_name)){
            return null;
        }

        $results = DB::table($data_table_name)
            ->select('value', DB::raw('DATE_FORMAT(date_time, "%d %M %H:%i") as formatted_date_time'))
            ->orderBy('date_time', 'desc')
            ->take(10)
            ->get()
            ->toArray();

        // Separate values and formatted_date_time into arrays
        $values = array_column($results, 'value');
        $formatted_date_times = array_column($results, 'formatted_date_time');


        return [
            "chart" => ["type" => 'line', "zoomType" => "xy"],
            "title" => ["text" => $this->nodeInfo->name . " / fmc"],
            "subtitle" => ["text" => 'Source: AMPSD'],
            "credits" => ["enabled" => false],
            "xAxis" => [
                "title" => ["text"=> 'Date & Time'],
                "categories" => $formatted_date_times
            ],
            "yAxis" => [
                "title" => ["text"=> 'Latest 10 Values']
            ],
            "plotOptions" => [
                "line" => [
                    "dataLabels" => ["enabled" => true],
                    "enableMouseTracking" => false
                ]
            ],
            "series" => [
                [
                    "name" => 'Value',
                    "data" => $values
                ]
            ]
        ];
    }
}
