let categories = document.getElementById('categories');
let catOut = document.getElementsByClassName('catOut')[0];
let myArr = [];
categories.addEventListener('change', function () {
    let index = this.options.selectedIndex;
    console.log(this.options[index].text);
    catOut.innerHTML += this.options[index].text + ' ';
    // myArr.push(this.options[index].text);
    // catOut.innerHTML = catOut.innerHTML.slice(0, catOut.innerHTML.lastIndexOf(', '));
    // myArr.map(function(item) {
    //     return item + ', ';
    // });
    // console.log(myArr);
    // for (var i = 0; i < myArr.length; i++) {
    //     catOut.innerHTML = myArr[i];
    // }
    // catOut.innerHTML = catOut.innerHTML.slice(0, catOut.innerHTML.lastIndexOf(', '));
    // let newArr = myArr.reduce(function (total, currentValue, index, arr) {
    //     return currentValue += ', ';
    // },[]);
    // catOut.innerHTML += newArr;
    // catOut.innerHTML = catOut.innerHTML.slice(0, catOut.innerHTML.lastIndexOf(', '));
    // console.log(newArr);
});
