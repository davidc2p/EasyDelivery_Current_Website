<?php
class GeoAlgorithm {

    //protected $_eQuatorialEarthRadius = 6378.1370;
    protected $_eQuatorialEarthRadius = 6371.01;
    protected $_d2r;

	function __construct() {
		$this->_d2r = pi() / 180;
	}
	
	function toRad($deg){
		return $deg * pi() / 180;
	}
	function toDeg($rad){
		return $rad * 180 / pi();
	}
	
    public function HaversineInM($lat1, $long1, $lat2, $long2) {
        return (int) (1000 * HaversineInKM($lat1, $long1, $lat2, $long2));
    }

    public function HaversineInKM($lat1, $long1, $lat2, $long2) {
        $dlong = $this->toRad(($long2 - $long1));
        $dlat = $this->toRad(($lat2 - $lat1));
        $a = pow(sin($dlat / 2), 2) + cos($this->toRad($lat1)) * cos($this->toRad($lat2)) * pow(sin($dlong / 2), 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $this->_eQuatorialEarthRadius * $c;

        return $d;
    }
	
	public function GeoBox($lat, $long, $distance) {
		
		$lat1 = $this->toRad($lat);
		$long1 = $this->toRad($long);
		$bbox = array();

		$distance = $distance/$this->_eQuatorialEarthRadius; //Earth's radius in km
		
		//West
		$bearing = 270;
		$bearing = $this->toRad($bearing);
 
		$lat2 = asin( sin($lat1)*cos($distance) +
					  cos($lat1)*sin($distance)*cos($bearing) );
		$long2 = $long1 + atan2(sin($bearing)*sin($distance)*cos($lat1),
							  cos($distance)-sin($lat1)*sin($lat2));
		$long2 = fmod(($long2+3*pi()),(2*pi())) - pi();  
		//print "West: ".$this->toDeg($lat2)."#".$this->toDeg($long2)."<br>";
		array_push($bbox, $this->toDeg($long2));

		//South
		$bearing = 180;
		$bearing = $this->toRad($bearing);
 
		$lat2 = asin( sin($lat1)*cos($distance) +
					  cos($lat1)*sin($distance)*cos($bearing) );
		$long2 = $long1 + atan2(sin($bearing)*sin($distance)*cos($lat1),
							  cos($distance)-sin($lat1)*sin($lat2));
		$long2 = fmod(($long2+3*pi()),(2*pi())) - pi();  
		//print "South: ".$this->toDeg($lat2)."#".$this->toDeg($long2)."<br>";
		array_push($bbox, $this->toDeg($lat2));

		//East
		$bearing = 90;
		$bearing = $this->toRad($bearing);
 
		$lat2 = asin( sin($lat1)*cos($distance) +
					  cos($lat1)*sin($distance)*cos($bearing) );
		$long2 = $long1 + atan2(sin($bearing)*sin($distance)*cos($lat1),
							  cos($distance)-sin($lat1)*sin($lat2));
		$long2 = fmod(($long2+3*pi()),(2*pi())) - pi();  
		//print "East: ".$this->toDeg($lat2)."#".$this->toDeg($long2)."<br>";
		array_push($bbox, $this->toDeg($long2));
		
		//North
		$bearing = 0;
		$bearing = $this->toRad($bearing);
 
		$lat2 = asin( sin($lat1)*cos($distance) +
					  cos($lat1)*sin($distance)*cos($bearing) );
		$long2 = $long1 + atan2(sin($bearing)*sin($distance)*cos($lat1),
							  cos($distance)-sin($lat1)*sin($lat2));
		$long2 = fmod(($long2+3*pi()),(2*pi())) - pi();  
		//print "North: ".$this->toDeg($lat2)."#".$this->toDeg($long2)."<br>";
		array_push($bbox, $this->toDeg($lat2));

				
		return $bbox;	

				
		
		/*
		print "Bearing: ".$bearing.'<br>';
		$lat2 = ASIN(SIN($lat1)*COS($distance/$this->_eQuatorialEarthRadius) + COS($lat1)*SIN($distance/$this->_eQuatorialEarthRadius)*COS($bearing));
		$long2 = $long1 + ATAN2(SIN($bearing)*SIN($distance/$this->_eQuatorialEarthRadius)*COS($lat1), COS($distance/$this->_eQuatorialEarthRadius)-SIN($lat1)*SIN($lat2)); 
		
		print $lat2 / $this->_d2r."#".$long2 / $this->_d2r."<br>";

		$bearing = pi() / 4;
		print "Bearing: ".$bearing.'<br>';

		$lat2 = ASIN(SIN($lat1)*COS($distance/$this->_eQuatorialEarthRadius) + COS($lat1)*SIN($distance/$this->_eQuatorialEarthRadius)*COS($bearing));
		$long2 = $long1 + ATAN2(SIN($bearing)*SIN($distance/$this->_eQuatorialEarthRadius)*COS($lat1), COS($distance/$this->_eQuatorialEarthRadius)-SIN($lat1)*SIN($lat2)); 
		
		print $lat2 / $this->_d2r."#".$long2 / $this->_d2r."<br>";

		
		$bearing = pi() / 2;
		print "Bearing: ".$bearing.'<br>';

		$lat2 = ASIN(SIN($lat1)*COS($distance/$this->_eQuatorialEarthRadius) + COS($lat1)*SIN($distance/$this->_eQuatorialEarthRadius)*COS($bearing));
		$long2 = $long1 + ATAN2(SIN($bearing)*SIN($distance/$this->_eQuatorialEarthRadius)*COS($lat1), COS($distance/$this->_eQuatorialEarthRadius)-SIN($lat1)*SIN($lat2)); 
		
		print $lat2 / $this->_d2r."#".$long2 / $this->_d2r."<br>";
		
		$bearing = 3 * pi() / 4;
		print "Bearing: ".$bearing.'<br>';
		
		$lat2 = ASIN(SIN($lat1)*COS($distance/$this->_eQuatorialEarthRadius) + COS($lat1)*SIN($distance/$this->_eQuatorialEarthRadius)*COS($bearing));
		$long2 = $long1 + ATAN2(SIN($bearing)*SIN($distance/$this->_eQuatorialEarthRadius)*COS($lat1), COS($distance/$this->_eQuatorialEarthRadius)-SIN($lat1)*SIN($lat2)); 
		
		print $lat2 / $this->_d2r."#".$long2 / $this->_d2r."<br>";
		*/
	}

}

?>