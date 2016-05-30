<?php

/**
 * Created by PhpStorm.
 * Date => 21.05.2016
 * Time => 13:10
 */

use Entity\Cv;
use Entity\Person;

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
            'programmer'       => 'программист',
            'system_admin'     => 'системный администратор',
            'security_admin'   => 'администратор ИБ',
            'web_designer'     => 'веб дизайнер',
            'project_manager'  => 'проект менеджер',
            'software_testing' => 'тестировщик ПО',
            'web_developer'    => 'веб-разработчик',
        ];
    }

    /**
     * @return array
     */
    public static function getWorkExperiencesTitles()
    {
        return [
            'nope' => 'без опыта',
            '<1'   => 'менее года',
            '1-3'  => '1-3 года',
            '3-5'  => '3-5 лет',
            '5>'   => 'более 5 лет'
        ];
    }

    /**
     * @return array
     */
    public static function getEducationsTitles()
    {
        return [
            '<middle'          => 'неполное среднее',
            'middle'           => 'среднее',
            'middle>'          => 'среднее профессиональное',
            '>high'            => 'высшее (бакалавриат)',
            'high'             => 'высшее (магистратура)',
            'many_high'        => 'два высших',
            'fulltime_student' => 'студент-очник',
            'distance_student' => 'студент-заочник',
        ];
    }

    /**
     * @return array
     */
    public static function getSchedulesTitles()
    {
        return [
            'full'    => 'полный рабочий день',
            'remote'  => 'удаленная работа',
            'elastic' => 'гибкий',
            'shift'   => 'сменный'
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

    /**
     * @param Cv $cv
     * @return array
     */
    public static function cvToArray(Cv $cv, $isRaw = true)
    {
        $keys = [
            'sphere'             => 'Желаемая сфера деятельности',
            'access_type'        => 'Тип доступа к резюме',
            'hobbies'            => 'Увлечения',
            'skills'             => 'Опыт и навыки',
            'work_experience'    => 'Рабочий стаж',
            'education'          => 'Образование',
            'ext_education'      => 'Доп. образование',
            'desire_salary'      => 'Желаемая з/п',
            'schedule'           => 'Рабочий график',
            'foreign_languages'  => 'Владение иностранными языками',
            'is_drivers_license' => 'Имеет водительское удостоверение',
            'is_smoking'         => 'Курит',
            'is_married'         => 'В браке',
            'about'              => 'О себе'
        ];

        return $isRaw ? [
            'sphere'             => $cv->getSphere(),
            'access_type'        => $cv->getAccessType(),
            'hobbies'            => $cv->getHobbies(),
            'skills'             => $cv->getSkills(),
            'work_experience'    => $cv->getWorkExperience(),
            'education'          => $cv->getEducation(),
            'ext_education'      => $cv->getExtEducation(),
            'desire_salary'      => $cv->getDesireSalary(),
            'schedule'           => $cv->getSchedule(),
            'foreign_languages'  => $cv->getForeignLanguages(),
            'is_drivers_license' => $cv->getIsDriversLicense(),
            'is_smoking'         => $cv->getIsSmoking(),
            'is_married'         => $cv->getIsMarried(),
            'about'              => $cv->getAbout()
        ] : [
            $keys['sphere']             => $cv->getSphere(),
            $keys['access_type']        => $cv->getAccessType(),
            $keys['hobbies']            => $cv->getHobbies(),
            $keys['skills']             => $cv->getSkills(),
            $keys['work_experience']    => $cv->getWorkExperience(),
            $keys['education']          => $cv->getEducation(),
            $keys['ext_education']      => $cv->getExtEducation(),
            $keys['desire_salary']      => $cv->getDesireSalary(),
            $keys['schedule']           => $cv->getSchedule(),
            $keys['foreign_languages']  => $cv->getForeignLanguages(),
            $keys['is_drivers_license'] => $cv->getIsDriversLicense(),
            $keys['is_smoking']         => $cv->getIsSmoking(),
            $keys['is_married']         => $cv->getIsMarried(),
            $keys['about']              => $cv->getAbout()
        ];
    }

    /**
     * @param Person $person
     * @return array
     */
    public static function personInformationToArray(Person $person)
    {
        return [
            'full_name'        => $person->getFullName(),
            'date_birth'       => $person->getDateBirth()->format('Y-m-d'),
            'organisation'     => $person->getOrganisation(),
            'email'            => $person->getUser()->getEmail(),
            'phone'            => $person->getContact()->getPhone(),
            'websites'         => $person->getContact()->getWebsites(),
            'city'             => $person->getContact()->getAddress()->getCity(),
            'street'           => $person->getContact()->getAddress()->getStreet(),
            'house_number'     => $person->getContact()->getAddress()->getHouseNumber(),
            'apartment_number' => $person->getContact()->getAddress()->getApartmentNumber(),
        ];
    }
}