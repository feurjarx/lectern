<?php

/**
 * Created by PhpStorm.
 * Date: 21.05.2016
 * Time: 13:10
 */

use Entity\Cv;

class Utils
{
    /**
     * @param array $list
     * @param array $data
     * @param array $prevData
     * @return array
     */
    public static function arraySerialization(array $list, array $data, array $prevData = []) {

        $result = [];
        
        if ($data && is_array($data) && $list && is_array($list)) {
            foreach ($list as $item) {
                $result[$item] = isset($data[$item]) ? (($data[$item] === '0' || $data[$item] === 0 || $data[$item]) ? $data[$item] : null) : null;
            }
        }

        return array_merge($prevData, $result);
    }

    /**
     * @return string
     */
    public static function getHttpHost(){
        return 'http://' . $_SERVER['HTTP_HOST'];
    }

    /**
     * @return bool
     */
    public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * @return array
     */
    public static function getSpheresTitles()
    {
        return [
            'programmer'       => 'Программист',
            'system_admin'     => 'Системный администратор',
            'security_admin'   => 'Администратор ИБ',
            'web_designer'     => 'Веб дизайнер',
            'project_manager'  => 'Проект менеджер',
            'software_testing' => 'Тестировщик ПО',
            'web_developer'    => 'Веб-разработчик',
        ];
    }

    /**
     * @return array
     */
    public static function getWorkExperiencesTitles()
    {
        return [
            'nope' => 'Без опыта',
            '<1'   => 'Менее года',
            '1-3'  => '1-3 года',
            '3-5'  => '3-5 лет',
            '5>'   => 'Более 5 лет'
        ];
    }

    /**
     * @return array
     */
    public static function getEducationsTitles()
    {
        return [
            '<middle'          => 'Неполное среднее',
            'middle'           => 'Среднее',
            'middle>'          => 'Среднее профессиональное',
            '>high'            => 'Высшее (бакалавриат)',
            'high'             => 'Высшее (магистратура)',
            'many_high'        => 'Два высших',
            'fulltime_student' => 'Студент-очник',
            'distance_student' => 'Студент-заочник',
        ];
    }

    /**
     * @return array
     */
    public static function getSchedulesTitles()
    {
        return [
            'full'    => 'Полный рабочий день',
            'remote'  => 'Удаленная работа',
            'elastic' => 'Гибкий',
            'shift'   => 'Сменный'
        ];
    }

    /**
     * @param array $params
     * @return Cv
     */
    public static function fillCv(array $params, Cv $cv)
    {
        foreach ($params as $key => $value) {
            switch ($key) {
                case 'sphere': $cv->setSphere($value); break;
                case 'access_type': $cv->setAccessType($value); break;
                case 'hobbies': $cv->setHobbies($value); break;
                case 'skills': $cv->setSkills($value); break;
                case 'work_experience': $cv->setWorkExperience($value); break;
                case 'education': $cv->setEducation($value); break;
                case 'ext_education': $cv->setExtEducation($value); break;
                case 'desire_salary': $cv->setDesireSalary($value); break;
                case 'schedule': $cv->setSchedule($value); break;
                case 'foreign_languages': $cv->setForeignLanguages($value); break;
                case 'is_drivers_license': $cv->setIsDriversLicense($value); break;
                case 'is_smoking': $cv->setIsSmoking($value); break;
                case 'is_married': $cv->setIsMarried($value); break;
                case 'about': $cv->setAbout($value); break;
            }
        }

        return $cv;
    }
}