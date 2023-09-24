$(document).ready(function () {
    $(document.body).on('click', '#compris-ok', function () {
        $("#design-disclaimer").addClass("d-none");
    })

    $(document.body).on('click', '#inscription_btn', function () {
        $("#design-disclaimer").removeClass("d-none");
    })

    // $(document.body).on('click', '#free_access', function () {

    //     Swal.fire({
    //         title: 'Commencer la session de qcm la plus rcente',
    //         // text: "Vous allez être rediriger vers la l'annale 2023",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Oui commencer',
    //         cancelButtonText: 'Annuler',
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $("#click_for_free_access").click() ;
    //         }
    //     })

    // });

    $(document.body).on('click', '#free_access', function () {

        Swal.fire({
            title: 'Choisir une session',
            // text: "Vous allez être rediriger vers la l'annale 2023",
            icon: 'info',
            showCancelButton: false,
            showConfirmButton: false,
            html: `
                <a href="`+URL+`AllControllers/free_access/2023-1" class="btn btn-outline-secondary m-2">Session 2023-1</a>
                <a href="`+URL+`AllControllers/free_access/2022-2" class="btn btn-outline-secondary m-2">Session 2022-2</a>
                <a href="`+URL+`AllControllers/free_access/2022-1" class="btn btn-outline-secondary m-2">Session 2022-1</a>
                <a href="`+URL+`AllControllers/free_access/2021-2" class="btn btn-outline-secondary m-2">Session 2021-2</a>
                <a href="`+URL+`AllControllers/free_access/2021-1" class="btn btn-outline-secondary m-2">Session 2021-1</a>
                <a href="`+URL+`AllControllers/free_access/2020-2" class="btn btn-outline-secondary m-2">Session 2020-2</a>
            ` ,
        })

    });
});