let catCheckBox = document.getElementsByClassName('catCheckBox');
let catCheckBoxLabel = document.getElementsByClassName('catCheckBoxLabel');
for (var i = 0; i < catCheckBox.length; i++) {
    catCheckBox[i].addEventListener('change', function() {
        if (this.checked == true) {
            catCheckBoxLabel[this.getAttribute('catIndex')].style.fontWeight = 'bold';
            catCheckBoxLabel[this.getAttribute('catIndex')].style.color = 'green';
        } else {
            catCheckBoxLabel[this.getAttribute('catIndex')].style.fontWeight = 'normal';
            catCheckBoxLabel[this.getAttribute('catIndex')].style.color = 'black';
        }
    });
}

let catOut = document.getElementsByClassName('catOut')[0];
if (catOut != undefined) {
    catOut.innerHTML = catOut.innerHTML.slice(0, catOut.innerHTML.lastIndexOf(','));
}

let headingOne = document.getElementById('headingOne');
let n = 0;
let myArrow = document.getElementsByClassName('myArrow')[0];
headingOne.addEventListener('click', function() {
    // console.log(++n);
    if (n++ % 2) {
        console.log(n + ': четное');
        myArrow.classList.replace('fa-sort-up', 'fa-sort-down');
        myArrow.style.marginTop = '0';
        this.style.background = '#eee';
    } else {
        console.log(n + ': нечетное');
        myArrow.classList.replace('fa-sort-down', 'fa-sort-up');
        myArrow.style.marginTop = '5px';
        this.style.background = '#DEDBD3';
    }
});
