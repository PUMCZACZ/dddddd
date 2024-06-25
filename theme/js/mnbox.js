const lightBoxes = document.querySelectorAll('.mnbox')
lightBoxes.forEach( element => {
    const listItems = Array.from(element.children)
    const externals = document.querySelectorAll('.mn-external')

    externals.forEach( e => {
        listItems.unshift(e)
    })

    listItems.forEach( (li, index) =>
        li.addEventListener('click', () => {
            onElementClicked(appendExternalPhotos(element.cloneNode(true)), li, index)
        })
    )
})

function appendExternalPhotos(parent){
    document.querySelectorAll('.mn-external').forEach( e => {
        const external = e.cloneNode(true)
        const li = document.createElement('li')
        Array.from(external.children).forEach( child => {
            li.appendChild(child)
        })
        parent.insertBefore(li, parent.firstChild)
    })
    return parent
}

function onElementClicked(parent, li, number){
   const photo = li.querySelector('.mn-photo')
   const content = li.querySelector('.mn-content')
   const display = photo || content
   if(!document.querySelector('.mnbox-container'))
        showLightbox(parent)
   setDisplayContent(display.cloneNode(true), number)
}

function showLightbox(parent){
    const lightbox = document.createElement('div')
    lightbox.classList.add("mnbox-container")

    //przycisk wylaczania galerii oraz przycisk wiecej

    const buttons = document.createElement('div')
    buttons.classList.add('buttons')

    //przycisk wylacznia

    const exit = document.createElement('div')
    exit.classList.add('exitButton')
    const exitSvg = document.createElement('img')
    exitSvg.setAttribute('src', 'theme/js/x.svg')
    exit.appendChild(exitSvg)
    exit.addEventListener('click', () => closeLightbox())

    //przycisk wiecej

    const more = document.createElement('div')
    more.classList.add('moreButton')
    const moreSvg = document.createElement('img')
    moreSvg.setAttribute('src', 'theme/js/more.svg')
    more.appendChild(moreSvg)
    more.addEventListener('click', () => {
        showUserInfoMobile()
    })
    more.setAttribute('tabindex', "-1")

    buttons.appendChild(exit)
    buttons.appendChild(more)

    lightbox.appendChild(buttons)

    //przycisk przewijania w lewo

    const left = document.createElement('div')
    left.classList.add('left')
    const leftBtn = document.createElement('div')
    leftBtn.classList.add('leftBtn')
    leftBtn.addEventListener('click', () => onLeftBtnClicked(parent))
    const leftSVG = document.createElement('img')
    leftSVG.setAttribute('src', 'theme/js/rightarrow.svg')
    leftBtn.appendChild(leftSVG)
    left.appendChild(leftBtn)

    //przycisk przewijania w prawo

    const right = document.createElement('div')
    right.classList.add('right')
    const rightBtn = document.createElement('div')
    rightBtn.classList.add('rightBtn')
    rightBtn.addEventListener('click', () => onRightBtnClicked(parent))
    const rightSVG = document.createElement('img')
    rightSVG.setAttribute('src', 'theme/js/rightarrow.svg')
    rightBtn.appendChild(rightSVG)
    right.appendChild(rightBtn)

    //blok srodkowy ze zdjeciem

    const middleContainer = document.createElement('div')
    middleContainer.classList.add('middleContainer')

    const display = document.createElement('div')
    display.classList.add('display')

    //pomniejszona lista zdjec na dole

    const preview = document.createElement('div')
    preview.classList.add('preview')
    preview.appendChild(parent.cloneNode(true))

    Array.from(preview.querySelector('.mnbox').children).forEach( (li, index) =>
        li.addEventListener('click', () => {
            onElementClicked(parent, li, index)
    }))

    middleContainer.appendChild(display)
    middleContainer.appendChild(preview)

    //kolumna z komentarzami

    const column = document.createElement('div')
    column.classList.add('commentsColumn')

    const comments = document.createElement('div')
    comments.classList.add('comments')

    const cancelBtn = document.createElement('div')
    cancelBtn.classList.add('cancelBtn')
    cancelSvg = document.createElement('img')
    cancelSvg.setAttribute('src', 'theme/js/cancel.svg')
    cancelBtn.appendChild(cancelSvg)

    cancelBtn.addEventListener('click', () => {
        hideCommentsUserInfoMobile()
    })

    column.appendChild(cancelBtn)

    const userData = document.querySelector('#userData').cloneNode(true)
    userData.classList.remove('hide')
    userData.classList.add('user-data')

    //formularz wysylania

    const sendComment = document.createElement('form')

    const textarea = document.createElement('textarea')
    textarea.setAttribute('placeholder', "Napisz komentarz...")

    textarea.addEventListener('keypress', e => {
        if(e.keyCode === 13){
            e.preventDefault()
            if(textarea.value !== ''){
                fetchComment(textarea.value, getDisplayedImageId())
                textarea.value = ''
            }
        }
    })

    const submitButton = document.createElement('button')
    submitButton.setAttribute('type', 'submit')

    const em = document.createElement('em')
    em.classList.add('fa')
    em.classList.add('fa-send')

    submitButton.addEventListener('click', e => {
        e.preventDefault()
        if(textarea.value != ''){
            fetchComment(textarea.value, getDisplayedImageId())
            textarea.value = ''
        }
    })

    submitButton.appendChild(em)

    sendComment.appendChild(textarea)
    sendComment.appendChild(submitButton)

    column.appendChild(userData)
    column.appendChild(comments)
    column.appendChild(sendComment)

    lightbox.appendChild(left)
    lightbox.appendChild(middleContainer)
    lightbox.appendChild(right)
    lightbox.appendChild(column)

    document.querySelector('body').appendChild(lightbox)
}

function getLikesNumber(){
    const mnbox = document.querySelector('.mnbox-container')
    const display = mnbox.querySelector('.display')
    const content = display.querySelector('.mn-photo') || display.querySelector('.mn-content')

    return content.getAttribute('likes')
}

function showUserInfoMobile(){
    const mnbox = document.querySelector('.mnbox-container')
    const mobileUserInfo = mnbox.querySelector('.mobileUserInfo')
    const doesUserExist = mobileUserInfo ? true : false

    if(doesUserExist){
        hideUserInfoMobile()
    } else{
        const userinfo = document.createElement('div')
        userinfo.classList.add('mobileUserInfo')
        userinfo.setAttribute('tabindex', '-1')

        const userData = document.querySelector('#userData').cloneNode(true)
        userData.classList.remove('hide')
        const likesCounter = userData.querySelector('#counter')
        likesCounter.textContent = getLikesNumber()

        userinfo.appendChild(userData)

        const showCommentsBtn = document.createElement('button')
        showCommentsBtn.classList.add('showCommentsBtn')
        showCommentsBtn.textContent = 'Komentarze'

        showCommentsBtn.addEventListener('click', () => {
            showCommentsUserInfoMobile()
        })

        userinfo.addEventListener('focusout', e => {
            if(! (e.relatedTarget && ( userinfo.contains(e.relatedTarget) || e.relatedTarget.classList[0] === 'moreButton') ) )
                hideUserInfoMobile()
        })

        userinfo.appendChild(showCommentsBtn)
        mnbox.appendChild(userinfo)

        userinfo.focus()
    }
}

function hideUserInfoMobile(){
    const mnbox = document.querySelector('.mnbox-container')
    const mobileUserInfo = mnbox.querySelector('.mobileUserInfo')
    mnbox.removeChild(mobileUserInfo)
}

function showCommentsUserInfoMobile(){
    const mnbox = document.querySelector('.mnbox-container')
    const column = mnbox.querySelector('.commentsColumn')

    column.classList.add('showMobile')
}

function hideCommentsUserInfoMobile(){
    const mnbox = document.querySelector('.mnbox-container')
    const column = mnbox.querySelector('.commentsColumn')

    column.classList.remove('showMobile')
}

function closeLightbox(){
    const lightbox = document.querySelector('.mnbox-container')
    lightbox.parentNode.removeChild(lightbox)
}

function setDisplayContent(content, number){
    const mnbox = document.querySelector('.mnbox-container')

    const display = mnbox.querySelector('.display')
    display.innerHTML = ''
    display.setAttribute('display', number)
    display.appendChild(content)

    //licznik serduszek

    const userData = mnbox.querySelector('.user-data')
    const likesCounter = userData.querySelector('#counter')
    likesCounter.textContent = getLikesNumber()

    const dbId = content.getAttribute('dbId')
    if(dbId)
        getComments(dbId)
    else hideComments()

    deleteMatchBorder()
    matchElementNumber(number)
}

function hideComments(){
    const mnboxContainer = document.querySelector(".mnbox-container")
    mnboxContainer.classList.add('hide-comments')
}

function deleteMatchBorder(){
    const mnbox = document.querySelector('.mnbox-container')
    const middleContainer = mnbox.querySelector('.middleContainer')
    const preview = middleContainer.querySelector('.preview')
    Array.from(preview.children[0].children).forEach( e => e.classList.remove('match'))
}

function matchElementNumber(number){
    const mnbox = document.querySelector('.mnbox-container')
    const middleContainer = mnbox.querySelector('.middleContainer')
    const preview = middleContainer.querySelector('.preview')
    preview.children[0].children[number].classList.add('match')
}

function onRightBtnClicked(parent){
    const len = parent.children.length
    const display = document.querySelector('.mnbox-container').querySelector('.display')
    let number = display.getAttribute('display')
    number++
    if(number <= len - 1){
        onElementClicked(parent, parent.children[number], number)
    }
}

function onLeftBtnClicked(parent){
    const display = document.querySelector('.mnbox-container').querySelector('.display')
    let number = display.getAttribute('display')
    number--
    if(number >= 0){
        onElementClicked(parent, parent.children[number], number)
    }
}

function getComments(id){
    fetch(`funcs.php?name=profile&file=comments&id=${id}`, {
        method: 'get'
    }).then( res => {
        res.json()
            .then( data =>
                showComments(data)
            )
    }).catch( err => {
        console.log("Wystąpił bład podczas zapytania")
    })
}

function showComments(comments){
    const mnboxContainer = document.querySelector('.mnbox-container')
    mnboxContainer.classList.remove('hide-comments')
    const commentsSection = mnboxContainer.querySelector('.comments')
    commentsSection.innerHTML = ''
    comments.forEach( comment => {
        const commentContainer = document.createElement('div')
        commentContainer.classList.add('commentContainer')

        const leftPanel = document.createElement('div')
        leftPanel.classList.add("left")

        const profilePhoto = document.createElement('div')
        profilePhoto.classList.add('profilePhoto')

        const profileImg = document.createElement('img')
        profileImg.setAttribute('src', comment.profile_photo || 'http://piq.codeus.net/static/media/userpics/piq_134712_400x400.png')

        profilePhoto.appendChild(profileImg)
        leftPanel.appendChild(profilePhoto)

        leftPanel.appendChild(profilePhoto)

        const rightPanel = document.createElement('div')
        rightPanel.classList.add('right')

        const commentHeader = document.createElement('div')
        commentHeader.classList.add('commentHeader')

        const username = document.createElement('p')
        username.classList.add('username')
        username.textContent = comment.username
        username.href = 'funcs.php?name=profile&id='+comment.user_id;

        const age = document.createElement('p')
        age.classList.add('age')
        age.textContent = comment.age

        commentHeader.appendChild(username)
        commentHeader.appendChild(age)

        const commentContent = document.createElement('div')
        commentContent.classList.add('commentContent')

        const content = document.createElement('p')
        content.classList.add('content')
        content.textContent = comment.comment

        const date = document.createElement('p')
        date.classList.add('date')
        date.textContent = comment.date

        commentContent.appendChild(content)
        commentContent.appendChild(date)

        rightPanel.appendChild(commentHeader)
        rightPanel.appendChild(commentContent)

        commentContainer.appendChild(leftPanel)
        commentContainer.appendChild(rightPanel)

        commentsSection.appendChild(commentContainer)
    })
}

function getDisplayedImageId(){
    const display = document.querySelector('.mnbox-container').querySelector('.display')
    const element = display.querySelector('.mn-photo') || display.querySelector('.mn-content')
    return element.getAttribute('dbId')
}

function fetchComment(content, imageId){
    const headers = new Headers()
    const data = {photo_id: imageId, content: content}

    const formData = new FormData()
    formData.append('add_comment', JSON.stringify(data))

    fetch('funcs.php?name=profile&file=add_comments', {
        credentials: 'same-origin',
        method: 'POST',
        headers,
        body: formData
    })
    .then( res =>
        res.json()
            .then( data => {
                console.log(data)
                if(data.success)
                    getComments(imageId)
                else
                    console.log('Blad podczas dodawania komentarza')
            })
            .catch(err => {
                console.log(err)
            })
    )
    .catch( err => {
        console.log(err)
    })
}
