<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 11:53
 */

namespace ITR\API\V1\Provider;

use ITR\Base\IResourceRequest;
use ITR\Data\FormDataGenerator;
use ITR\Resource;

class FormData extends Resource
{

    public function Serve(IResourceRequest $data): array
    {
        $generator = new FormDataGenerator($this->config->get('form.static-data.path'));
        return [
            'countries' => $generator->GetData('countries'),
            'activities' => $generator->GetData('activities'),
            'articles' => $generator->GetData('articles_reading'),
            'reviews' => $generator->GetData('employee_reviews'),
            'freeTimeHabits' => $generator->GetData('free_time_habits'),
            'levels' => $generator->GetData('job_levels'),
            'positions' => $generator->GetData('job_positions'),
            'mentor' => $generator->GetData('mentor'),
            'otherEdu' => $generator->GetData('other_educations'),
            'polishDistricts' => $generator->GetData('polish_districts'),
            'schools' => $generator->GetData('schools'),
            'studies' => $generator->GetData('studies'),
            'tdd' => $generator->GetData('tdd'),
            'tech' => $generator->GetData('tech_and_schools'),
            'timesWithComputer' => $generator->GetData('timesWithComputer'),
            'jobExperience' => $generator->GetData('jobExperience'),
            'salaries' => $generator->GetData('salaries'),
            'ages' => $generator->GetData('ages')
        ];
    }




}