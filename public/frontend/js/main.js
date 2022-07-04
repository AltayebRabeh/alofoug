let navbar = document.querySelector('.navbar'),
    navbarBrand = document.querySelector('.navbar-brand'),
    navbarToggler = document.querySelector('.navbar-toggler'),
    popup = document.querySelector('.popup');

navbarToggler.onclick = () => {
    if (navbarToggler.classList.contains('collapsed')) {
        navbarToggler.classList.remove('open');
    } else {
        navbarToggler.classList.add('open');
    }
}

document.body.onscroll = () => {
    if (scrollY > 50) {
        navbarBrand.classList.remove('d-sm-block', 'd-md-none');
        navbar.classList.add('shadow');
    } else {
        navbarBrand.classList.add('d-sm-block', 'd-md-none');
        navbar.classList.remove('shadow');
    }

    if (scrollY > 400) {
        popup.classList.remove('d-none');
    } else {
        popup.classList.add('d-none');
    }

}

popup.onclick = () => {
    scroll(0, 0);
}