let catCheckBox = document.getElementsByClassName('catCheckBox');
let catCheckBoxLabel = document.getElementsByClassName('catCheckBoxLabel');
for (var i = 0; i < catCheckBox.length; i++) {
    catCheckBox[i].addEventListener('change', function() {
        if (this.checked == true) {
            catCheckBoxLabel[this.value].style.fontWeight = 'bold';
            catCheckBoxLabel[this.value].style.color = 'green';
        } else {
            catCheckBoxLabel[this.value].style.fontWeight = 'normal';
            catCheckBoxLabel[this.value].style.color = 'black';
        }
    });
}

let catOut = document.getElementsByClassName('catOut')[0];
catOut.innerHTML = catOut.innerHTML.slice(0, catOut.innerHTML.lastIndexOf(','));
