<?php

namespace application\controllers;

use application\core\Model;
use application\core\Controller;
use application\core\View;

class CityController extends Controller
{
    public function index()
    {
        $model = Model::getModel();
        // Тут менять язык
        $language = $_GET['lang'] ?? 'eng';

        $countries = $model->getCountriesInEurope($language);
        
        $data = [];
        foreach ($countries as $country) {
            $countryData = [
                'country' => $country,
                'citiesWithoutRegion' => $model->getCitiesByCountryWithoutRegion($country['id'], $language),
                'regions' => []
            ];

            $regions = $model->getRegionsByCountry($country['id'], $language);
            foreach ($regions as $region) {
                $regionData = [
                    'region' => $region,
                    'cities' => $model->getCitiesByRegion($region['id'], $language)
                ];
                $countryData['regions'][] = $regionData;
            }

            $data[] = $countryData;
        }

        $vars = [
            'data' => $data,
        ];
        return View::render('city/index', $vars);
    }
}