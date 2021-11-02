<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{
	function __construct()
  {
      parent::__construct();
  }

  function getCarMark()
	{
    return $this->db->query("SELECT * FROM carmark WHERE active = 1 ORDER BY mark asc")->result_array();
  }

  function getCarModel()
	{
    return $this->db->query("SELECT * FROM carmodel WHERE active = 1 ORDER BY model asc")->result_array();
  }

  function getCarYear()
	{
    return $this->db->query("Select * from caryear where active = 1")->result_array();
  }

  function getCarBarter()
	{
    return $this->db->query("Select * from carbarter where active = 1")->result_array();
  }

  function getCarBody()
	{
    return $this->db->query("Select * from carbody where active = 1")->result_array();
  }

  function getCarCarFax()
	{
    return $this->db->query("Select * from carcarfax where active = 1")->result_array();
  }

  function getCarColor()
	{
    return $this->db->query("Select * from carcolor where active = 1")->result_array();
  }

  function getCarCredit()
	{
    return $this->db->query("Select * from carcredit where active = 1")->result_array();
  }

  function getCarDrive()
	{
    return $this->db->query("Select * from cardrive where active = 1")->result_array();
  }

  function getCarEngine()
	{
    return $this->db->query("Select * from carengine where active = 1 order by cast(engine as decimal(4,2)) asc")->result_array();
  }

  function getCarFuel()
	{
    return $this->db->query("Select * from carfuel where active = 1")->result_array();
  }

  function getCarInteriorColor()
	{
    return $this->db->query("Select * from carinteriorcolor where active = 1")->result_array();
  }

  function getCarTransmission()
	{
    return $this->db->query("Select * from cartransmission where active = 1")->result_array();
  }

  function getCarVin()
	{
    return $this->db->query("Select * from carvin where active = 1")->result_array();
  }

  function getCarCities()
	{
    return $this->db->query("Select * from elancities where active = 1")->result_array();
  }

  function getAdditionalParam()
	{
    return $this->db->query("Select * from caradditionalparam where active = 1")->result_array();
  }

	function getCarIdByPincode($pincode)
	{
		return $this->db->query("select caradid from carphoto where pincode = ".$pincode." limit 1")->result_array();
	}

	function checkAuthorTop($id, $adid){
		return $this->db->query("select MAX(id),createdate,COALESCE(datediff(now(),createdate),0) as days from car_orders where action = 1 and authorid = ".(int)$id." and caradid = ".(int)$adid."  group by authorid ")->result_array();
	}

	function checkAuthorTopPlus($id, $adid){
		return $this->db->query("select MAX(id),createdate,COALESCE(datediff(now(),createdate),0) as days from car_orders where action = 2 and authorid = ".(int)$id." and caradid = ".(int)$adid."   group by authorid")->result_array();
	}

	function getAuthorCars($authorid, $sort)
	{
		$where = '';

		if ($sort == 'Hamısı')
			$sort = '1,2,0';
		elseif ($sort == 'Deaktiv') {
			$sort = '2';
			$where = ' or cv.car_status = 1';
		}
		elseif ($sort == 'Gözləyən')
			$sort = '0,9';
		else
			$sort = '1,2,0';

		$query = "SELECT cv.*, IF(ISNULL(au.carad_id), 0, 1) AS 'on_auction' FROM carads_view AS cv
							LEFT JOIN (SELECT carad_id FROM auction
												 WHERE status = 1) AS au ON au.carad_id = cv.id
							WHERE cv.authorid = ".(int)$authorid." and (cv.status in (".$sort.")".$where.")";

		return $this->db->query($query)->result_array();
	}

	function get_rent_cars($user_id, $sort, $limit)
	{
		if ($sort == 1)
			$sort = '1,2,0';
		elseif ($sort == 2)
			$sort = '2';
		elseif ($sort == 3)
			$sort = '0,9';
		else
			$sort = '1,2,0';

		$query = 'SELECT cp.name as "image", pc.photo_count, CONCAT(mark.mark, " ", model.model) as "title",
										 car.*, engine.engine, IF(ISNULL(f.id), 0, f.beyen) as "favorit", u.autosalon, IF(ISNULL(au.id), 0, 1) as "on_auction",
										 mark.mark as "mark_name", model.model as "model_name"
							FROM rent_car as car
							LEFT JOIN (SELECT id, carad_id FROM auction WHERE status = 1) as au on au.carad_id = car.id
							LEFT JOIN (SELECT cp1.rent_car_id, cp1.name FROM rent_car_photo as cp1
                         LEFT JOIN (SELECT rent_car_id, min(location) as location FROM rent_car_photo
												 						WHERE active = 1 and deleted = 0
																		GROUP BY rent_car_id
																	 ) as cp2 on cp2.rent_car_id = cp1.rent_car_id
                         WHERE cp1.location = cp2.location and cp1.deleted = 0
											  ) as cp on cp.rent_car_id = car.id
							LEFT JOIN (SELECT rent_car_id, count(rent_car_id) as "photo_count" FROM rent_car_photo
												 GROUP BY rent_car_id) as pc on pc.rent_car_id = car.id
							LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id = car.mark
							LEFT JOIN (SELECT id, model FROM carmodel) as model on model.id = car.model
							LEFT JOIN (SELECT id, pid, beyen FROM favorit
												 WHERE uid = '.$user_id.') as f on f.pid = car.id
							LEFT JOIN (SELECT id, autosalon FROM user) as u on u.id = car.authorid
							LEFT JOIN (SELECT id, engine FROM carengine WHERE active = 1) as engine on engine.id = car.engine
							WHERE authorid = '.$user_id.' and status in ('.$sort.')
							GROUP BY car.id
							ORDER BY createdate desc
							LIMIT '.$limit;

		return $this->db->query($query)->result();
	}

	function currentBalans($id){
		return $this->db->query("select authorid,salon ,SUM(CASE WHEN action in (3, 5, 20) THEN amount END) as plus, SUM(CASE WHEN action in (12,13,14,15,16,17,18,19) THEN amount END) as minus, COALESCE(SUM(case when action in (4) and salon = 1 then amount END),0) as ads FROM car_orders_view where authorid = ".(int)$id." and active = 1")->row();
	}
	function getAuthorFavouriteCars($authorid){
		return $this->db->query("select * from carads_view where authorid = ".(int)$authorid." and status = 1 and favourite = 1")->result_array();
	}

	function getAuthorAdsCount($authorid)
	{
		return $this->db->query("select count(*) as adscount from carad where authorid = ".(int)$authorid." and  (status = 1 or status = 2  or car_status = 1)	")->result_array();
	}

	function getAuthorFavAdsCount($authorid){
		return $this->db->query("select count(*) as adsfavcount from carad where authorid = ".(int)$authorid." and  (status = 1 or status = 2 or status = 3)	and favourite = 1 ")->result_array();
	}
	function getAuthorCarsPhotoCount($adid){
		return $this->db->query("select count(id) as photoCount FROM `carphoto` WHERE caradid = ".(int)$adid." ")->row();
	}

	function makeFavourite($adid,$authorid,$favourite){
		$this->db->query("update carad set favourite = ".(int)$favourite." where authorid = ".(int)$authorid." and id = ".(int)$adid." ");
	}

	function rent_make_favourite($adid, $user_id, $favourite)
	{
		$this->db->query("UPDATE rent_car SET favourite = ".(int) $favourite." WHERE authorid = ".(int) $user_id." and id = ".(int) $adid);
	}

	function changeCarStatus($adid,$car_status,$authorid){
		if($car_status == 1){
			$this->db->query("update carad set car_status = 1 where  authorid = ".(int)$authorid." and id = ".(int)$adid." ");
		}
		else{
			$this->db->query("update carad set car_status = 0 where  authorid = ".(int)$authorid." and id = ".(int)$adid." ");
		}
	}

	function change_rent_car_status($adid, $car_status, $user_id){
		if ($car_status == 1) {
			$this->db->query("update rent_car set car_status = 1 where authorid = ".(int)$user_id." and id = ".(int)$adid);
		} else {
			$this->db->query("update rent_car set car_status = 0 where authorid = ".(int)$user_id." and id = ".(int)$adid);
		}
	}

	function get_map_data($id)
	{
		$query = 'SELECT * FROM map WHERE map_id = '.$id.' ORDER BY map_id desc';
		return $this->db->query($query)->row();
	}

	function get_last_map_id()
	{
		$query = 'SELECT MAX(map_id) as "id" FROM map';
		return $this->db->query($query)->row();
	}

	function changeStatus($adid,$status,$authorid){
		if($status == 2){
			$this->db->query("update carad set status = 2 where  authorid = ".(int)$authorid." and id = ".(int)$adid." ");
		}
		else{
			$this->db->query("update carad set status = 1 where  authorid = ".(int)$authorid." and id = ".(int)$adid." ");
		}
	}

	function change_rent_status($adid, $status, $user_id)
	{
		if ($status == 2)
			$this->db->query("update rent_car set status = 2 where authorid = ".(int) $user_id." and id = ".(int) $adid);
		else
			$this->db->query("update rent_car set status = 1 where authorid = ".(int) $user_id." and id = ".(int) $adid);
	}

	function editAd($id,$authorid){
		return $this->db->query("select * from carads_view where authorid = ".(int)$authorid." and id=".(int)$id." and (status = 1 or status = 0) ")->result_array();
	}
	function authorInfo($id){
		return $this->db->query("select * from user where id = ".(int)$id." ")->result_array();
	}
	function editAuthorInfo($posts, $authorid){
		$is_rent = @$posts['autosalon_type']==2?1:0;
		$is_salon = @$posts['autosalon_type']==1?1:0;

		$this->db->query("update user set
			vebsayt = '".@$posts['vebsayt']."',
			first_name = '".@$posts['ad']."',
			last_name = '".@$posts['soyad']."',
			mobile = '".@$posts['telefon']."',
			mobile2 = '".@$posts['telefon2']."',
			mobile3 = '".@$posts['telefon3']."',
			email = '".@$posts['email']."',
			shirketad = '".@$posts['shirketad']."',
			ishgunleri = '".@$posts['ishgunleri']."',
			etraflimelumat = '".@$posts['etraflimelumat']."',
			is_salon = ".$is_salon.",
			is_rent = ".$is_rent."
			where id = ".@(int)$authorid."
		");
	}


	function getAdsInfo($id){
		return $this->db->query("select o.*, a.pincode FROM `car_orders_view` as o LEFT JOIN carad as a on o.caradid = a.id where o.active = 1 and o.authorid = ".(int)$id." ")->result_array();
	}
	function getBalans($id){
		return $this->db->query("select authorid,salon ,SUM(CASE WHEN action in (3,5,20) THEN amount END) as plus, SUM(CASE WHEN action in (12,13,14,15,16,17,18,19) THEN amount END) as minus, COALESCE(SUM(case when action in (4) and salon = 1 then amount END),0) as ads FROM car_orders_view where authorid = ".(int)$id." and active = 1")->result_array();
	}
	function checkAuthorBalans($id,$salon){
		// $this->output->enable_profiler(true);
		if ($salon==0) {
			return $this->db->query("select count(id) as adcount, MIN(createdate) as mincreatedate, MIN(createdate) + INTERVAL 90 DAY as nextaddate FROM carad WHERE createdate BETWEEN NOW() - INTERVAL 90 DAY AND NOW() and authorid = ".(int)$id." and status in (0,1,2,4)")->result_array();
		} else {
			return $this->db->query("select authorid,salon ,SUM(CASE WHEN action in (3,5,20) THEN amount END) as plus, SUM(CASE WHEN action in (12,13,14,15,16,17,18,19) THEN amount END) as minus, COALESCE(SUM(case when action in (4) and salon = 1 then amount END),0) as ads FROM car_orders_view where authorid = ".(int)$id." and active = 1")->result_array();
		}
	}
	function checkMonth($id){
		return $this->db->query("select MAX(createdate) as createdate,DATE_ADD(createdate, INTERVAL 31 DAY) as nextdate from car_orders_view where authorid = ".(int)$id." and active = 1 and amount >=50")->row();
	}
	// return $this->db->query("select authorid,salon ,SUM(CASE WHEN action in (3) THEN amount END) as plus, SUM(CASE WHEN action in (1,2,5) THEN amount END) as minus FROM car_orders_view where authorid = ".(int)$id." and active = 1")->result_array();
	function checkAuthorPaket($id){
		return $this->db->query("select * from carpakets where authorid = ".(int)$id." and active=1")->result_array();
	}
	// function checkPaketActive($id){
	// 	return $this->db->query("select datediff(now(),MAX(createdate)) as days FROM `carpakets` where authorid = ".(int)$id." GROUP BY authorid")->row();
	// }
	function adsCountInPaket($id){
		return $this->db->query("select cp.authorid, cp.amount as paket, COUNT(co.id) as adscount FROM `carpakets` as cp
LEFT JOIN car_orders as co
on cp.authorid = co.authorid
where cp.authorid = ".(int)$id." and co.action = 5 and cp.active = 1 and co.active = 1")->result_array();
	}
	function getPendingPaket($id){
		return $this->db->query("select id from carpakets where authorid = ".(int)$id." and active = 2 ")->row_array();
	}
	function makeTopPlus($authorid,$adid,$cost,$currentDate){
		$this->db->query("insert into car_orders values(null, '".(int)$cost."','".(int)$authorid."','".$currentDate."','2','".(int)$adid."','1','".(int)$this->session->userdata('autosalon')."' )");
		return $id = $this->db->insert_id();
	}
	function makeTop($authorid,$adid,$cost,$currentDate){
		$this->db->query("insert into car_orders values(null, '".(int)$cost."','".(int)$authorid."','".$currentDate."','1','".(int)$adid."','1','".(int)$this->session->userdata('autosalon')."' )");
		return $id = $this->db->insert_id();
	}
	function increaseBalans($authorid,$amount,$currentDate){
		$this->db->query("insert into car_orders values(null, '".(int)$amount."','".(int)$authorid."','".$currentDate."','3','','1','".(int)$this->session->userdata('autosalon')."' )");
		return $id = $this->db->insert_id();
	}
	function getGoldPaket($authorid){
		$this->db->query("insert into car_orders values(null, '50','".(int)$authorid."','".date('Y-m-d H:i:s')."','5','','2','1' )");
		// $this->db->query("update user set autosalon = 1 where id = ".(int)$this->session->userdata('uid')." ");

		return $id = $this->db->insert_id();
	}
	function addGoldPaket($authorid){
		$this->db->query("insert into carpakets values(null, '".(int)$authorid."','5','".date('Y-m-d H:i:s')."','2','50')");
		$this->db->query("insert into car_orders values(null, '50','".(int)$authorid."','".date('Y-m-d H:i:s')."','5','','2','1' )");
		// $this->db->query("update user set autosalon = 1 where id = ".(int)$this->session->userdata('uid')." ");
		return $id = $this->db->insert_id();
	}
	function updateSalon($authorid){
		$this->db->query("update user set autosalon = 1 where id = ".(int)$authorid." ");
	}

	function getActiveAds($authorid){
		return $this->db->query("select count(id) as activeAds from carad where car_status = 0 and status = 1 and authorid = ".(int)$authorid." ")->result_array();
	}
	function getNonActiveAds($authorid){
		return $this->db->query("select count(id) as nonActiveAds from carad where (car_status = 1 or status = 2) and authorid=".(int)$authorid."")->result_array();
	}
	function updateAuthorPass($pass,$authorid){
		$this->db->query("update user set password = N'".$pass."' where id = ".(int)$authorid." ");
	}
	function updateAuthorLogo($authorid, $photoname){
		// $this->output->enable_profiler('true');
		$this->db->query("update user set logo = '".$photoname."' where id = ".(int)$authorid);
	}
	function updateAuthorAvatar($authorid, $photoname){
		// $this->output->enable_profiler('true');
		$this->db->query("update user set avatar = '".$photoname."' where id = ".(int)$authorid);
	}
	function getCurrentPassword($id){
		return $this->db->query("select password from user where id = ".(int)$id." ")->result_array();
	}
	function removeCar($adid,$authorid){
		$this->db->query("update carad set status = 4 where authorid = ".(int)$authorid." and id = ".(int)$adid." ");
		$ok = $this->db->affected_rows();
		if($ok){
			return 'RemoveSuccess';
		}
		else{
			return 'RemoveBad';
		}
	}

	function remove_rent_car($adid, $user_id)
	{
		$this->db->query("update rent_car set status = 4 where authorid = ".(int) $user_id." and id = ".(int) $adid);
		$ok = $this->db->affected_rows();

		return $ok?'RemoveSuccess':'RemoveBad';
	}

	function removeImage($id){
		$this->db->query("update carphoto set deleted = 1 where id = ".$id." ");
	}
	function getAdsPhotos($adid,$pincode){
		return $this->db->query("select * from carphoto where active = 1 and deleted = 0 and  caradid = ".(int)$adid." order by location  ")->result_array();
	}
	function getAuthorLastCarId($authorid){
		return $this->db->query("select max(id) as maxid from carad where authorid = ".(int)$authorid."  ")->row();
	}
	function uploadCarPhoto($path,$name,$carid,$authorid,$pincode,$location){
		$this->db->query("insert into carphoto values('null','".$name."','".$location."','".$carid."','1','0','".$pincode."')");
	}
	function photoLocation($pincode){
		return $this->db->query("select MAX(location) as location FROM `carphoto` where pincode = '".$pincode."' and active = 1 ")->row_array();
	}
	function changeImgOrder($posts){
		$this->db->query("update carphoto set location = ".(float)$posts['pos']." where id = ".(int)$posts['id']." ");
	}
	function addNewUser($username,$email,$phone,$passwd,$pincode,$autosalon){
		$this->db->query("
		insert into user values (
			null,
			'',
			'',
			'',
			N'".@$username."',
			'',
			'".@$email."',
			'".@md5($passwd)."',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'".@$phone."',
			'',
			'',
			'1',
			'',
			'',
			'',
			'',
			'1',
			'".date('Y-m-d H:i:s')."',
			'".@(int)$autosalon."',
			0,
			'',
			'',
			'',
			'0',
			''
			)");
			return $id = $this->db->insert_id();
	}
	function addNewCar($posts,$authorid){
		$this->db->query("
			insert into carad values (
				NULL,
				'0',
				'0000-00-00 00:00:00',
				'0',
				'0000-00-00 00:00:00',
				'0',
				'0000-00-00 00:00:00',
				'0',
				'0000-00-00 00:00:00',
				'0',
				'',
				'0',
				'".@$authorid."',
				'".@(int)$posts['mark']."',
				'".@(int)$posts['model']."',
				'".@(int)$posts['year']."',
				'".@(int)$posts['city']."',
				'".@(int)$posts['body']."',
				'".@(int)$posts['mileage']."',
				'".@$posts['fuel']."',
				'".@(int)$posts['engine']."',
				'".@$posts['transmission']."',
				'".@$posts['drive']."',
				'".@(int)$posts['color']."',
				'".@(int)$posts['interiorColor']."',
				'".@(int)$posts['credit']."',
				'".@(int)@$posts['barter']."',
				'".@(int)$posts['horsePower']."',
				'".@(int)@$posts['wheels']."',
				'".@(int)$posts['leatherSalon']."',
				'".@(int)$posts['parkingSensor']."',
				'".@(int)$posts['sunproof']."',
				'".@(int)$posts['camera']."',
				'".@(int)$posts['heatedseats']."',
				'".@(int)@$posts['centrallocking']."',
				'".@(int)$posts['abs']."',
				'".@(int)$posts['xenon']."',
				'".@(int)$posts['aircondition']."',
				'".@(int)@$posts['sensor']."',
				'".@(int)@$posts['sidecurtains']."',
				'".@(int)@$posts['seatventilation']."',
				'".@(int)$posts['esp']."',
				N'".@$posts['youtubeLink']."',
				N'".@$posts['additionalInfo']."',
				'".@(float)$posts['price']."',
				'".@(int)$posts['agreement']."',
				N'".@(int)$posts['currency']."',
				N'".@$posts['pincode']."',
				'0',
				'0',
				'".date("Y-m-d H:i:s")."'
				)
		");
		$id = $this->db->insert_id();

		$query = "UPDATE carphoto
							SET
								active = 1,
								caradid = ".$id."
							WHERE pincode = ".$posts['pincode'];

		$this->db->query($query);

		$query2 = "INSERT INTO car_orders (amount, authorid, createdate, action, caradid, active, salon)
							 VALUES (0.5, ".(int) $authorid.", '".date('Y-m-d H:i:s')."', 4, ".$id.", 1, ".(int)$this->session->userdata('autosalon').")";

		$this->db->query($query2);

		$ok = $this->db->affected_rows();
		return $ok?$id:'AddBad';
	}

	function editMyCar($posts){
		$this->db->query("update carad set
			mark = ".@(int)$posts['mark'].",
			model = ".@(int)$posts['model'].",
			year = ".@(int)$posts['year'].",
			city = ".@(int)$posts['city'].",
			body = ".@(int)$posts['body'].",
			mileage = ".@(int)$posts['mileage'].",
			fuel = N'".@$posts['fuel']."',
			engine = ".@(int)$posts['engine'].",
			transmission = N'".@$posts['transmission']."',
			drive = N'".@$posts['drive']."',
			color = ".@(int)$posts['color'].",
			interiorcolor = ".@(int)$posts['interiorColor'].",
			credit = ".@(int)$posts['credit'].",
			barter = ".@(int)$posts['barter'].",
			horsepower = ".@(int)$posts['horsePower'].",
			wheels = ".@(int)$posts['wheels'].",
			leather = ".@(int)$posts['leatherSalon'].",
			parkingsensor = ".@(int)$posts['parkingSensor'].",
			sunproof = ".@(int)$posts['sunproof'].",
			camera = ".@(int)$posts['camera'].",
			heatedseats = ".@(int)$posts['heatedseats'].",
			centrallocking = ".@(int)$posts['centrallocking'].",
			abs = ".@(int)$posts['abs'].",
			xenon = ".@(int)$posts['xenon'].",
			aircondition = ".@(int)$posts['aircondition'].",
			rainsensor = ".@(int)$posts['sensor'].",
			sidecurtains = ".@(int)$posts['sidecurtains'].",
			seatventilation = ".@(int)$posts['seatventilation'].",
			esp = ".@(int)$posts['esp'].",
			youtubelink = N'".@$posts['youtubeLink']."',
			additionalinfo = N'".@$posts['additionalInfo']."',
			price = ".@(int)$posts['price'].",
			agreement = ".@(int)$posts['agreement'].",
			currency = ".@$posts['currency']."
			WHERE
				id = ".(int)@$posts['adid']."
		");
		$this->db->query("update carphoto set active = 1, caradid = ".(int)@$posts['adid']." where pincode = '".@$posts['pincode']."'");

	}

	function select_result($table_name, $select)
  {
    $this->db->select($select);
    $this->db->from($table_name);
    return $this->db->get()->result();
  }
	function getMarkModels($id){
		return $this->db->query("select * from carmodel where markid = ".(int)$id." and active = 1 ")->result_array();
	}

	// function adscount($authorid){
	// 	return $this->db->query("select sum(amount) as adcount FROM `car_orders`
	// 	WHERE authorid = ".(int)$authorid." and action = 4 and salon=1
	// 		and createdate >= (SELECT min(createdate) as min_date FROM `carpakets`
	// 	                      WHERE authorid=".(int)$authorid." and TIMESTAMPDIFF(year, createdate, (SELECT MAX(createdate) FROM carpakets
	// 	                                                                               WHERE authorid=".(int)$authorid."
	// 	                                                                               GROUP BY authorid)) < 1
	// 	                      group by authorid)
	// 	GROUP BY authorid")->row();
	// }

	// function freeads($authorid){
	// 	return $this->db->query("select sum(amount) as paketscount FROM carpakets
	// 	WHERE authorid=".(int)$authorid." and createdate >= (SELECT min(createdate) as min_date FROM `carpakets`
	// 	                                      WHERE authorid=".(int)$authorid." and TIMESTAMPDIFF(year, createdate, (SELECT MAX(createdate) FROM carpakets
	// 	                                                                                               WHERE authorid=".(int)$authorid."
	// 	                                                                                               GROUP BY authorid)) < 1
	// 	                                      group by authorid)
	// 	GROUP BY authorid")->row();
	// }





}
