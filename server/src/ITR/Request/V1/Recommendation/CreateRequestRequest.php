<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 22:01
 */

namespace ITR\Request\V1\Recommendation;


use ITR\ResourceRequest;


/**
 * Class CreateRequestRequest
 * @package ITR\Request\V1\Recommendation
 * TODO: Validate request;
 */
class CreateRequestRequest extends ResourceRequest
{
    public $activities;
    public $age;
    public $articles;
    public $books;
    public $country;
    public $district;
    public $email;
    public $exp;
    public $freeTimeHabits;
    public $github;
    public $itech;
    public $jobExp;
    public $level;
    public $mentor;
    public $otherEdu;
    public $otherPosition;
    public $position;
    public $sallary;
    public $schools;
    public $spentTime;
    public $studies;
    public $tdd;
    public $tech;
}