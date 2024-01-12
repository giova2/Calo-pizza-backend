import $ from 'jquery'

document.addEventListener("DOMContentLoaded", event => {
    if (document.body.querySelectorAll(".edit tbody tr").length > 0) {
        $(document).on("click", ".edit tbody tr:not(.no-data)", e => {
            if (
                e.target.className.indexOf("item-status") === -1 &&
                e.target.className.indexOf("order-status") === -1
            ) {
                const id = $(e.target)
                    .closest("tr")
                    .data("id");
                editar(id);
            }
        });
    }
});

const getCurrentCategory = () => {
    const pathNameArray = window.location.pathname.split('/')
    return pathNameArray.length > 1 ? pathNameArray[1] : ''
}

const editar = id => {
    window.location = `${ window.location.origin }/${ getCurrentCategory() }/${ id }`
};
