// var req = new XMLHttpRequest()
// req.open('GET', 'select.php?select=book', true)
// // If specified, responseType must be empty string or "text"
// req.responseType = 'text'
// req.onload = function () {
//   if (this.readyState === this.DONE) {
// 		if (this.status === 200) {
// 			// console.log([this.response])
// 			var myData = JSON.parse(this.response)
// 			//console.log(myData);
// 			let divContaner = document.getElementsByClassName('card-contaner');

// 		let horizontalCard = [];
// 		let poster;
// 			for (var key in myData) {
// 				horizontalCard[key] = document.createElement('div');
// 				horizontalCard[key].classList.add('mycard', 'col-md-12');
// 				if (myData[key].b_poster.length == 0) {
// 					poster = 'http://www.artistsimageresource.org/Wordpress/wp-content/themes/dante/images/default-thumb.png';
// 				} else {
// 					poster = myData[key].b_poster;
// 				}
// 				horizontalCard[key].innerHTML = `
// 					<div class="poster col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3" style="background: url('` + poster + `'); background-size: 100% 100%;"></div>
// 					<div class="short-info col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
// 						<div class="item"><i class="fa fa-book icons" aria-hidden="true"></i><b>Книга:</b> ` + myData[key].b_title + `</div>
// 						<div class="item"><i class="fa fa-user-o icons" aria-hidden="true"></i><b>Автор:</b> ` + myData[key].b_author + `</div>
// 						<div class="item category"><i class="fa fa-code-fork icons" aria-hidden="true"></i><b>Категории:</b> Фантастика, Космос, Сатира</div>
// 						<div class="item"><i class="fa fa-calendar icons" aria-hidden="true"></i><b>Год:</b> ` + myData[key].b_year + `</div>
// 						<div class="item"><i class="fa fa-eye icons" aria-hidden="true"></i><b>Серия:</b> Автостопом по Галактике</div>
// 						<div class="item"><i class="fa fa-file-text-o icons" aria-hidden="true"></i><b>Описание:</b> ` + myData[key].b_description.slice(0, 255) + '...' + `</div>
// 						<a href="full.php?id=` + myData[key].id + `" class="btn btn-success float-right">Подробнее</a>
// 					</div>
// 				`;
// 				divContaner[0].appendChild(horizontalCard[key]);
// 			}
// 		}
//   }
// }
// req.send(null)

var str1 = $('#myText').html();
var str2 = str1.split(' ');


for (var key in str2) {
  if (str2[key] === '<h1>Chapter') {
	str2[key] = str2[key] + ' ' + str2[++key];
	//console.log(str2[--key]);
	// $('#myText > h1').css('color', 'red');
	// document.getElementById('myChapters').innerHTML += '<a href="#">' + str2[key].getElementsByTagName('h1')[key].innerHTML +'</a>'
	str2.splice(key, 1);
  }
}

var myTextH1 = document.querySelectorAll('#myText > h1');
for (var i = 0; i < myTextH1.length; i++) {
  myTextH1[i].style.color = 'red';
  document.getElementById('myChapters').innerHTML += '<a href="#">' + myTextH1[i].innerHTML + '</a>'
}

var arr = ['one', 'two', 'three', 'two', 'six'];
arr.forEach((item, i, arr) => {
  console.log(item);
});

var filter = arr.filter((item, i , arr) => {
  return item.length > 3;
});
console.log(filter);

var map = arr.map((item, i, arr) => {
  if (item === 'one') {
	return item + ' hundred';
  }
  return item + ' hundreds';
});
console.log(map);

var reduce = arr.reduce((previousValue, currentItem) => {
  return previousValue + ', ' + currentItem;
});
console.log(reduce);

document.forms['regForm'].addEventListener('submit', function(e) {
    let xhr = new XMLHttpRequest();
    let formData = new FormData(this);
    xhr.open(this.method, this.action);
    xhr.addEventListener('load', function() {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
            if (this.responseText == 1) {
                $('#exampleModalCenter').modal('hide');
                location.reload();
            } else {
                document.querySelector('.myAlert').innerHTML = this.responseText;
            }
        }
    });
    xhr.send(formData);
    e.preventDefault();
});

document.querySelector('#loginBtn').addEventListener('click', () => {
    document.querySelector('#exampleModalLongTitle').innerHTML = 'Login';
    document.querySelector('#emailHelp').innerHTML = '';
    document.querySelector('#submitRegister').innerHTML = 'Login';
    document.forms['regForm'].action = 'login.php';
});

document.querySelector('#registerBtn').addEventListener('click', () => {
    document.querySelector('#exampleModalLongTitle').innerHTML = 'Resiter';
    document.querySelector('#emailHelp').innerHTML = 'We\'ll never share your email with anyone else.';
    document.querySelector('#submitRegister').innerHTML = 'Register';
    document.forms['regForm'].action = 'register.php';
});

// const myObg = {
//     days: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
//     months: ['January', 'February', 'Marth', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
//     myDate: () => {
//         let initDate = new Date();
//         return {
//             year: initDate.getFullYear(),
//             month: initDate.getMonth(),
//             date: initDate.getDate(),
//             day: initDate.getDay(),
//             hours: initDate.getHours(),
//             minutes: initDate.getMinutes(),
//             seconds: initDate.getSeconds()
//         };
//     },
//     hello: function(name) {
//         return 'Hello ' + name + ' today is ' + this.myDate().date + ' ' + this.months[this.myDate().month] + ' (' + this.days[--this.myDate().day] + ') ' + this.myDate().year + ' ' + this.myDate().hours + ':' + this.myDate().minutes;
//     }
// }

// console.log(myObg.hello('Alexey'));
