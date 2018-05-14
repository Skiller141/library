
document.getElementById('btn').addEventListener('click', function () {
    var ID = function () {
        return '_' + Math.random().toString(36).substr(2, 9);
    };
    document.getElementsByName('random')[0].value = ID();
});

let myArr = [];
let catInp = document.getElementsByName('categories')[0];
document.getElementsByClassName('addCatBtn')[0].addEventListener('click', () => {
    catInpValue = catInp.value.toLowerCase();
    catInpValue = catInpValue[0].toUpperCase() + catInpValue.slice(1);
    // console.log(catInpValue);

    for (var key in myArr) {
        if (myArr[key] === catInpValue) {
            alert('Вы уже выбрали такую категорию!');
            return false;
        }
    }

    myArr.push(catInpValue);
    console.log(myArr);

    let tCat = document.createElement('span');
    tCat.classList.add('tCat', 'alert', 'alert-dark', 'alert-dismissible', 'fade', 'show');
    tCat.setAttribute('role', 'alert');
    tCat.innerHTML = catInpValue;
    document.getElementsByClassName('addCatContaner')[0].appendChild(tCat);

    let closeBtn = document.createElement('button');
    closeBtn.type = "button";
    closeBtn.classList.add('close', 'catClose');
    closeBtn.name = 'closeBtn';
    closeBtn.setAttribute('data-dismiss', 'alert');
    closeBtn.setAttribute('aria-label', 'Close');
    closeBtn.setAttribute('myattr', catInpValue);
    tCat.appendChild(closeBtn);
    closeBtn.onclick = closeClick;

    let closeIcon = document.createElement('span');
    closeIcon.setAttribute('aria-hidden', 'true');
    closeIcon.innerHTML = '&times;';
    closeBtn.appendChild(closeIcon);

    let hiddenCatInput = document.createElement('input');
    hiddenCatInput.type = "hidden";
    hiddenCatInput.classList.add('hiddenCatInp');
    hiddenCatInput.name = "hiddenCatInput[]";
    hiddenCatInput.value = catInpValue;
    document.getElementsByClassName('addCatContaner')[0].appendChild(hiddenCatInput);

    catInp.value = "";
});

function closeClick() {
    var index = myArr.indexOf(this.getAttribute('myattr'));
    var hiddenInp = document.getElementsByClassName('hiddenCatInp');

    myArr.splice(index, 1);
    hiddenInp[index].remove();
}

document.forms['addBookForm'].addEventListener('submit', function () {
    $('#exampleModal').modal('hide');
});
