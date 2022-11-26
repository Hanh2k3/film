function display1(tab, tab_item) {
   
    var list_tab = document.getElementsByClassName('tab')
    for(var i = 0; i < list_tab.length; i++) {
        list_tab[i].classList.remove('tab-active')
    }
 
    var t = tab
    t.classList.add('tab-active')


    var list_content = document.getElementsByClassName('tab-item')
    console.log(list_content)
    for(var i = 0; i < list_content.length; i++) {
        list_content[i].classList.add('un_active')
    } 
    var t = document.getElementById(tab_item)
    t.classList.remove('un_active')

}


function hide(t) {
    t.classList.add('un_active');
    var ac = document.getElementById('bu')
    ac.classList.remove('ac')
    var navbar = document.getElementById('navbar')
    navbar.classList.remove('acti')
}

function visible(t) {
    t.classList.remove('un_active')
    var ac = document.getElementById('bu')
    ac.classList.add('ac')
    var navbar = document.getElementById('navbar')
    navbar.classList.add('acti')
}
function toggle() {
    var t = document.getElementById('drop')
    var check = window.getComputedStyle(t).display
    if(check === 'none') visible(t)
    else hide(t)
    
}

// display information account 
function display_account() {
    var acc = document.getElementById('account'); 
    var display_account = document.getElementById('display_account');
    var hide_account = document.getElementById('hide_account');

    display_account.style.display = 'none'; 
    hide_account.style.display = 'block'; 
    acc.style.display = 'flex'; 

}

function hide_account() {
    var acc = document.getElementById('account'); 
    var display_account = document.getElementById('display_account');
    var hide_account = document.getElementById('hide_account');

    display_account.style.display = 'block'; 
    hide_account.style.display = 'none'; 
    acc.style.display = 'none';

}