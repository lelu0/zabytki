<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function monument()
    {
        return $this->belongsTo('App\Monument', 'monument_id', 'id');
    }

    public function fillLocation($request, $monument_id)
    {
        $this->monument_id = $monument_id;
        $this->street = $request->street;
        $this->city = $request->city;
        $this->postal = $request->postal;
        $this->voivodeship = $request->voivodeship;
        $this->country = $request->country;

        if ($request->logitude && $request->latitude) {
            $this->logitude = $request->logitude;
            $this->latitude = $request->latitude;
        } else {
            $cords = $this->getCoordinatesFromAddress();
            if($cords){
                $this->logitude = $cords['lng'];
                $this->latitude = $cords['lat'];
            }else{
                $this->logitude = 0;
                $this->latitude = 0;
            }            
        }
    }
    public function getCoordinatesFromAddress()
    {
        $address = array($this->street, $this->postal, $this->city, $this->voivodeship, $this->country);
        $adrStr = '';
        foreach ($address as $part) {
            if ($part) {
                $adrStr .= '+' . $part;
            }

        }

        $url = 'https://api.opencagedata.com/geocode/v1/json';

        $query_array = array(
            'key' => 'cc6ad25494404dceaacf69c7d30a212c',
            'q' => $adrStr,
        );
        $query = http_build_query($query_array);
        $url = $url . '?' . $query;
        $response = file_get_contents($url);
        $json = json_decode($response, true);
        return (isset($json['results'][0]['geometry']) ? $json['results'][0]['geometry'] : null);

    }
}
