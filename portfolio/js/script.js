

function showhide() {
    var togglebtn = document.querySelector('.toggle-btn');
    var navbar = document.querySelector('.show');

    if(navbar != null)
    {
        navbar.classList.replace('show', 'hide');
    }
    else
    {
        let navbar2 = document.querySelector('.hide');
        if(navbar2 != null)
        {
            navbar2.classList.replace('hide', 'show');
        }
        else{
            let nav = document.querySelector('.nav');
            nav.classList.add('show'); 
        }
    } 
};
