<?php
    $requestMethod = $_SERVER["REQUEST_METHOD"];
	include('./class/Student.php');
	$student = new Student();
    switch($requestMethod)
    {
        case 'GET':
            $pathArray = explode('/', $_SERVER['REQUEST_URI']);
    if(isset($pathArray[3]))
        $id = $pathArray[3];
    else
        $id = -1;
	
		if($id != -1) 
		{
			$student->_id = $id;
			$data = $student->one();
		} 
		$pathArray = explode('/', $_SERVER['REQUEST_URI']);
		if(isset($pathArray[3]))
			$id = $pathArray[3];
		else
			$id = -1;
		
			if($id != -1) 
			{
				$student->_id = $id;
				$data = $student->one();
			} 
			else 
			{
				$data = $student->list();          
			}
			
			if(!empty($data)) 
			{
			  $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
			} 
			else 
			{
			  $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
			}
			header('Content-Type: application/json');
			echo $js_encode;
			break;
        case 'POST':
			$inputJSON = file_get_contents('php://input');
        	$input = json_decode($inputJSON, TRUE);

        	$student->_name = $input["name"];
        	$student->_surname = $input["surname"];
        	$student->_sidiCode = $input["sidicode"];
        	$student->_taxCode = $input["taxcode"];

        	$data = $student->insert();
        	$js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);

        header('Content-Type: application/json');
		echo  $js_encode;		
            break;
		case 'DELETE':
			$pathArray = explode('/', $_SERVER['REQUEST_URI']);
			if($pathArray[3])
            {
                $id = $pathArray[3];
                $student->_id=$id;
				$data=$student->delete();
            }
            if(!empty($data)) 
			{
			  $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
			} 
			else 
			{
			  $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Opss'), true);
			}
            header('Content-Type: application/json');
            echo "Response: " . $js_encode;
            break;
		case 'PUT':
		
			$pathArray = explode('/', $_SERVER['REQUEST_URI']);
			if($pathArray[3])
            {
                $id = $pathArray[3];
                $student->_id=$id;
				
				$JSON=file_get_contents('php://input');
				$i=json_decode($JSON,true);
				
				if($i["name"])
					$student->_name =  $i["name"];
				else 
					$student->_name = null;
				if($i["surname"])
					$student->_surname =  $i["surname"];
				else 
					$student->_surname = null;
				if($i["sidicode"])
					$student->_sidiCode =  $i["sidicode"];
				else 
					$student->_sidiCode = null;
				if($i["taxcode"])
					$student->_taxCode =  $i["taxcode"];
				else 
					$student->_taxCode = null;
				
				$data=$student->put();
            }
			if(!empty($data)) 
			{
			  $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
			} 
			else 
			{
			  $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Opss'), true);
			}
			header('Content-Type: application/json');
            echo "Response: " . $js_encode;
            break;
		case 'PATCH':
			
			$pathArray = explode('/', $_SERVER['REQUEST_URI']);
			if($pathArray[3])
            {
                $id = $pathArray[3];
                $student->_id=$id;
				
				$JSON=file_get_contents('php://input');
				$i=json_decode($JSON,true);
				
				if(isset($i["name"]))
					$student->_name =  $i["name"];
				if(isset($i["surname"]))
					$student->_surname =  $i["surname"];
				if(isset($i["sidicode"]))
					$student->_sidiCode =  $i["sidicode"];
				if(isset($i["taxcode"]))
					$student->_taxCode =  $i["taxcode"];
				
				$data=$student->patch();
            }
			if(!empty($data)) 
			{
			  $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
			} 
			else 
			{
			  $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Opss'), true);
			}
			header('Content-Type: application/json');
            echo "Response: " . $js_encode;
			break;

			default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
		
    };
?>