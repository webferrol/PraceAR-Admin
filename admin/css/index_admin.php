<style>
    /* Estilos del contenedor flotante para la imagen y nombre ampliados */
    .zoomed-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.8);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.3s ease;
    }

    .zoomed-container.show {
        visibility: visible;
        opacity: 1;
    }

    .zoomed-container img {
        max-width: 90%;
        max-height: 70%;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
    }

    .zoomed-container p {
        color: white;
        font-size: 1.5rem;
        margin-top: 15px;
    }

    .zoomable {
        cursor: pointer;
    }

    .zoomed-container::before {
        content: '×';
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 2rem;
        color: white;
        cursor: pointer;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .pagination a {
        padding: 5px 10px;
        border: 1px solid #1e7dbd;
        text-decoration: none;
        color: #1e7dbd;
    }

    .pagination a.active {
        background-color: #1e7dbd;
        color: white;
        border-color: #1e7dbd;
        font-weight: bold;
        border-radius: 5px;
    }
</style>