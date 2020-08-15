document.addEventListener("DOMContentLoaded", event => {
    if (document.body.querySelector(".edit tbody tr")) {
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

const editar = id => {
    const urlSinProtocol = window.location.href.substr(
        window.location.protocol.length + 2,
        window.location.href.length
    ); //recortamos la parte de http:// o https://
    const posSlashSubRuta = urlSinProtocol.indexOf("/"); // posicion de la primera barra de la ruta actual
    let url =
        urlSinProtocol.indexOf("?") > -1
            ? urlSinProtocol.substr(
                  posSlashSubRuta,
                  urlSinProtocol.indexOf("?") - posSlashSubRuta
              )
            : urlSinProtocol.substr(posSlashSubRuta);
    // si tiene argumentos lo recortamos, sino queda como está
    url = window.origin + url;
    window.location = url + "/" + id;
};
