var req = new XMLHttpRequest()
req.open('GET', 'select.php', true)
// If specified, responseType must be empty string or "text"
req.responseType = 'text'
req.onload = function () {
  if (this.readyState === this.DONE) {
    if (this.status === 200) {
      // console.log([this.response])
      var myData = JSON.parse(this.response)
      console.log(myData);
      let divContaner = document.getElementsByClassName('card-contaner')[0]

      for (var key in myData) {
        let divCard = []
        divCard[key] = document.createElement('div')
        divCard[key].classList.add('card', 'm-3', 'clearfix')
        divCard[key].style = 'width: 18rem; display: inline-block'
        divContaner.appendChild(divCard[key])

        let listGroup = []
        listGroup[key] = document.createElement('ul')
        listGroup[key].classList.add('list-group', 'list-group-flush')
        divCard[key].appendChild(listGroup[key])

        let cardImg = []
        cardImg[key] = document.createElement('img')
        cardImg[key].classList.add('card-img-top')
        cardImg[key].alt = 'Card image cap'
        cardImg[key].src = myData[key].b_poster
        cardImg[key].style.height = '200px'
        listGroup[key].appendChild(cardImg[key])

        let cardTitle = []
        cardTitle[key] = document.createElement('h5')
        cardTitle[key].classList.add('card-title', 'list-group-item')
        cardTitle[key].innerHTML = myData[key].b_title
        listGroup[key].appendChild(cardTitle[key])

        let author = []
        author[key] = document.createElement('li')
        author[key].classList.add('list-group-item')
        author[key].innerHTML = myData[key].b_author
        listGroup[key].appendChild(author[key])

        let year = []
        year[key] = document.createElement('li')
        year[key].classList.add('list-group-item')
        year[key].innerHTML = myData[key].b_year
        listGroup[key].appendChild(year[key])

        let cardText = []
        cardText[key] = document.createElement('p')
        cardText[key].classList.add('list-group-item')
        cardText[key].innerHTML = myData[key].b_description.slice(0, 255) + '...'
        cardText[key].style.fontSize = '14px'
        listGroup[key].appendChild(cardText[key])

        let linkMore = []
        linkMore[key] = document.createElement('a')
        linkMore[key].innerHTML = 'Подробнее'
        linkMore[key].classList.add('btn', 'btn-success', 'btnMore')
        linkMore[key].setAttribute('href', 'full.php?id=' + myData[key].id)
        listGroup[key].appendChild(linkMore[key])
      }
    }
  }
}
req.send(null)

// var test = document.getElementById('test');
// console.log(test.innerText.lastIndexOf(','));
// test.innerText = test.innerText.slice(0, test.innerText.lastIndexOf(','));
