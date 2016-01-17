<?php
/**
 * 
 */
class RestAPI extends Controller {
	
	public function __construct(){
		parent::__construct();
		$this->checkAuthenticationType();
	}
	/**
	 * Public function that gathers the spot for a given lng and lat. Both must be set in the post
	 */
	public function getFreeSpots() {
		//response var
		$jsonResponse = array();
		if ( isset($_POST['lat']) && isset($_POST['lng']) ) {
			$result = $this->model->getFreeSpotsFromDB($_POST['lat'], $_POST['lng']);
			foreach ($result as $row) {
				$row['level'] = Session::getUserLevel();
				$jsonResponse[$row['fs_metaInfo']][] = $row;
			}
			echo json_encode($jsonResponse);
		}else {
			throw new MegatronException("Incorrect parameters.", 1);
		}
	}
	/**
	 * Public function that let us insert data points 
	 */
	public function insertDataPoint() {
		// $name = 'Free spot', $metaInfo, $lat, $lng, $comments = ''
		if ($this->model->validatePoint() ) {
			$this->model-> insertPoint();
			echo json_encode("1");
		}else {
			throw new MegatronException("Error Processing Request", 1);
		}
	}
	
	/**
	 * Check authentication type. Either via token or authenticated user.
	 */
	
	private function checkAuthenticationType() {
		if ( !Session::logged() ) {
	 		if (!isset($_GET['token']) || !$this->model->verifyTokenAuthentication($_GET['token']) ) {
	 			echo json_encode("Megatron error: 'Invalid token or user is not logged in'");
				exit;
			}	
	 	}
	}
	
	/**
	 * Gets some objects for the datatable. FOR A DEMO
	 */
	 public function getDataTableSpots (){
	 	$json = '{"data": [
					    {
					      "Name": "Tiger Nixon",
					      "Password": "free",
					      "Latitude": "42.160639",
					      "Longtitude": "24.753112"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					     {
					      "Name": "Tiger Nixon",
					      "Password": "free",
					      "Latitude": "42.160639",
					      "Longtitude": "24.753112"
					    }
					  ]
					}';
		echo $json;
	 }
}
 
?>