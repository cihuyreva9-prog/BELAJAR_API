<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once "koneksi.php";

$method=$_SERVER["REQUEST_METHOD"];

if($method==="GET"){
$result=$conn->query("SELECT * FROM users ORDER BY id ASC");
$data=[];
while($row=$result->fetch_assoc()){
$data[]=[
"id"=>(int)$row["id"],"name"=>$row["name"],"username"=>$row["username"],"email"=>$row["email"],
"address"=>["street"=>$row["street"],"suite"=>$row["suite"],"city"=>$row["city"],"zipcode"=>$row["zipcode"]]
];
}
echo json_encode($data); exit;
}

if($method==="POST"){
$input=json_decode(file_get_contents("php://input"),true);
$name=$input["name"]??"";$username=$input["username"]??"";$email=$input["email"]??"";
$street=$input["street"]??"";$suite=$input["suite"]??"";$city=$input["city"]??"";$zipcode=$input["zipcode"]??"";
$result=$conn->query("SELECT MAX(id) AS max_id FROM users");$row=$result->fetch_assoc();$id=((int)$row["max_id"])+1;
$stmt=$conn->prepare("INSERT INTO users(id,name,username,email,street,suite,city,zipcode) VALUES(?,?,?,?,?,?,?,?)");
$stmt->bind_param("isssssss",$id,$name,$username,$email,$street,$suite,$city,$zipcode);
echo json_encode(["success"=>$stmt->execute(),"message"=>$stmt->execute()?"Data berhasil ditambahkan":"Data gagal ditambahkan"]); exit;
}

if($method==="PUT"){
$input=json_decode(file_get_contents("php://input"),true);
$id=$input["id"]??0;$name=$input["name"]??"";$username=$input["username"]??"";$email=$input["email"]??"";
$street=$input["street"]??"";$suite=$input["suite"]??"";$city=$input["city"]??"";$zipcode=$input["zipcode"]??"";
$stmt=$conn->prepare("UPDATE users SET name=?,username=?,email=?,street=?,suite=?,city=?,zipcode=? WHERE id=?");
$stmt->bind_param("sssssssi",$name,$username,$email,$street,$suite,$city,$zipcode,$id);
$ok=$stmt->execute(); echo json_encode(["success"=>$ok,"message"=>$ok?"Data berhasil diperbarui":"Data gagal diperbarui"]); exit;
}

if($method==="DELETE"){
$input=json_decode(file_get_contents("php://input"),true);$id=$input["id"]??0;
$stmt=$conn->prepare("DELETE FROM users WHERE id=?");$stmt->bind_param("i",$id);
$ok=$stmt->execute(); echo json_encode(["success"=>$ok,"message"=>$ok?"Data berhasil dihapus":"Data gagal dihapus"]); exit;
}

echo json_encode(["success"=>false,"message"=>"Method tidak tersedia"]);
$conn->close();
?>