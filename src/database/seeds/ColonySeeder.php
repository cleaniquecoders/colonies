<?php

use CleaniqueCoders\Colonies\Models\District;
use CleaniqueCoders\Colonies\Models\Dun;
use CleaniqueCoders\Colonies\Models\Parliament;
use CleaniqueCoders\Colonies\Models\State;
use CleaniqueCoders\Colonies\Models\SubDistrict;
use Illuminate\Database\Seeder;

class ColonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::truncate();
        District::truncate();
        SubDistrict::truncate();
        Parliament::truncate();
        Dun::truncate();

        $colonies = json_decode(file_get_contents(__DIR__ . '/colony.json'));

        foreach ($colonies as $colony) {
            $state = State::create([
                'name' => $colony->name,
                'name_long' => $colony->name_long,
                'code2' => $colony->code2,
                'code3' => $colony->code3,
                'capital' => $colony->capital,
            ]);
            $this->command->info('State: ' . $state->name);

            // handle parliament and duns
            if (!empty($colony->parliaments)) {
                foreach ($colony->parliaments as $parliament) {
                    $p = Parliament::create([
                        'state_id' => $state->id,
                        'name' => $parliament->name,
                        'code' => $parliament->code,
                    ]);

                    if (!empty($parliament->duns)) {
                        foreach ($parliament->duns as $dun) {
                            $d = Dun::create([
                                'parliament_id' => $p->id,
                                'state_id' => $state->id,
                                'name' => $dun->name,
                                'code' => $dun->code,
                            ]);
                            $this->command->info('DUN: ' . $dun->name);
                        }
                    }
                }
            }

            // handle districts and sub-districts
            if (!empty($colony->districts)) {
                foreach ($colony->districts as $district) {
                    $dist = District::create([
                        'state_id' => $state->id,
                        'name' => $district->name,
                    ]);
                    $this->command->info('State: ' . $state->name . ', District: ' . $dist->name);
                    if (!empty($district->subdistricts)) {
                        foreach ($district->subdistricts as $subdistrict) {
                            $sd = SubDistrict::create([
                                'district_id' => $dist->id,
                                'name' => $subdistrict->name,
                            ]);
                            $this->command->info('State: ' . $state->name . ', District: ' . $dist->name, ', SubDistrict: ' . $sd->name);
                        }
                    }
                }
            }
        }
    }
}
