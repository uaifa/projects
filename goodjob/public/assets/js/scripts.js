/*!
 * Start Bootstrap - Simple Sidebar v6.0.3 (https://startbootstrap.com/template/simple-sidebar)
 * Copyright 2013-2021 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-simple-sidebar/blob/master/LICENSE)
 */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});




function showFirstDiv(cname, message) {
    var popdiv = '<a href="javascript:void(0)" class="closePopOver">✕</a><div class="bubble">' + message + '</div>';

    var div = document.createElement("div");
    div.innerHTML = popdiv;
    div.className = 'nav-popover';

    document.querySelector("." + cname).appendChild(div);


    var overlay = document.createElement("div");

    overlay.className = 'overlay';
    document.getElementById("page-content-wrapper").appendChild(overlay)
    //var popover = new bootstrap.Popover(document.querySelector('.navemp'), {
    //    container: 'body'
    //})
}

//showFirstDiv("navemp", "First, create an employee.");
//showFirstDiv("navjobs", "and give him some work");


const clsPop = document.querySelector(".closePopOver");
clsPop.addEventListener("click", function (e) {
    var myobj = document.querySelector(".nav-popover");
    myobj.remove();

});
