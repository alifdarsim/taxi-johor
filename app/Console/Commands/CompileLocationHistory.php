<?php

namespace App\Console\Commands;

use App\Helpers\Geo;
use App\Models\Location;
use App\Models\LocationData;
use App\Models\LocationHistory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class CompileLocationHistory extends Command
{
    protected $signature = 'app:compile-location-history {--plate= : The number plate to compile data for} {--date= : The date to compile data for (format: Y-m-d)}';

    protected $description = 'Compile location history for every not yet compiled location data';

    public string $compileDate;
    public string $numberPlate;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->compileDate = $this->option('date') ? Carbon::parse($this->option('date'))->toDateString() : Carbon::yesterday()->toDateString();

        // Compile location history for a specific number plate
        if ($this->option('plate')) {
            $this->numberPlate = $this->option('plate');
            $this->compileLocationHistoryWithPlateNumber($this->numberPlate, $this->compileDate);
            return;
        }
        // Compile location history for all number plates
        $this->compileAllLocationHistory();
    }

    public function testHandle()
    {
//        $this->compileDate = $this->option('date') ? Carbon::parse($this->option('date'))->toDateString() : Carbon::yesterday()->toDateString();
//
//        // Compile location history for a specific number plate
//        if ($this->option('plate')) {
//            $this->numberPlate = $this->option('plate');
//            $this->compileLocationHistoryWithPlateNumber($this->numberPlate, $this->compileDate);
//            return;
//        }
        // Compile location history for all number plates
        return $this->compileAllLocationHistory();
    }

    public function compileLocationHistoryWithPlateNumber($locations, $numberPlate, $locationDate)
    {
        // get every session value
        $sessions = $locations->pluck('session')->unique()->values()->toArray();
        $data = [];
        foreach ($sessions as $session) {
            // check if there is same session in the locationHistory
            $locationHistory = LocationHistory::where('session', $session)->exists();

            // get location_data
            $locations_data = $locations->where('session', $session)->values();
            $locations_data = Geo::setDataCollection($locations_data);
            if ($locationHistory) {
                // get the data from LocationData
                $old_locations = LocationData::where('session', $session)->first()->data;
                $locations_data = array_merge($old_locations, $locations_data);
                // sort again the data
                $locations_data = collect($locations_data)->sortBy('timestamp')->values()->toArray();
                // update the data to LocationData
                LocationData::where('session', $session)->update(['data' => $locations_data]);
            }
            else{
                // store _data to LocationData
                LocationData::create([
                    'session' => $session,
                    'data' => $locations_data,
                ]);
            }

            $totalDistance = Geo::getDistanceTravelled($locations_data);

            $averageSpeed = Geo::getAverageSpeed($locations_data);

            $data[] = [
                'location_date' => $locationDate,
                'number_plate' => $numberPlate,
                'session' => $session,
                'start_time' => $locations_data[0]['timestamp'],
                'end_time' => $locations_data[count($locations_data)-1]['timestamp'],
                'total_distance' => $totalDistance,
                'average_speed' => $averageSpeed,
                'data_count' => count($locations_data),
            ];


        }

        // Update the compiled status
        Location::whereIn('id', $locations->pluck('id')->values()->toArray())->update(['processed' => true]);

        // Insert into LocationHistory if not exists else update
        LocationHistory::upsert($data, uniqueBy: ['number_plate','session','location_date'], update: ['location_date', 'number_plate', 'session', 'start_time', 'end_time', 'total_distance', 'average_speed', 'data_count']);

        // Output
        if (!is_null($this->getApplication())) {
            $this->info('Updated ' . count($data) . ' sessions for ' . $numberPlate);
            $this->info('Inserted ' . count($data) . ' sessions for ' . $numberPlate);
        }
        else {
            echo 'Updated ' . count($data) . ' sessions for ' . $numberPlate . PHP_EOL;
            echo '<br>';
            echo 'Inserted ' . count($data) . ' sessions for ' . $numberPlate . PHP_EOL;
            echo '<br>';
            echo '<br>';
        }
    }



    public function getUnprocessedData(): Collection
    {
        return Location::where('processed', false)->get();
    }

    public function compileAllLocationHistory()
    {
        $locations_to_compile = Location::select('id','number_plate', 'coordinate', 'timestamp', 'speed', 'accuracy', 'location_date', 'session')
            ->orderBy('timestamp')
            ->where('processed', false)
            ->get();

        $sessions = $locations_to_compile->groupBy('session');

        foreach ($sessions as $session => $data) {
            // number plate for each session is the same
            $numberPlate = $data->first()->number_plate;
            // location date for each session is the same
            $first_date = $data->first()->location_date;
            // compile location history
            $this->compileLocationHistoryWithPlateNumber($data, $numberPlate, $first_date);
        }

    }

}
