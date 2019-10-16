//[vanila javascript]
// let mahasiswa = {
// 	nama : "Anton Purnama",
// 	nim : "312015051",
// 	email : "masantonpurnama@gmail.com"

// }

// console.log(JSON.stringify(mahasiswa));

// let xhr = new XMLHttpRequest();
// xhr.onreadystatechange = function () {
// 	if (xhr.readyState == 4 && xhr.status == 200) {
// 		let mahasiswa = JSON.parse(this.responseText);
// 		console.log(mahasiswa);
// 	}
// }

// xhr.open('GET', 'coba.json', true);
// xhr.send();

// stringify = dari objek ke json
// parse = dari json ke objek

//[jquery]

$.getJSON('coba.json', function(data){
	console.log(data);
})