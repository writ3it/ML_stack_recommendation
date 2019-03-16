<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 22:01
 */

namespace ITR\Request\V1\Recommendation;


use ITR\Data\FormDataGenerator;
use ITR\ResourceRequest;
use ITR\Validation\ArrayValidator;
use ITR\Validation\Custom\DistrictValidator;
use ITR\Validation\Custom\OverflowValidator;
use ITR\Validation\IInlineValidator;
use ITR\Validation\Validator;
use Respect\Validation\Rules\Age;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\ArrayVal;
use Respect\Validation\Validator as v;


/**
 * Class CreateRequestRequest
 * @package ITR\Request\V1\Recommendation
 */
class CreateRequestRequest extends ResourceRequest
{
    public $activities;
    public $age;
    public $articles;
    public $country;
    public $district;
    public $email;
    public $exp;
    public $jobExp;
    public $freeTimeHabits;
    public $github;
    public $itech;
    public $tech;
    public $level;
    public $mentor;
    public $otherEdu;
    public $otherPosition;
    public $position;
    public $salary;
    public $schools;
    public $spentTime;
    public $studies;
    public $tdd;


    private $data;

    public function __construct()
    {
        parent::validate();
        $this->data = new FormDataGenerator();
    }

    public function InitValidation()
    {
        $this->validate('*', OverflowValidator::x());
        $this->validate('activities',
            ArrayValidator::x()->SetMinCount(3)->SetMaxCount(10),
            "Proszę wybrać od 3 do 10 aktywności");

        $this->validate('age',
            new Validator(v::in($this->getFormData('ages'))),
            "Podany wiek jest niepoprawny.");

        $this->validate('articles',
            new Validator(v::in($this->getFormData('articles_reading'))));

        $this->validate('country',
            new Validator(v::in($this->getFormData('countries'))));

        $districts = v::in($this->getFormData('polish_districts');
        $districts[] = '';
        $this->validate('district',
            new Validator($districts))
        );

        $this->validate('email', new Validator(v::email()), $msg = "To nie jest prawidłowy adres e-mail");
        $this->validate('exp', new Validator(v::in($this->getFormData('jobExperience'))));
        $this->validate('jobExp', new Validator(v::in($this->getFormData('jobExperience'))));
        $this->validate('freeTimeHabits', new Validator(v::in($this->getFormData('free_time_habits'))));
        $this->validate('itech', ArrayValidator::x()->SetMaxCount(100)->SetMinCount(3), "Wybierz przynajmniej 3 technologie");
        $this->validate('tech', ArrayValidator::x()->SetMaxCount(100)->SetMinCount(3), "Wybierz przynajmniej 3 technologie");
        $this->validate('level', new Validator(v::in($this->getFormData('job_levels'))));
        $this->validate('mentor', new Validator(v::in($this->getFormData('mentor'))));
        $this->validate('otherEdu', ArrayValidator::x()->SetMinCount(0)->SetMaxCount(100));
        $this->validate('position', new Validator(v::in($this->getFormData('job_positions'))));
        $this->validate('salary', new Validator(v::in($this->getFormData('salaries'))));
        $this->validate('schools', new Validator(v::in($this->getFormData('schools'))));
        $this->validate('spentTime', new Validator(v::in($this->getFormData('timesWithComputer'))));
        $this->validate('studies', new Validator(v::in($this->getFormData('studies'))));
        $this->validate('tdd', new Validator(v::in($this->getFormData('tdd'))));

    }

    private function getFormData(string $string)
    {
        return $this->data->GetData($string);
    }
}