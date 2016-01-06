<?php
class CommonForm extends CFormModel{
	/**
	 * 验证是否登录
	 * Enter description here ...
	 */
	public function getuserID(){
		$user_id=Yii::app()->user->id;
		if(!$user_id){
			$this->redirect('../../user/login');
			exit;
		}
		return $user_id;
	}
	/**
	 * 登记入库
	 */
	public function Add($modelName,$return){
		$user_id=Commonmodel::getOrganID();
		if ($_POST[$modelName]){
			$post=$_POST[$modelName];
			if ($modelName=='MakeEmpowerDealer'){
				$make=MakeEmpowerDealer::model()->findByPk($post['id']);
				if (empty($make)){
					$telephone=$_POST['telephone'];
		        	$dealer=Dealer::model()->find("Phone='{$telephone}'");
		        	if (empty($dealer)){
		        		Yii::app()->db->createCommand()->insert('tbl_user',array(
		        			'username'=>$telephone,
		        			'password'=>md5($telephone),
		        			'email'=>$telephone.'@jiaparts.com',
			        		'status'=>'1',
			        		'create_at'=>date('Y-m-d H-i-s',time()),
			        		'identity'=>'2',
		        		));
		        		$newuserID=Yii::app()->db->getLastInsertID();
		        		Yii::app()->db->createCommand()->insert('tbl_profiles',array(
		        			'user_id'=>$newuserID,
		        		));
		        		Yii::app()->db->createCommand()->insert('tbl_dealer',array(
		        			'userID'=>$newuserID,
		        			'organName'=>$post['organName'],
		        			'jiapartsId'=>$telephone,
			        		'loginPassword'=>md5($telephone),
			        		'Phone'=>$telephone,
		        		));
		        		$post['dealer_id']=Yii::app()->db->getLastInsertID();
		        	}else {
		        		$post['dealer_id']=$dealer->id;
		        	}
					$make = new MakeEmpowerDealer();
				}
				$post['up_userID']=$user_id;
			}elseif ($modelName=='MakeContacts'){
				$make=MakeContacts::model()->findByPk($post['id']);
				if (empty($make)){
					$make = new MakeContacts();
				}
				$post['up_userID']=$user_id;	
			}elseif ($modelName=='MakeDistributionBusiness'){
				$make=MakeDistributionBusiness::model()->findByPk($post['id']);
				if (empty($make)){
					$make = new MakeDistributionBusiness();
				}
				$post['up_userID']=$user_id;
			}elseif ($modelName=='MakeStorageService'){
				$make=MakeStorageService::model()->findByPk($post['id']);
				if (empty($make)){
					$make = new MakeStorageService();
				}
				$post['up_userID']=$user_id;
			}
			elseif ($modelName=='MakeTechniqueService'){
				$make=MakeTechniqueService::model()->findByPk($post['id']);
				if (empty($make)){
					$make = new MakeTechniqueService();
				}
				$post['up_userID']=$user_id;
				$post['serviceTime']=$_POST['beginWeek'].'至'.$_POST['endWeek'].' '.$_POST['beginHour'].'-'.$_POST['endHour'];
			}
			$make->attributes=$post;
			$make->save();
			$this->redirect(array($return));
		}
	}
	public function cutstr($str,$cutleng)
	{
		$str = $str; //要截取的字符串
		$cutleng = $cutleng; //要截取的长度
		$strleng = strlen($str); //字符串长度
		if($cutleng>$strleng)return $str;//字符串长度小于规定字数时,返回字符串本身
		$notchinanum = 0; //初始不是汉字的字符数
		for($i=0;$i<$cutleng;$i++)
		{
			if(ord(substr($str,$i,1))<=0xa0)
			{
				$notchinanum++;
			}
		}
		if(($cutleng%2==1)&&($notchinanum%2==0))//如果要截取奇数个字符，所要截取长度范围内的字符必须含奇数个非汉字，否则截取的长度加一
		{
			$cutleng++;
		}
		if(($cutleng%2==0)&&($notchinanum%2==1))//如果要截取偶数个字符，所要截取长度范围内的字符必须含偶数个非汉字，否则截取的长度加一
		{
			$cutleng++;
		}
		return substr($str,0,$cutleng).'...';
	}
}