<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Users API</title>
<style>
*{box-sizing:border-box}body{font-family:Arial,Helvetica,sans-serif;background:#f4f6f9;margin:0;padding:30px}
.container{max-width:1200px;margin:auto;background:#fff;padding:25px;border-radius:12px;box-shadow:0 5px 20px rgba(0,0,0,.08)}
h2{text-align:center;margin-bottom:25px}.btn-tambah{background:#198754;color:#fff;border:0;padding:10px 18px;border-radius:6px;cursor:pointer;margin-bottom:15px}
.btn-tambah:hover{background:#157347}table{width:100%;border-collapse:collapse}th{background:#0d6efd;color:#fff;padding:12px;border:1px solid #ddd}td{padding:10px;border:1px solid #ddd}
tr:nth-child(even){background:#f8f9fa}tr:hover{background:#eef5ff}.center{text-align:center}.btn{border:0;padding:7px 12px;border-radius:5px;cursor:pointer;color:#fff;margin:2px}
.edit{background:#ffc107;color:#000}.hapus{background:#dc3545}.loading{text-align:center;color:#0d6efd;font-weight:bold}
.modal{display:none;position:fixed;z-index:999;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,.5)}
.modal-content{background:#fff;width:500px;max-width:90%;margin:5% auto;padding:25px;border-radius:10px}
.modal-content h3{margin-top:0}.form-group{margin-bottom:12px}.form-group label{display:block;margin-bottom:5px;font-weight:bold}
.form-group input{width:100%;padding:9px;border:1px solid #ccc;border-radius:5px}.btn-simpan,.btn-batal{color:#fff;border:0;padding:10px 18px;border-radius:5px;cursor:pointer}
.btn-simpan{background:#0d6efd}.btn-batal{background:#6c757d}
</style>
</head>
<body>
<div class="container">
<h2>Data Users dari JSON API</h2>
<button class="btn-tambah" onclick="tambahData()">+ Tambah Data</button>
<table>
<thead><tr><th width="70">NO / ID</th><th>NAMA</th><th>EMAIL</th><th>ALAMAT</th><th width="170">AKSI</th></tr></thead>
<tbody id="hasil"><tr><td colspan="5" class="loading">Memuat data...</td></tr></tbody>
</table>
</div>

<div id="modal" class="modal">
<div class="modal-content">
<h3 id="judulModal">Tambah Data</h3>
<input type="hidden" id="id">
<div class="form-group"><label>Nama</label><input type="text" id="name"></div>
<div class="form-group"><label>Username</label><input type="text" id="username"></div>
<div class="form-group"><label>Email</label><input type="email" id="email"></div>
<div class="form-group"><label>Street</label><input type="text" id="street"></div>
<div class="form-group"><label>Suite</label><input type="text" id="suite"></div>
<div class="form-group"><label>City</label><input type="text" id="city"></div>
<div class="form-group"><label>Zipcode</label><input type="text" id="zipcode"></div>
<br>
<button class="btn-simpan" onclick="simpanData()">Simpan</button>
<button class="btn-batal" onclick="tutupModal()">Batal</button>
</div>
</div>

<script>
const API="http://localhost/apireva/users.php";

function loadData(){
fetch(API).then(r=>r.json()).then(data=>{
let html="";
if(!data.length) html='<tr><td colspan="5" class="center">Belum ada data</td></tr>';
else data.forEach(item=>{
html+=`<tr>
<td class="center">${item.id}</td><td>${item.name}</td><td>${item.email}</td>
<td>${item.address.street}, ${item.address.suite}, ${item.address.city}, ${item.address.zipcode}</td>
<td class="center">
<button class="btn edit" onclick='editData(${JSON.stringify(item).replace(/'/g,"&#39;")})'>Edit</button>
<button class="btn hapus" onclick="hapusData(${item.id})">Hapus</button>
</td></tr>`;
});
document.getElementById("hasil").innerHTML=html;
}).catch(error=>{
document.getElementById("hasil").innerHTML='<tr><td colspan="5" style="color:red;text-align:center">Gagal mengambil data API</td></tr>';
console.log(error);
});
}

function tambahData(){
document.getElementById("judulModal").innerText="Tambah Data";
["id","name","username","email","street","suite","city","zipcode"].forEach(x=>document.getElementById(x).value="");
document.getElementById("modal").style.display="block";
}

function editData(item){
document.getElementById("judulModal").innerText="Edit Data";
document.getElementById("id").value=item.id;
document.getElementById("name").value=item.name;
document.getElementById("username").value=item.username;
document.getElementById("email").value=item.email;
document.getElementById("street").value=item.address.street;
document.getElementById("suite").value=item.address.suite;
document.getElementById("city").value=item.address.city;
document.getElementById("zipcode").value=item.address.zipcode;
document.getElementById("modal").style.display="block";
}

function simpanData(){
const id=document.getElementById("id").value;
const data={
id:id,name:document.getElementById("name").value,username:document.getElementById("username").value,
email:document.getElementById("email").value,street:document.getElementById("street").value,
suite:document.getElementById("suite").value,city:document.getElementById("city").value,
zipcode:document.getElementById("zipcode").value
};
fetch(API,{method:id===""?"POST":"PUT",headers:{"Content-Type":"application/json"},body:JSON.stringify(data)})
.then(r=>r.json()).then(result=>{alert(result.message);if(result.success){tutupModal();loadData();}})
.catch(e=>{console.log(e);alert("Terjadi kesalahan");});
}

function hapusData(id){
if(!confirm("Apakah Anda yakin ingin menghapus data ini?")) return;
fetch(API,{method:"DELETE",headers:{"Content-Type":"application/json"},body:JSON.stringify({id:id})})
.then(r=>r.json()).then(result=>{alert(result.message);if(result.success)loadData();})
.catch(e=>{console.log(e);alert("Gagal menghapus data");});
}

function tutupModal(){document.getElementById("modal").style.display="none";}
loadData();
</script>
</body>
</html>
