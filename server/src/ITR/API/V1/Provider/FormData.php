<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 11:53
 */

namespace ITR\API\V1\Provider;

use ITR\Base\IResource;
use ITR\Base\IResourceRequest;


class FormData implements IResource
{

    public function Serve(IResourceRequest $data): array
    {

        return [
            'countries' => $this->load_data('countries'),
            'activities' => $this->load_data('activities'),
            'articles' => $this->load_data('articles_reading'),
            'employee_reviews' => $this->load_data('employee_reviews'),
            'freeTimeHabits' => $this->load_data('free_time_habits'),
            'levels' => $this->load_data('job_levels'),
            'positions' => $this->load_data('job_positions'),
            'mentor' => $this->load_data('mentor'),
            'otherEdu' => $this->load_data('other_educations'),
            'polishDistricts' => $this->load_data('polish_districts'),
            'schools' => $this->load_data('schools'),
            'studies' => $this->load_data('studies'),
            'tdd' => $this->load_data('tdd'),
            'tech' => $this->load_data('tech_and_schools'),
            'timesWithComputer' => $this->makeData('timesWithComputer'),
            'jobExperience' => $this->makeData('jobExperience'),
            'sallaries' => $this->makeData('sallaries')
        ];
    }

    private function load_data(string $string)
    {
        $path = APPDIR . '/form_data/' . $string . '.json';
        if (!file_exists($path)) {
            return [];
        }
        return \json_decode(\file_get_contents($path));
    }

    private function makeData(string $funname)
    {
        if (!is_callable(array($this, $funname))) {
            return [];
        }
        return $this->{$funname}();
    }

    private function timesWithComputer()
    {
        $times = [];
        for ($i = 0; $i <= 20; $i += 3) {
            $times[] = $i . ' - ' . ($i + 2) . ' h';
        }
        return $times;
    }

    private function jobExperience()
    {
        $times = [];
        for ($i = 0; $i <= 27; $i += 3) {
            $times[] = $i . ' - ' . ($i + 2) . ' lat';
        }
        $times[] = '30+';
        return $times;
    }

    private function sallaries()
    {
        $times = [];
        $dt = 1000;
        for ($i = 500; $i <= 60000; $i += $dt) {
            $times[] = $i . ' - ' . ($i + $dt - 1) . ' zł';
        }
        $times[] = 'Ponad 60k zł';
        return $times;
    }
}