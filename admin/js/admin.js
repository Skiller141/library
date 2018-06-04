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
