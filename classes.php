<?php
    $requestMethod = $_SERVER["REQUEST_METHOD"];
	include('./class/Class.php');
	$classe = new classe();
    switch($requestMethod)
    {

        case 'GET':
			$pathArray = explode('/', $_SERVER['REQUEST_URI']);
            $path = explode ('?', $pathArray[2]);
			if(isset($path[1]))
            {
				$p = explode('=',$path[1]);
                $id = $p[1];
                $classe->_id=$id;
				$data=$classe->one();
            }
            else
            {
                $data = $classe->list();
            }
            if(!empty($data)) 
			{
				$js_encode = json_encode(array('status'=>TRUE, 'classeInfo'=>$data), true);
			} 
			else 
			{
			  	$js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
			}
            header('Content-Type: application/json');
            echo $js_encode;
			break;
			
		case 'POST':
			$JSON=file_get_contents('php://input');
			$i=json_decode($JSON,true);
			
			$classe->_year = $i["year"];
			$classe->_section = $i["section"];
			
			$data = $classe->insert();
			$js_encode = json_encode(array('status'=>TRUE, 'classeInfo'=>$data), true);

			header('Content-Type: application/json');
			echo $js_encode;			
            break;
		case 'DELETE':
			$pathArray = explode('/', $_SERVER['REQUEST_URI']);
			if($pathArray[3])
            {
                $id = $pathArray[3];
                $classe->_id=$id;
				$data=$classe->delete();
            }
            if(!empty($data)) 
			{
			  $js_encode = json_encode(array('status'=>TRUE, 'classeInfo'=>$data), true);
			} 
			else 
			{
			  $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Opss'), true);
			}
            header('Content-Type: application/json');
            echo $js_encode;
            break;
		case 'PUT':
		
			$pathArray = explode('/', $_SERVER['REQUEST_URI']);
			if($pathArray[3])
            {
                $id = $pathArray[3];
                $classe->_id=$id;
				
				$JSON=file_get_contents('php://input');
				$i=json_decode($JSON,true);
				
				if($i["year"])
					$classe->_year =  $i["year"];
				else 
					$classe->_year = null;
				if($i["section"])
					$classe->_section =  $i["section"];
				else 
					$classe->_section = null;
				
				$data=$classe->put();
            }
			if(!empty($data)) 
			{
			  $js_encode = json_encode(array('status'=>TRUE, 'classInfo'=>$data), true);
			} 
			else 
			{
			  $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Opss'), true);
			}
			header('Content-Type: application/json');
            echo $js_encode;
            break;
		case 'PATCH':
			
			$pathArray = explode('/', $_SERVER['REQUEST_URI']);
			if($pathArray[3])
            {
                $id = $pathArray[3];
                $classe->_id=$id;
				
				$JSON=file_get_contents('php://input');
				$i=json_decode($JSON,true);
				
				if(isset($i["year"]))
					$classe->_year =  $i["year"];
				if(isset($i["section"]))
					$classe->_section =  $i["section"];
				
				$data=$classe->patch();
            }
			if(!empty($data)) 
			{
			  $js_encode = json_encode(array('status'=>TRUE, 'classeInfo'=>$data), true);
			} 
			else 
			{
			  $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Opss'), true);
			}
			header('Content-Type: application/json');
            echo $js_encode;
			break;
    };
?>