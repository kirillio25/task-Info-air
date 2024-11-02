<?php

namespace application\models;

use application\core\Model;

class CityModel extends Model
{
    public function getCountriesInEurope($language)
    {
        return $this->db->query("
            SELECT 
                id, 
                c_name_rus AS name, 
                c_descr_{$language} AS description 
            FROM country 
            WHERE glob_region_id = :regionId
            ORDER BY c_name_rus ASC
        ", [
            'regionId' => 1,
        ]);
    }

    public function getRegionsByCountry($countryId, $language)
    {
        return $this->db->query("
            SELECT 
                id, 
                r_name_rus AS name, 
                r_descr_{$language} AS description 
            FROM region 
            WHERE r_country_id = :countryId
            ORDER BY r_name_rus ASC
        ", [
            'countryId' => $countryId,
        ]);
    }

    public function getCitiesByCountryWithoutRegion($countryId, $language)
    {
        return $this->db->query("
            SELECT 
                id, 
                c_name_rus AS name, 
                c_descr_{$language} AS description 
            FROM city 
            WHERE c_country_id = :countryId AND c_region_id = 0
            ORDER BY c_name_rus ASC
        ", [
            'countryId' => $countryId,
        ]);
    }

    public function getCitiesByRegion($regionId, $language)
    {
        return $this->db->query("
            SELECT 
                id, 
                c_name_rus AS name, 
                c_descr_{$language} AS description 
            FROM city 
            WHERE c_region_id = :regionId
            ORDER BY c_name_rus ASC
        ", [
            'regionId' => $regionId,
        ]);
    }
}
