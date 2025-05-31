<!DOCTYPE html>
<html lang="en">

<head>
  <title>Furry - Pet Store HTML Website Template</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="author" content="TemplatesJungle" />
  <meta name="keywords" content="pet, store" />
  <meta name="description" content="Pet Store HTML Website Template" />

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
    crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="../view/css/vendor.css" />
  <link rel="stylesheet" type="text/css" href="./style.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Chewy&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet" />
</head>
<style>
  @media (max-width: 576px) {
    .list_item {
      display: none;
    }
  }

  .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
  }

  .modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    width: 90%;
    max-width: 400px;
    position: relative;
  }

  .close {
    position: absolute;
    right: 20px;
    top: 10px;
    font-size: 24px;
    cursor: pointer;
  }

  .modal-content h2 {
    margin-top: 0;
  }

  .modal-content form div {
    margin-bottom: 15px;
  }

  .modal-content label {
    display: block;
    margin-bottom: 5px;
  }

  .modal-content input,
  .modal-content textarea {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
  }

  .modal-content button {
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .modal-content button:hover {
    background-color: #218838;
  }

  .consult-btn {
    padding: 8px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
  }

  .consult-btn:hover {
    background-color: #0056b3;
  }

  .sort-container {
    margin-bottom: 20px;
  }

  .sort-container label {
    margin-right: 10px;
    font-weight: bold;
  }

  .sort-container select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
  }

  .pagination {
    margin-top: 20px;
  }

  .pagination a {
    margin: 0 5px;
    padding: 8px 12px;
    text-decoration: none;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .pagination a.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
  }

  @media (max-width: 576px) {
    .logo-img {
      max-height: 50px !important;
    }
  }

  /* === LOGO + ZALO === */
  .logo-img {
    max-height: 60px;
    object-fit: contain;
    transition: transform 0.3s ease;
  }

  .logo-img:hover {
    transform: scale(1.05);
  }

  /* Zalo button */
  .btn-zalo img {
    width: 40px;
    transition: transform 0.3s ease;
  }

  .btn-zalo:hover img {
    transform: scale(1.15);
  }

  /* === SEARCH BAR === */
  .search-bar {
    border: 1px solid #ddd;
    background-color: #f8f9fa !important;
    border-radius: 10px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
  }

  .search-bar input {
    padding-left: 12px;
    font-size: 14px;
    height: 40px;
  }

  .search-bar svg {
    color: #555;
    cursor: pointer;
    transition: color 0.2s ease;
  }

  .search-bar svg:hover {
    color: #007bff;
  }

  /* === NAV ICONS (user, cart, search) === */
  ul li a svg {
    fill: #333;
    transition: transform 0.2s ease, fill 0.2s ease;
  }

  ul li a:hover svg {
    transform: scale(1.15);
    fill: #007bff;
  }

  /* === NAVBAR MENU === */
  .navbar-nav .nav-link {
    font-size: 14px;
    text-transform: uppercase;
    color: #333;
    transition: color 0.2s ease, background-color 0.2s ease;
  }

  .navbar-nav .nav-link:hover {
    color: #007bff;
    background-color: rgba(0, 123, 255, 0.05);
    border-radius: 4px;
  }

  .post-item {
    transition: all 0.3s ease;
  }

  /* Responsive cho điện thoại */
  @media screen and (max-width: 768px) {
    .col-md-4:nth-child(n+4) {
      display: none;
      /* Ẩn bài viết từ thứ 4 trở đi */
    }
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-toggle {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
  }

  .dropdown-menu {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-menu a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-menu a:hover {
    background-color: #f1f1f1;
  }

  .dropdown-toggle:focus+.dropdown-menu,
  .dropdown-menu:hover {
    display: block;
  }
</style>

<body>
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
    <defs>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="facebook"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M15.12 5.32H17V2.14A26.11 26.11 0 0 0 14.26 2c-2.72 0-4.58 1.66-4.58 4.7v2.62H6.61v3.56h3.07V22h3.68v-9.12h3.06l.46-3.56h-3.52V7.05c0-1.05.28-1.73 1.76-1.73Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="twitter"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M22.991 3.95a1 1 0 0 0-1.51-.86a7.48 7.48 0 0 1-1.874.794a5.152 5.152 0 0 0-3.374-1.242a5.232 5.232 0 0 0-5.223 5.063a11.032 11.032 0 0 1-6.814-3.924a1.012 1.012 0 0 0-.857-.365a.999.999 0 0 0-.785.5a5.276 5.276 0 0 0-.242 4.769l-.002.001a1.041 1.041 0 0 0-.496.89a3.042 3.042 0 0 0 .027.439a5.185 5.185 0 0 0 1.568 3.312a.998.998 0 0 0-.066.77a5.204 5.204 0 0 0 2.362 2.922a7.465 7.465 0 0 1-3.59.448A1 1 0 0 0 1.45 19.3a12.942 12.942 0 0 0 7.01 2.061a12.788 12.788 0 0 0 12.465-9.363a12.822 12.822 0 0 0 .535-3.646l-.001-.2a5.77 5.77 0 0 0 1.532-4.202Zm-3.306 3.212a.995.995 0 0 0-.234.702c.01.165.009.331.009.488a10.824 10.824 0 0 1-.454 3.08a10.685 10.685 0 0 1-10.546 7.93a10.938 10.938 0 0 1-2.55-.301a9.48 9.48 0 0 0 2.942-1.564a1 1 0 0 0-.602-1.786a3.208 3.208 0 0 1-2.214-.935q.224-.042.445-.105a1 1 0 0 0-.08-1.943a3.198 3.198 0 0 1-2.25-1.726a5.3 5.3 0 0 0 .545.046a1.02 1.02 0 0 0 .984-.696a1 1 0 0 0-.4-1.137a3.196 3.196 0 0 1-1.425-2.673c0-.066.002-.133.006-.198a13.014 13.014 0 0 0 8.21 3.48a1.02 1.02 0 0 0 .817-.36a1 1 0 0 0 .206-.867a3.157 3.157 0 0 1-.087-.729a3.23 3.23 0 0 1 3.226-3.226a3.184 3.184 0 0 1 2.345 1.02a.993.993 0 0 0 .921.298a9.27 9.27 0 0 0 1.212-.322a6.681 6.681 0 0 1-1.026 1.524Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="youtube"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M23 9.71a8.5 8.5 0 0 0-.91-4.13a2.92 2.92 0 0 0-1.72-1A78.36 78.36 0 0 0 12 4.27a78.45 78.45 0 0 0-8.34.3a2.87 2.87 0 0 0-1.46.74c-.9.83-1 2.25-1.1 3.45a48.29 48.29 0 0 0 0 6.48a9.55 9.55 0 0 0 .3 2a3.14 3.14 0 0 0 .71 1.36a2.86 2.86 0 0 0 1.49.78a45.18 45.18 0 0 0 6.5.33c3.5.05 6.57 0 10.2-.28a2.88 2.88 0 0 0 1.53-.78a2.49 2.49 0 0 0 .61-1a10.58 10.58 0 0 0 .52-3.4c.04-.56.04-3.94.04-4.54ZM9.74 14.85V8.66l5.92 3.11c-1.66.92-3.85 1.96-5.92 3.08Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="instagram"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M17.34 5.46a1.2 1.2 0 1 0 1.2 1.2a1.2 1.2 0 0 0-1.2-1.2Zm4.6 2.42a7.59 7.59 0 0 0-.46-2.43a4.94 4.94 0 0 0-1.16-1.77a4.7 4.7 0 0 0-1.77-1.15a7.3 7.3 0 0 0-2.43-.47C15.06 2 14.72 2 12 2s-3.06 0-4.12.06a7.3 7.3 0 0 0-2.43.47a4.78 4.78 0 0 0-1.77 1.15a4.7 4.7 0 0 0-1.15 1.77a7.3 7.3 0 0 0-.47 2.43C2 8.94 2 9.28 2 12s0 3.06.06 4.12a7.3 7.3 0 0 0 .47 2.43a4.7 4.7 0 0 0 1.15 1.77a4.78 4.78 0 0 0 1.77 1.15a7.3 7.3 0 0 0 2.43.47C8.94 22 9.28 22 12 22s3.06 0 4.12-.06a7.3 7.3 0 0 0 2.43-.47a4.7 4.7 0 0 0 1.77-1.15a4.85 4.85 0 0 0 1.16-1.77a7.59 7.59 0 0 0 .46-2.43c0-1.06.06-1.4.06-4.12s0-3.06-.06-4.12ZM20.14 16a5.61 5.61 0 0 1-.34 1.86a3.06 3.06 0 0 1-.75 1.15a3.19 3.19 0 0 1-1.15.75a5.61 5.61 0 0 1-1.86.34c-1 .05-1.37.06-4 .06s-3 0-4-.06a5.73 5.73 0 0 1-1.94-.3a3.27 3.27 0 0 1-1.1-.75a3 3 0 0 1-.74-1.15a5.54 5.54 0 0 1-.4-1.9c0-1-.06-1.37-.06-4s0-3 .06-4a5.54 5.54 0 0 1 .35-1.9A3 3 0 0 1 5 5a3.14 3.14 0 0 1 1.1-.8A5.73 5.73 0 0 1 8 3.86c1 0 1.37-.06 4-.06s3 0 4 .06a5.61 5.61 0 0 1 1.86.34a3.06 3.06 0 0 1 1.19.8a3.06 3.06 0 0 1 .75 1.1a5.61 5.61 0 0 1 .34 1.9c.05 1 .06 1.37.06 4s-.01 3-.06 4ZM12 6.87A5.13 5.13 0 1 0 17.14 12A5.12 5.12 0 0 0 12 6.87Zm0 8.46A3.33 3.33 0 1 1 15.33 12A3.33 3.33 0 0 1 12 15.33Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="amazon"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M1.04 17.52q.1-.16.32-.02a21.308 21.308 0 0 0 10.88 2.9a21.524 21.524 0 0 0 7.74-1.46q.1-.04.29-.12t.27-.12a.356.356 0 0 1 .47.12q.17.24-.11.44q-.36.26-.92.6a14.99 14.99 0 0 1-3.84 1.58A16.175 16.175 0 0 1 12 22a16.017 16.017 0 0 1-5.9-1.09a16.246 16.246 0 0 1-4.98-3.07a.273.273 0 0 1-.12-.2a.215.215 0 0 1 .04-.12Zm6.02-5.7a4.036 4.036 0 0 1 .68-2.36A4.197 4.197 0 0 1 9.6 7.98a10.063 10.063 0 0 1 2.66-.66q.54-.06 1.76-.16v-.34a3.562 3.562 0 0 0-.28-1.72a1.5 1.5 0 0 0-1.32-.6h-.16a2.189 2.189 0 0 0-1.14.42a1.64 1.64 0 0 0-.62 1a.508.508 0 0 1-.4.46L7.8 6.1q-.34-.08-.34-.36a.587.587 0 0 1 .02-.14a3.834 3.834 0 0 1 1.67-2.64A6.268 6.268 0 0 1 12.26 2h.5a5.054 5.054 0 0 1 3.56 1.18a3.81 3.81 0 0 1 .37.43a3.875 3.875 0 0 1 .27.41a2.098 2.098 0 0 1 .18.52q.08.34.12.47a2.856 2.856 0 0 1 .06.56q.02.43.02.51v4.84a2.868 2.868 0 0 0 .15.95a2.475 2.475 0 0 0 .29.62q.14.19.46.61a.599.599 0 0 1 .12.32a.346.346 0 0 1-.16.28q-1.66 1.44-1.8 1.56a.557.557 0 0 1-.58.04q-.28-.24-.49-.46t-.3-.32a4.466 4.466 0 0 1-.29-.39q-.2-.29-.28-.39a4.91 4.91 0 0 1-2.2 1.52a6.038 6.038 0 0 1-1.68.2a3.505 3.505 0 0 1-2.53-.95a3.553 3.553 0 0 1-.99-2.69Zm3.44-.4a1.895 1.895 0 0 0 .39 1.25a1.294 1.294 0 0 0 1.05.47a1.022 1.022 0 0 0 .17-.02a1.022 1.022 0 0 1 .15-.02a2.033 2.033 0 0 0 1.3-1.08a3.13 3.13 0 0 0 .33-.83a3.8 3.8 0 0 0 .12-.73q.01-.28.01-.92v-.5a7.287 7.287 0 0 0-1.76.16a2.144 2.144 0 0 0-1.76 2.22Zm8.4 6.44a.626.626 0 0 1 .12-.16a3.14 3.14 0 0 1 .96-.46a6.52 6.52 0 0 1 1.48-.22a1.195 1.195 0 0 1 .38.02q.9.08 1.08.3a.655.655 0 0 1 .08.36v.14a4.56 4.56 0 0 1-.38 1.65a3.84 3.84 0 0 1-1.06 1.53a.302.302 0 0 1-.18.08a.177.177 0 0 1-.08-.02q-.12-.06-.06-.22a7.632 7.632 0 0 0 .74-2.42a.513.513 0 0 0-.08-.32q-.2-.24-1.12-.24q-.34 0-.8.04q-.5.06-.92.12a.232.232 0 0 1-.16-.04a.065.065 0 0 1-.02-.08a.153.153 0 0 1 .02-.06Z" />
      </symbol>

      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="menu"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M2 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1m0 6.032a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1m1 5.033a1 1 0 1 0 0 2h18a1 1 0 0 0 0-2z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="link"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="arrow-right"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="category"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M19 5.5h-6.28l-.32-1a3 3 0 0 0-2.84-2H5a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-13a1 1 0 0 1 1-1h4.56a1 1 0 0 1 .95.68l.54 1.64a1 1 0 0 0 .95.68h7a1 1 0 0 1 1 1Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="heart"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="plus"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="minus"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="cart"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="check"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M18.71 7.21a1 1 0 0 0-1.42 0l-7.45 7.46l-3.13-3.14A1 1 0 1 0 5.29 13l3.84 3.84a1 1 0 0 0 1.42 0l8.16-8.16a1 1 0 0 0 0-1.47Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="trash"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="search"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="close"
        viewBox="0 0 15 15">
        <path
          fill="currentColor"
          d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z" />
      </symbol>

      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="delivery"
        viewBox="0 0 32 32">
        <path
          fill="currentColor"
          d="m29.92 16.61l-3-7A1 1 0 0 0 26 9h-3V7a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v17a1 1 0 0 0 1 1h2.14a4 4 0 0 0 7.72 0h6.28a4 4 0 0 0 7.72 0H29a1 1 0 0 0 1-1v-7a1 1 0 0 0-.08-.39M23 11h2.34l2.14 5H23ZM9 26a2 2 0 1 1 2-2a2 2 0 0 1-2 2m10.14-3h-6.28a4 4 0 0 0-7.72 0H4V8h17v12.56A4 4 0 0 0 19.14 23M23 26a2 2 0 1 1 2-2a2 2 0 0 1-2 2m5-3h-1.14A4 4 0 0 0 23 20v-2h5Z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="Shop"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M0 2.84c1.402 2.71 1.445 5.241 2.977 10.4c1.855 5.341 8.703 5.701 9.21 5.711c.46.726 1.513 1.704 3.926 2.21l.268-1.272c-2.082-.436-2.844-1.239-3.106-1.68l-.005.006c.087-.484 1.523-5.377-1.323-9.352C7.182 3.583 0 2.84 0 2.84m24 .84c-3.898.611-4.293-.92-11.473 3.093a11.879 11.879 0 0 1 2.625 10.05c3.723-1.486 5.166-3.976 5.606-6.466c0 0 1.27-4.716 3.242-6.677M12.527 6.773l-.002-.002v.004zM2.643 5.22s5.422 1.426 8.543 11.543c-2.945-.889-4.203-3.796-4.63-5.168h.006a15.863 15.863 0 0 0-3.92-6.375z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="fresh"
        viewBox="0 0 24 24">
        <g fill="none">
          <path
            d="M24 0v24H0V0zM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
          <path
            fill="currentColor"
            d="M20 9a1 1 0 0 1 1 1v1a8 8 0 0 1-8 8H9.414l.793.793a1 1 0 0 1-1.414 1.414l-2.496-2.496a.997.997 0 0 1-.287-.567L6 17.991a.996.996 0 0 1 .237-.638l.056-.06l2.5-2.5a1 1 0 0 1 1.414 1.414L9.414 17H13a6 6 0 0 0 6-6v-1a1 1 0 0 1 1-1m-4.793-6.207l2.5 2.5a1 1 0 0 1 0 1.414l-2.5 2.5a1 1 0 1 1-1.414-1.414L14.586 7H11a6 6 0 0 0-6 6v1a1 1 0 1 1-2 0v-1a8 8 0 0 1 8-8h3.586l-.793-.793a1 1 0 0 1 1.414-1.414" />
        </g>
      </symbol>

      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="star-full"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="m3.1 11.3l3.6 3.3l-1 4.6c-.1.6.1 1.2.6 1.5c.2.2.5.3.8.3c.2 0 .4 0 .6-.1c0 0 .1 0 .1-.1l4.1-2.3l4.1 2.3s.1 0 .1.1c.5.2 1.1.2 1.5-.1c.5-.3.7-.9.6-1.5l-1-4.6c.4-.3 1-.9 1.6-1.5l1.9-1.7l.1-.1c.4-.4.5-1 .3-1.5s-.6-.9-1.2-1h-.1l-4.7-.5l-1.9-4.3s0-.1-.1-.1c-.1-.7-.6-1-1.1-1c-.5 0-1 .3-1.3.8c0 0 0 .1-.1.1L8.7 8.2L4 8.7h-.1c-.5.1-1 .5-1.2 1c-.1.6 0 1.2.4 1.6" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="star-half"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="m3.1 11.3l3.6 3.3l-1 4.6c-.1.6.1 1.2.6 1.5c.2.2.5.3.8.3c.2 0 .4 0 .6-.1c0 0 .1 0 .1-.1l4.1-2.3l4.1 2.3s.1 0 .1.1c.5.2 1.1.2 1.5-.1c.5-.3.7-.9.6-1.5l-1-4.6c.4-.3 1-.9 1.6-1.5l1.9-1.7l.1-.1c.4-.4.5-1 .3-1.5s-.6-.9-1.2-1h-.1l-4.7-.5l-1.9-4.3s0-.1-.1-.1c-.1-.7-.6-1-1.1-1c-.5 0-1 .3-1.3.8c0 0 0 .1-.1.1L8.7 8.2L4 8.7h-.1c-.5.1-1 .5-1.2 1c-.1.6 0 1.2.4 1.6m8.9 5V5.8l1.7 3.8c.1.3.5.5.8.6l4.2.5l-3.1 2.8c-.3.2-.4.6-.3 1c0 .2.5 2.2.8 4.1l-3.6-2.1c-.2-.2-.3-.2-.5-.2" />
      </symbol>

      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="user"
        viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="12" cy="9" r="3" />
          <circle cx="12" cy="12" r="10" />
          <path
            stroke-linecap="round"
            d="M17.97 20c-.16-2.892-1.045-5-5.97-5s-5.81 2.108-5.97 5" />
        </g>
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="wishlist"
        viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="1.5">
          <path
            d="M21 16.09v-4.992c0-4.29 0-6.433-1.318-7.766C18.364 2 16.242 2 12 2C7.757 2 5.636 2 4.318 3.332C3 4.665 3 6.81 3 11.098v4.993c0 3.096 0 4.645.734 5.321c.35.323.792.526 1.263.58c.987.113 2.14-.907 4.445-2.946c1.02-.901 1.529-1.352 2.118-1.47c.29-.06.59-.06.88 0c.59.118 1.099.569 2.118 1.47c2.305 2.039 3.458 3.059 4.445 2.945c.47-.053.913-.256 1.263-.579c.734-.676.734-2.224.734-5.321Z" />
          <path stroke-linecap="round" d="M15 6H9" />
        </g>
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="shopping-bag"
        viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="1.5">
          <path
            d="M3.864 16.455c-.858-3.432-1.287-5.147-.386-6.301C4.378 9 6.148 9 9.685 9h4.63c3.538 0 5.306 0 6.207 1.154c.901 1.153.472 2.87-.386 6.301c-.546 2.183-.818 3.274-1.632 3.91c-.814.635-1.939.635-4.189.635h-4.63c-2.25 0-3.375 0-4.189-.635c-.814-.636-1.087-1.727-1.632-3.91Z" />
          <path
            d="m19.5 9.5l-.71-2.605c-.274-1.005-.411-1.507-.692-1.886A2.5 2.5 0 0 0 17 4.172C16.56 4 16.04 4 15 4M4.5 9.5l.71-2.605c.274-1.005.411-1.507.692-1.886A2.5 2.5 0 0 1 7 4.172C7.44 4 7.96 4 9 4" />
          <path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2h-4a1 1 0 0 1-1-1Z" />
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M8 13v4m8-4v4m-4-4v4" />
        </g>
      </symbol>

      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="dairy"
        viewBox="0 0 48 48">
        <g fill="none">
          <path d="M0 0h48v48H0z" />
          <path
            fill="currentColor"
            fill-rule="evenodd"
            d="M10 5a1 1 0 0 1 1-1h18.571a1 1 0 0 1 .559.17l7.428 5A1 1 0 0 1 38 10v33a1 1 0 0 1-1 1H18.429a1 1 0 0 1-.559-.17l-7.428-5A1 1 0 0 1 10 38zm2 1.878v2.494a2 2 0 0 0 .168.802l1.985 4.539a1 1 0 0 0 1.67.258l.682-.781A2 2 0 0 0 17 12.873v-2.63zM19 11v31h17V11zm14.723-2h-14.99l-4.456-3h14.99zM36 23a8 8 0 1 0-16 0a8 8 0 0 0 16 0M17 40.833V16.61a2.964 2.964 0 0 1-2 .702v22.175zm-4-2.692V16.5h.012a2.997 2.997 0 0 1-.691-.986L12 14.781v22.687zM28 17a6 6 0 1 0 0 12a6 6 0 0 0 0-12m-4 5a1 1 0 0 1 1-1h6v2h-6a1 1 0 0 1-1-1m2 3a1 1 0 0 1 1-1h2v2h-2a1 1 0 0 1-1-1"
            clip-rule="evenodd" />
        </g>
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="meat"
        viewBox="0 0 48 48">
        <g fill="currentColor">
          <path d="M14 14a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
          <path
            fill-rule="evenodd"
            d="M15.086 6c1.26-1.26 3.414-.368 3.414 1.414V9h1.586c1.782 0 2.674 2.154 1.414 3.414l-1.793 1.793a1.138 1.138 0 0 1-.037.036l3.456 5.847a4 4 0 0 0 4.08 1.914l12.58-2.027c1.63-.263 2.74 1.609 1.728 2.914c-.97 1.251-1.459 2.85-1.812 4.6C38.384 34.02 32.854 39.052 26 39.88V42h2.5v2H19v-2h5v-2c-5.414 0-10.21-2.607-13.107-6.608c-2.324-3.21-1.946-7.335-1.006-10.767l.495-1.805a6.996 6.996 0 0 0 .181-2.822L10.5 18H7.914C6.132 18 5.24 15.846 6.5 14.586zm5 5l-1.466 1.466l-.73-1.233a4.55 4.55 0 0 0-.307-.455c.275.142.586.222.917.222zM16.5 9c0 .334.082.65.227.926a4.548 4.548 0 0 0-1.894-.845L16.5 7.414zm-8.586 7l1.595-1.594c.04.208.096.416.168.624l.334.97zm3.654-1.622a2.548 2.548 0 0 1 4.601-2.127l5.236 8.857a6 6 0 0 0 6.119 2.87l12.148-1.957c-1.082 1.557-1.589 3.383-1.93 5.075a13.09 13.09 0 0 1-1.419 3.815a.999.999 0 0 0-.247.222C34.183 33.513 31.378 35 28.264 35C22.654 35 18 30.136 18 24a1 1 0 0 0-2 0c0 7.12 5.432 13 12.264 13c.4 0 .794-.02 1.184-.06A14.402 14.402 0 0 1 24 38c-4.763 0-8.96-2.291-11.487-5.78c-1.766-2.439-1.6-5.773-.697-9.066l.495-1.806a8.998 8.998 0 0 0-.171-5.311z"
            clip-rule="evenodd" />
        </g>
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="seafood"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M13.497 4.564c1.649-.906 3.859-1.137 6.669-.694c.119.685.221 1.711.147 2.86c-.102 1.572-.53 3.278-1.602 4.656l-.165.212l-.036.263v.002l-.002.014l-.013.074a9.298 9.298 0 0 1-1.294 3.217l-.84-1.688l-.96.72C13.65 15.513 10.903 16 9 16H8v1c0 .77-.004 1.293-.106 1.804a3.722 3.722 0 0 1-.147.53l-4.011-4.012a8.2 8.2 0 0 1 .978-.209A10.285 10.285 0 0 1 5.985 15H7v-1c0-2.697.864-3.993 1.83-5.442L9.202 8L7.428 5.339a9.688 9.688 0 0 1 1.765-.411c.609-.088 1.228-.13 1.773-.123c.202.002.385.012.548.026c.09.768.373 1.643.861 2.475c.725 1.236 1.938 2.442 3.774 3.13l.936.351l.703-1.872l-.937-.351c-1.364-.512-2.234-1.39-2.75-2.27c-.385-.655-.557-1.28-.604-1.73m6.947 7.845c1.285-1.759 1.752-3.81 1.865-5.55c.117-1.806-.14-3.371-.344-4.121l-.164-.605l-.616-.116c-3.425-.643-6.471-.492-8.855.91a7.649 7.649 0 0 0-1.338-.122c-.66-.009-1.383.042-2.083.143c-.698.1-1.397.252-2.004.455c-.575.193-1.193.471-1.612.89l-.58.58L6.8 8.003c-.813 1.256-1.6 2.711-1.767 5.054c-.19.02-.4.045-.622.08c-.857.131-2.032.409-2.965 1.03l-1.015.678l7.725 7.725l.676-1.015c.563-.845.87-1.59 1.024-2.359c.083-.413.118-.823.133-1.231c1.704-.117 3.837-.545 5.612-1.523l1.12 2.25l.983-.983c1.188-1.189 1.88-2.582 2.273-3.653a11.298 11.298 0 0 0 .467-1.646M17.5 4.58l1.417 1.417L17.5 7.414l-1.417-1.417z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="canned"
        viewBox="0 0 32 32">
        <g fill="none">
          <g
            fill="currentColor"
            clip-path="url(#fluentEmojiHighContrastCannedFood0)">
            <path
              d="M8 5.04h16v5.03h-2.239a7.977 7.977 0 0 0-5.771-2.46a7.977 7.977 0 0 0-5.771 2.46H8zm13.846 16.02H24v5.98H8v-5.98h2.134a7.978 7.978 0 0 0 5.856 2.55a7.978 7.978 0 0 0 5.856-2.55m-8.196-8.265a2.232 2.232 0 0 1-1.7-2.165h2.29c.71 0 1.344.333 1.752.852a2.232 2.232 0 0 1 1.768-.862h2.28a2.233 2.233 0 0 1-1.723 2.172a3.952 3.952 0 0 1-.757 7.828h-3.14c-2.18 0-3.95-1.77-3.95-3.95a3.954 3.954 0 0 1 3.18-3.875" />
            <path
              d="M3 3.52A3.52 3.52 0 0 1 6.52 0h18.3a3.52 3.52 0 0 1 2.17 6.292v19.5a3.532 3.532 0 0 1 1.35 2.778a3.52 3.52 0 0 1-3.52 3.52H6.52A3.52 3.52 0 0 1 3 28.57a3.54 3.54 0 0 1 2-3.185V6.696A3.52 3.52 0 0 1 3 3.52M24.82 2H6.52a1.52 1.52 0 1 0 0 3.04H7v22h-.48c-.84 0-1.52.69-1.52 1.53c0 .84.68 1.52 1.52 1.52h18.3c.84 0 1.52-.68 1.52-1.52c0-.78-.585-1.43-1.34-1.52V5.03A1.52 1.52 0 0 0 24.82 2" />
          </g>
          <defs>
            <clipPath id="fluentEmojiHighContrastCannedFood0">
              <path fill="#fff" d="M0 0h32v32H0z" />
            </clipPath>
          </defs>
        </g>
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="health"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="M10.5 13H8v-3h2.5V7.5h3V10H16v3h-2.5v2.5h-3zM12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91c4.59-1.15 8-5.86 8-10.91V5zm6 9.09c0 4-2.55 7.7-6 8.83c-3.45-1.13-6-4.82-6-8.83v-4.7l6-2.25l6 2.25z" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="household"
        viewBox="0 0 14 14">
        <g
          fill="none"
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round">
          <path
            d="M12.36 6H1.64a1 1 0 0 0-1 1.13l.73 5.5a1 1 0 0 0 1 .87h9.24a1 1 0 0 0 1-.87l.73-5.5A1.001 1.001 0 0 0 12.36 6M4.5 8.5V11M7 8.5V11m2.5-2.5V11" />
          <path
            d="M9.48 1.54A2.79 2.79 0 0 1 11.78 4L12 6M2 6l.22-2a2.79 2.79 0 0 1 2.3-2.44" />
          <path
            d="M9.5 1.75A1.25 1.25 0 0 1 8.25 3h-2.5a1.25 1.25 0 0 1 0-2.5h2.5A1.25 1.25 0 0 1 9.5 1.75" />
        </g>
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="personal"
        viewBox="0 0 24 24">
        <path
          fill="none"
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="1.5"
          d="M22.012 14.74a3.504 3.504 0 0 1-7.008 0c0-2.628 3.5-7.009 3.5-7.009s3.508 4.381 3.508 7.009M9.998 9.233H3.99a2.002 2.002 0 0 0-2.002 2.002v10.013c0 1.106.896 2.002 2.002 2.002h6.008A2.002 2.002 0 0 0 12 21.248V11.235a2.002 2.002 0 0 0-2.002-2.002M4.766 6.23h4.456a.776.776 0 0 1 .778.775v2.228H3.99V7.005a.776.776 0 0 1 .776-.775M14 2.752l-.447-.895A2 2 0 0 0 11.764.75H2.989m4.005 13.489v4.005m-2.002-2.002h4.004M6.994.75v5.48" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="pet" viewBox="0 0 14 14">
        <path
          fill="none"
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M1.5 9.5c.552 0 1-.672 1-1.5s-.448-1.5-1-1.5s-1 .672-1 1.5s.448 1.5 1 1.5m3-4.5c.552 0 1-.672 1-1.5S5.052 2 4.5 2s-1 .672-1 1.5s.448 1.5 1 1.5m5 0c.552 0 1-.672 1-1.5S10.052 2 9.5 2s-1 .672-1 1.5s.448 1.5 1 1.5m3 4.5c.552 0 1-.672 1-1.5s-.448-1.5-1-1.5s-1 .672-1 1.5s.448 1.5 1 1.5M10 10c0 1.38-1.62 2-3 2s-3-.62-3-2s1-3.5 3-3.5s3 2.12 3 3.5" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="alt-arrow-right-outline"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          fill-rule="evenodd"
          d="M8.512 4.43a.75.75 0 0 1 1.057.082l6 7a.75.75 0 0 1 0 .976l-6 7a.75.75 0 0 1-1.138-.976L14.012 12L8.431 5.488a.75.75 0 0 1 .08-1.057"
          clip-rule="evenodd" />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="alt-arrow-left-outline"
        viewBox="0 0 24 24">
        <path
          fill="currentColor"
          fill-rule="evenodd"
          d="M15.488 4.43a.75.75 0 0 1 .081 1.058L9.988 12l5.581 6.512a.75.75 0 1 1-1.138.976l-6-7a.75.75 0 0 1 0-.976l6-7a.75.75 0 0 1 1.057-.081"
          clip-rule="evenodd" />
      </symbol>
    </defs>
  </svg>

  <div class="preloader-wrapper">
    <div class="preloader"></div>
  </div>



  <div
    class="offcanvas offcanvas-top"
    data-bs-scroll="true"
    tabindex="-1"
    id="offcanvasSearch">
    <div class="offcanvas-header justify-content-center">
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="offcanvas"
        aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div class="order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Search</span>
        </h4>
        <form
          role="search"
          action="index.html"
          method="get"
          class="d-flex mt-3 gap-0">
          <input
            class="form-control rounded-start rounded-0 bg-light"
            type="email"
            placeholder="What are you looking for?"
            aria-label="What are you looking for?" />
          <button class="btn btn-dark rounded-end rounded-0" type="submit">
            Search
          </button>
        </form>
      </div>
    </div>
  </div>

  <header>
    <div class="container-lg">
      <div class="row py-4">
        <div
          class="col-sm-6 col-md-5 col-lg-3 justify-content-center justify-content-lg-between text-center text-sm-start d-flex gap-3">
          <div class="d-flex align-items-center gap-3">
            <a href="index.html">
              <img src="../view/images/logomain.jpg" alt="logo" class="img-fluid logo-img" />
            </a>
            <a href="https://zalo.me/0965777705" target="_blank" class="btn-zalo">
              <img src="../public/img/tải xuống.png" alt="Zalo" />
            </a>
          </div>

        </div>

        <div class="col-sm-12 col-md-4 col-lg-7 d-none d-md-block">
          <div class="search-bar row justify-content-between bg-light p-2 rounded-4">
            <div class="col-11">
              <form id="searchSortForm" style="display: flex; align-items: center;" method="GET" action="">
                <div class="search-container" style="display: flex; align-items: center;">

                  <input type="text" id="search-input" name="search" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Nhập tên sản phẩm...">
                  <button type="button" onclick="searchProducts(1)">Tìm kiếm</button>
                </div>
                <div class="sort-container">

                  <select name="sort" id="sort" onchange="searchProducts(1)">
                    <option value="ASC" <?php echo $sort === 'ASC' ? 'selected' : ''; ?>>Từ bé đến lớn</option>
                    <option value="DESC" <?php echo $sort === 'DESC' ? 'selected' : ''; ?>>Từ lớn đến bé</option>
                  </select>
                </div>
                <div class="category-container">
                  <label for="category">Danh mục:</label>
                  <select name="category_id" id="category" onchange="searchProducts(1)">
                    <option value="">Tất cả danh mục</option>
                    <?php if (!empty($category) && is_array($category)): ?>
                      <?php foreach ($category as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat['ID']); ?>" <?php echo isset($category_id) && $category_id == $cat['ID'] ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <option value="">Không có danh mục</option>
                      <?php error_log("No categories available for dropdown"); ?>
                    <?php endif; ?>
                  </select>
                </div>
                <input type="hidden" name="page" id="page-input" value="<?php echo $currentPage; ?>">
              </form>
            </div>
          </div>
        </div>
        <div
          class="col-sm-6 col-md-3 col-lg-2 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
          <ul class="d-flex justify-content-end list-unstyled m-0">
            <li>
              <a href="#" class="p-2 mx-1">
                <svg width="24" height="24">
                  <use xlink:href="#user"></use>
                </svg>
              </a>
            </li>
            <li>
              <a
                href="#"
                class="p-2 mx-1"
                data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasCart"
                aria-controls="offcanvasCart">
                <svg width="24" height="24">
                  <use xlink:href="#shopping-bag"></use>
                </svg>
              </a>
            </li>
            <li class="d-md-none">
              <a
                href="#"
                class="p-2 mx-1"
                data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSearch"
                aria-controls="offcanvasSearch">
                <svg width="24" height="24">
                  <use xlink:href="#search"></use>
                </svg>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <nav class="p-0 navbar navbar-expand-lg">
        <div
          class="offcanvas offcanvas-end"
          tabindex="-1"
          id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
              Offcanvas
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="offcanvas"
              aria-label="Close"></button>
          </div>
          <div class="offcanvas-body justify-content-center">
            <ul class="navbar-nav mb-0">
              <li
                class="nav-item border-end-0 border-lg-end-0 border-lg-end active">
                <a href="#" class="nav-link fw-bold px-4 py-3">Home</a>
              </li>
              <li
                class="nav-item border-end-0 border-lg-end-0 border-lg-end dropdown has-megamenu">
                <a
                  class="nav-link fw-bold px-4 py-3 dropdown-toggle"
                  href="#"
                  data-bs-toggle="dropdown">
                  All Products
                </a>
                <div
                  class="dropdown-menu megamenu p-lg-5 border-0 rounded-0 animate slide shadow"
                  role="menu">

                  <!-- end row -->
                </div>
                <!-- dropdown-mega-menu.// -->
              </li>
              <div class="dropdown">
                <button class="dropdown-toggle">Danh mục</button>
                <div class="dropdown-menu">
                  <?php foreach ($category as $cat): ?>
                    <a href="?category_id=<?php echo htmlspecialchars($cat['id'] ?? ''); ?>">
                      <?php echo htmlspecialchars($cat['name'] ?? ''); ?>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>

              <label for="categorySelect_art" class="form-label fw-bold">Chọn danh mục bài báo:</label>
              <select id="categorySelect_art" class="form-select mb-4" onchange="changeCategoryArt()">
                <option value="" <?php echo !isset($_GET['category_id_art']) ? 'selected' : ''; ?>>Tất cả danh mục</option>
                <?php if (!empty($categoryArt) && is_array($categoryArt)): ?>
                  <?php foreach ($categoryArt as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat['id'] ?? ''); ?>"
                      <?php echo (isset($_GET['category_id_art']) && $_GET['category_id_art'] == $cat['id']) ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($cat['name'] ?? ''); ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
              <label for="categorySelect_fm" class="form-label fw-bold">Chọn danh mục chăn nuôi:</label>
              <select id="categorySelect_fm" class="form-select mb-4" onchange="changeCategoryFm()">
                <option value="" <?php echo !isset($_GET['category_id_fm']) ? 'selected' : ''; ?>>Tất cả danh mục</option>
                <?php if (!empty($categoryFm) && is_array($categoryFm)): ?>
                  <?php foreach ($categoryFm as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat['id'] ?? ''); ?>"
                      <?php echo (isset($_GET['category_id_fm']) && $_GET['category_id_fm'] == $cat['id']) ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($cat['name'] ?? ''); ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
              <div class="dropdown">
                <button class="dropdown-toggle">Danh mục art</button>
                <div class="dropdown-menu">
                  <?php foreach ($categoryArt as $cat): ?>
                    <a href="?category_id=<?php echo htmlspecialchars($cat['id'] ?? ''); ?>">
                      <?php echo htmlspecialchars($cat['name'] ?? ''); ?>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
              <li class="nav-item border-end-0 border-lg-end-0 border-lg-end">
                <a href="#blog" class="nav-link fw-bold px-4 py-3">Blog</a>
              </li>
              <li class="nav-item border-end-0 border-lg-end-0 border-lg-end">
                <a href="#shop" class="nav-link fw-bold px-4 py-3">Shop</a>
              </li>
              <li class="nav-item border-end-0 border-lg-end-0 border-lg-end">
                <a href="#blog" class="nav-link fw-bold px-4 py-3">Offers</a>
              </li>
              <li class="nav-item border-end-0 border-lg-end-0 border-lg-end">
                <a href="#sale" class="nav-link fw-bold px-4 py-3">Sale</a>
              </li>

              <li class="nav-item border-end-0 border-lg-end-0 border-lg-end">
                <a
                  href="https://templatesjungle.gumroad.com/l/furry"
                  class="nav-link fw-bold px-4 py-3 text-danger">Get PRO</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>





  <section>
    <div
      class="slideshow slide-in arrow-absolute text-white position-relative">
      <div class="swiper-wrapper">
        <div class="swiper-slide jarallax">
          <img
            src="../view/images/banner_minhtam.jpg"
            class="jarallax-img"
            alt="slideshow" />
          <div class="banner-content w-100 my-5">
            <div class="container">
              <div class="row justify-content-center text-center">
                <div class="col-md-12 pt-2">
                  <p class="fs-3">
                    "Con giống tốt, chất lượng vàng – Uy tín dẫn đầu, vững
                    vàng tương lai!
                  </p>
                  <h2 class="display-1 text-white text-uppercase ls-0">
                    Lương Tâm
                  </h2>
                  <a href="#" class="btn btn-primary rounded-3 px-3 py-2 mt-3">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide jarallax">
          <img
            src="../view/images/slide-2.jpg"
            class="jarallax-img"
            alt="slideshow" />
          <div class="banner-content w-100 my-5">
            <div class="container">
              <div class="row justify-content-center text-center">
                <div class="col-md-12 pt-2">
                  <p class="fs-3">
                    Quality products, expert advice, and loving care
                  </p>
                  <h2 class="display-1 text-white text-uppercase ls-0">
                    Pet Food
                  </h2>
                  <a href="#" class="btn btn-primary rounded-3 px-3 py-2 mt-3">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide jarallax">
          <img
            src="../view/images/slide-3.jpg"
            class="jarallax-img"
            alt="slideshow" />
          <div class="banner-content w-100 my-5">
            <div class="container">
              <div class="row justify-content-center text-center">
                <div class="col-md-12 pt-2">
                  <p class="fs-3">Your one-stop pet store</p>
                  <h2 class="display-1 text-white text-uppercase ls-0">
                    Quality products
                  </h2>
                  <a href="#" class="btn btn-primary rounded-3 px-3 py-2 mt-3">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide jarallax">
          <img
            src="../view/images/slide-4.jpg"
            class="jarallax-img"
            alt="slideshow" />
          <div class="banner-content w-100 my-5">
            <div class="container">
              <div class="row justify-content-center text-center">
                <div class="col-md-12 pt-2">
                  <p class="fs-3">Your pets deserve the best</p>
                  <h2 class="display-1 text-white text-uppercase ls-0">
                    furry friends
                  </h2>
                  <a href="#" class="btn btn-primary rounded-3 px-3 py-2 mt-3">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="pagination-wrapper position-absolute bottom-0 mb-4 text-center">
        <div class="container">
          <div class="slideshow-swiper-pagination light"></div>
        </div>
      </div>
    </div>
  </section>

  <section id="shop-categories" class="section-padding">
    <div class="container-lg">
      <div class="row g-md-5">
        <!-- <div class="col-md-3 list_item">
          <ul
            class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
            <li class="nav-item">
              <a
                href="shop.html"
                class="nav-link d-flex align-items-center gap-3 p-2">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#dairy"></use>
                </svg>
                <span>Pet foods</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="shop.html"
                class="nav-link d-flex align-items-center gap-3 p-2">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#meat"></use>
                </svg>
                <span>Birds</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="shop.html"
                class="nav-link d-flex align-items-center gap-3 p-2">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#seafood"></use>
                </svg>
                <span>Fishes</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="shop.html"
                class="nav-link d-flex align-items-center gap-3 p-2">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#canned"></use>
                </svg>
                <span>Canned foods</span>
              </a>
            </li>
            <li class="nav-item position-relative">
              <a
                class="btn btn-toggle dropdown-toggle w-100 d-flex justify-content-between align-items-center p-2"
                data-bs-toggle="collapse"
                data-bs-target="#beverages-collapse"
                aria-expanded="false">
                <div class="d-flex gap-3">
                  <svg width="24" height="24" viewBox="0 0 24 24">
                    <use xlink:href="#health"></use>
                  </svg>
                  <span>Health products</span>
                </div>
              </a>
              <div class="collapse" id="beverages-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal ps-5 pb-1">
                  <li class="border-bottom py-2">
                    <a href="shop.html" class="dropdown-item">Dogs</a>
                  </li>
                  <li class="border-bottom py-2">
                    <a href="shop.html" class="dropdown-item">Cats</a>
                  </li>
                  <li class="border-bottom py-2">
                    <a href="shop.html" class="dropdown-item">Rabbits</a>
                  </li>
                  <li class="border-bottom py-2">
                    <a href="shop.html" class="dropdown-item">Birds</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a
                href="shop.html"
                class="nav-link d-flex align-items-center gap-3 p-2">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#household"></use>
                </svg>
                <span>Household Supplies</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="shop.html"
                class="nav-link d-flex align-items-center gap-3 p-2">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#personal"></use>
                </svg>
                <span>Medications</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="shop.html"
                class="nav-link d-flex align-items-center gap-3 p-2">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#pet"></use>
                </svg>
                <span>Pet clothings</span>
              </a>
            </li>
          </ul>
        </div> -->
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div
                class="section-header d-flex flex-wrap justify-content-between pb-2 mt-5 mt-lg-0">
                <h2 class="section-title">Best selling products</h2>

                <div class="d-flex align-items-center">
                  <a href="#" class="btn btn-primary rounded-1">View All</a>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <div class="product-container">
                <div class="product-grid row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-4">
                  <?php if (empty($products)): ?>
                    <p>Không tìm thấy sản phẩm nào.</p>
                  <?php else: ?>
                    <?php foreach ($products as $product): ?>
                      <?php
                      $main_image = array_filter($product['images'], fn($img) => $img['is_main'] == 1);
                      $main_image = reset($main_image) ?: reset($product['images']);
                      ?>
                      <div class="col">
                        <div class="product-item mb-4">
                          <figure>
                            <a href="?controller=product&action=detail&id=<?php echo $product['ID']; ?>" title="<?php echo htmlspecialchars($product['name']); ?>">
                              <img
                                src="../public/img/<?php echo htmlspecialchars($main_image['image_url'] ?? 'placeholder.jpg'); ?>"
                                alt="Product Thumbnail"
                                class="tab-image img-fluid rounded-3" />
                            </a>
                          </figure>
                          <div class="d-flex flex-column text-center">
                            <h3 class="fs-5 fw-normal">
                              <a href="?controller=product&action=detail&id=<?php echo $product['ID']; ?>" class="text-decoration-none">
                                <?php echo htmlspecialchars($product['name']); ?>
                              </a>
                            </h3>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                              <?php if (!empty($product['price_old'])): ?>
                                <del><?php echo number_format($product['price_old'], 0, ',', '.') . ' VND'; ?></del>
                              <?php endif; ?>
                              <span class="text-dark fw-semibold"><?php echo number_format($product['price'], 0, ',', '.') . ' VND'; ?></span>
                            </div>
                            <div class="button-area p-3">
                              <div class="justify-content-center d-flex mb-3">
                                <div class="input-group product-qty">
                                  <span class="input-group-btn">
                                    <button type="button" class="quantity-left-minus btn btn-light btn-number" data-type="minus">
                                      <svg width="16" height="16">
                                        <use xlink:href="#minus"></use>
                                      </svg>
                                    </button>
                                  </span>
                                  <input type="text" name="quantity" class="quantity form-control input-number text-center"
                                    value="1" min="1" max="<?php echo $product['quantity']; ?>" />
                                  <span class="input-group-btn">
                                    <button type="button" class="quantity-right-plus btn btn-light btn-number" data-type="plus">
                                      <svg width="16" height="16">
                                        <use xlink:href="#plus"></use>
                                      </svg>
                                    </button>
                                  </span>
                                </div>
                              </div>
                              <div>
                                <a class="btn btn-primary rounded-1 p-2 fs-7 consult-btn" data-product-id="<?php echo $product['ID']; ?>">
                                  <svg width="18" height="18">
                                    <use xlink:href="#cart"></use>
                                  </svg> Liên hệ tư vấn
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section
    id="customers-reviews"
    class="position-relative section-padding jarallax"
    style="
        background-image: url(../view/images/banner-image-bg.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      ">
    <div class="container offset-md-3 col-md-6">
      <div
        class="position-absolute top-50 end-0 pe-0 pe-xxl-5 me-0 me-xxl-5 testimonial-button-next">
        <svg
          class="chevron-forward-circle d-flex justify-content-center align-items-center p-2"
          width="80"
          height="80">
          <use xlink:href="#alt-arrow-right-outline"></use>
        </svg>
      </div>
      <div
        class="position-absolute top-50 start-0 ps-0 ps-xxl-5 ms-0 ms-xxl-5 testimonial-button-prev">
        <svg
          class="chevron-back-circle d-flex justify-content-center align-items-center p-2"
          width="80"
          height="80">
          <use xlink:href="#alt-arrow-left-outline"></use>
        </svg>
      </div>
      <div class="section-title mb-4 text-center">
        <h2 class="section-title">Customers reviews</h2>
      </div>
      <div class="swiper testimonial-swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div
              class="card position-relative text-left p-5 border-light shadow-sm rounded-3">
              <blockquote>
                "This pet shop has everything my furry friend needs! The
                quality of the products is amazing, and the staff is so
                helpful. Highly recommended!"
              </blockquote>
              <h5 class="mt-1 fw-normal">Emma R., Dog Owner</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div
              class="card position-relative text-left p-5 border-light shadow-sm rounded-3">
              <blockquote>
                "I found the perfect food and accessories for my cat here. The
                prices are great, and the delivery was super fast!"
              </blockquote>
              <h5 class="mt-1 fw-normal">Mark T., Cat Lover</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div
              class="card position-relative text-left p-5 border-light shadow-sm rounded-3">
              <blockquote>
                "A fantastic place for pet owners! Their selection of toys and
                treats keeps my puppy entertained and happy."
              </blockquote>
              <h5 class="mt-1 fw-normal">Sophia L., Pet Parent</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div
              class="card position-relative text-left p-5 border-light shadow-sm rounded-3">
              <blockquote>
                “I love shopping here for my rabbit! They have unique and
                high-quality pet products that I can’t find anywhere else.”
              </blockquote>
              <h5 class="mt-1 fw-normal">Daniel G., Rabbit Enthusiast</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section style="display: flex; justify-content: center;" class="new-arrivals section-padding">
    <div class="col-md-2 list_item">
      <ul
        class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
        <li class="nav-item">
          <a
            href="shop.html"
            class="nav-link d-flex align-items-center gap-3 p-2">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#dairy"></use>
            </svg>
            <span>Pet foods</span>
          </a>
        </li>
        <li class="nav-item">
          <a
            href="shop.html"
            class="nav-link d-flex align-items-center gap-3 p-2">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#meat"></use>
            </svg>
            <span>Birds</span>
          </a>
        </li>
        <li class="nav-item">
          <a
            href="shop.html"
            class="nav-link d-flex align-items-center gap-3 p-2">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#seafood"></use>
            </svg>
            <span>Fishes</span>
          </a>
        </li>
        <li class="nav-item">
          <a
            href="shop.html"
            class="nav-link d-flex align-items-center gap-3 p-2">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#canned"></use>
            </svg>
            <span>Canned foods</span>
          </a>
        </li>
        <li class="nav-item position-relative">
          <a
            class="btn btn-toggle dropdown-toggle w-100 d-flex justify-content-between align-items-center p-2"
            data-bs-toggle="collapse"
            data-bs-target="#beverages-collapse"
            aria-expanded="false">
            <div class="d-flex gap-3">
              <svg width="24" height="24" viewBox="0 0 24 24">
                <use xlink:href="#health"></use>
              </svg>
              <span>Health products</span>
            </div>
          </a>
          <div class="collapse" id="beverages-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal ps-5 pb-1">
              <li class="border-bottom py-2">
                <a href="shop.html" class="dropdown-item">Dogs</a>
              </li>
              <li class="border-bottom py-2">
                <a href="shop.html" class="dropdown-item">Cats</a>
              </li>
              <li class="border-bottom py-2">
                <a href="shop.html" class="dropdown-item">Rabbits</a>
              </li>
              <li class="border-bottom py-2">
                <a href="shop.html" class="dropdown-item">Birds</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a
            href="shop.html"
            class="nav-link d-flex align-items-center gap-3 p-2">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#household"></use>
            </svg>
            <span>Household Supplies</span>
          </a>
        </li>
        <li class="nav-item">
          <a
            href="shop.html"
            class="nav-link d-flex align-items-center gap-3 p-2">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#personal"></use>
            </svg>
            <span>Medications</span>
          </a>
        </li>
        <li class="nav-item">
          <a
            href="shop.html"
            class="nav-link d-flex align-items-center gap-3 p-2">
            <svg width="24" height="24" viewBox="0 0 24 24">
              <use xlink:href="#pet"></use>
            </svg>
            <span>Pet clothings</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="col-md-8 list_item">
      <div class="container-lg position-relative">
        <div
          class="section-header d-flex flex-wrap justify-content-between pb-2">
          <h2 class="section-title">New arrivals</h2>
          <div class="d-flex align-items-center">
            <a href="#" class="btn btn-primary rounded-1">View All</a>
          </div>
        </div>

        <div class="swiper product-swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="product-item mb-4">
                <figure>
                  <a href="single-product.html" title="Product Title">
                    <img
                      src="../view/images/product-thumbnail-2.jpg"
                      alt="Product Thumbnail"
                      class="tab-image img-fluid rounded-3" />
                  </a>
                </figure>
                <div class="d-flex flex-column text-center">
                  <h3 class="fs-5 fw-normal">
                    <a href="single-product.html" class="text-decoration-none">Product Item</a>
                  </h3>
                  <div
                    class="d-flex justify-content-center align-items-center gap-2">
                    <del>$24.00</del>
                    <span class="text-dark fw-semibold">$18.00</span>
                  </div>
                  <div class="button-area p-3">
                    <div class="justify-content-center d-flex mb-3">
                      <div class="input-group product-qty">
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-left-minus btn btn-light btn-number"
                            data-type="minus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#minus"></use>
                            </svg>
                          </button>
                        </span>
                        <input
                          type="text"
                          id="quantity"
                          name="quantity"
                          class="quantity form-control input-number text-center"
                          value="1"
                          min="1"
                          max="100" />
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-right-plus btn btn-light btn-number"
                            data-type="plus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#plus"></use>
                            </svg>
                          </button>
                        </span>
                      </div>
                    </div>
                    <div>
                      <a
                        href="#"
                        class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg width="18" height="18">
                          <use xlink:href="#cart"></use>
                        </svg>
                        Add to Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-item mb-4">
                <figure>
                  <a href="single-product.html" title="Product Title">
                    <img
                      src="../view/images/product-thumbnail-1.jpg"
                      alt="Product Thumbnail"
                      class="tab-image img-fluid rounded-3" />
                  </a>
                </figure>
                <div class="d-flex flex-column text-center">
                  <h3 class="fs-5 fw-normal">
                    <a href="single-product.html" class="text-decoration-none">Product Item</a>
                  </h3>
                  <div
                    class="d-flex justify-content-center align-items-center gap-2">
                    <del>$24.00</del>
                    <span class="text-dark fw-semibold">$18.00</span>
                  </div>
                  <div class="button-area p-3">
                    <div class="justify-content-center d-flex mb-3">
                      <div class="input-group product-qty">
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-left-minus btn btn-light btn-number"
                            data-type="minus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#minus"></use>
                            </svg>
                          </button>
                        </span>
                        <input
                          type="text"
                          id="quantity"
                          name="quantity"
                          class="quantity form-control input-number text-center"
                          value="1"
                          min="1"
                          max="100" />
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-right-plus btn btn-light btn-number"
                            data-type="plus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#plus"></use>
                            </svg>
                          </button>
                        </span>
                      </div>
                    </div>
                    <div>
                      <a
                        href="#"
                        class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg width="18" height="18">
                          <use xlink:href="#cart"></use>
                        </svg>
                        Add to Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-item mb-4">
                <figure>
                  <a href="single-product.html" title="Product Title">
                    <img
                      src="../view/images/product-thumbnail-5.jpg"
                      alt="Product Thumbnail"
                      class="tab-image img-fluid rounded-3" />
                  </a>
                </figure>
                <div class="d-flex flex-column text-center">
                  <h3 class="fs-5 fw-normal">
                    <a href="single-product.html" class="text-decoration-none">Product Item</a>
                  </h3>
                  <div
                    class="d-flex justify-content-center align-items-center gap-2">
                    <del>$24.00</del>
                    <span class="text-dark fw-semibold">$18.00</span>
                  </div>
                  <div class="button-area p-3">
                    <div class="justify-content-center d-flex mb-3">
                      <div class="input-group product-qty">
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-left-minus btn btn-light btn-number"
                            data-type="minus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#minus"></use>
                            </svg>
                          </button>
                        </span>
                        <input
                          type="text"
                          id="quantity"
                          name="quantity"
                          class="quantity form-control input-number text-center"
                          value="1"
                          min="1"
                          max="100" />
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-right-plus btn btn-light btn-number"
                            data-type="plus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#plus"></use>
                            </svg>
                          </button>
                        </span>
                      </div>
                    </div>
                    <div>
                      <a
                        href="#"
                        class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg width="18" height="18">
                          <use xlink:href="#cart"></use>
                        </svg>
                        Add to Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-item mb-4">
                <figure>
                  <a href="single-product.html" title="Product Title">
                    <img
                      src="../view/images/product-thumbnail-3.jpg"
                      alt="Product Thumbnail"
                      class="tab-image img-fluid rounded-3" />
                  </a>
                </figure>
                <div class="d-flex flex-column text-center">
                  <h3 class="fs-5 fw-normal">
                    <a href="single-product.html" class="text-decoration-none">Product Item</a>
                  </h3>
                  <div
                    class="d-flex justify-content-center align-items-center gap-2">
                    <del>$24.00</del>
                    <span class="text-dark fw-semibold">$18.00</span>
                  </div>
                  <div class="button-area p-3">
                    <div class="justify-content-center d-flex mb-3">
                      <div class="input-group product-qty">
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-left-minus btn btn-light btn-number"
                            data-type="minus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#minus"></use>
                            </svg>
                          </button>
                        </span>
                        <input
                          type="text"
                          id="quantity"
                          name="quantity"
                          class="quantity form-control input-number text-center"
                          value="1"
                          min="1"
                          max="100" />
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-right-plus btn btn-light btn-number"
                            data-type="plus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#plus"></use>
                            </svg>
                          </button>
                        </span>
                      </div>
                    </div>
                    <div>
                      <a
                        href="#"
                        class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg width="18" height="18">
                          <use xlink:href="#cart"></use>
                        </svg>
                        Add to Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-item mb-4">
                <figure>
                  <a href="single-product.html" title="Product Title">
                    <img
                      src="../view/images/product-thumbnail-4.jpg"
                      alt="Product Thumbnail"
                      class="tab-image img-fluid rounded-3" />
                  </a>
                </figure>
                <div class="d-flex flex-column text-center">
                  <h3 class="fs-5 fw-normal">
                    <a href="single-product.html" class="text-decoration-none">Product Item</a>
                  </h3>
                  <div
                    class="d-flex justify-content-center align-items-center gap-2">
                    <del>$24.00</del>
                    <span class="text-dark fw-semibold">$18.00</span>
                  </div>
                  <div class="button-area p-3">
                    <div class="justify-content-center d-flex mb-3">
                      <div class="input-group product-qty">
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-left-minus btn btn-light btn-number"
                            data-type="minus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#minus"></use>
                            </svg>
                          </button>
                        </span>
                        <input
                          type="text"
                          id="quantity"
                          name="quantity"
                          class="quantity form-control input-number text-center"
                          value="1"
                          min="1"
                          max="100" />
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-right-plus btn btn-light btn-number"
                            data-type="plus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#plus"></use>
                            </svg>
                          </button>
                        </span>
                      </div>
                    </div>
                    <div>
                      <a
                        href="#"
                        class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg width="18" height="18">
                          <use xlink:href="#cart"></use>
                        </svg>
                        Add to Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-item mb-4">
                <figure>
                  <a href="single-product.html" title="Product Title">
                    <img
                      src="../view/images/product-thumbnail-9.jpg"
                      alt="Product Thumbnail"
                      class="tab-image img-fluid rounded-3" />
                  </a>
                </figure>
                <div class="d-flex flex-column text-center">
                  <h3 class="fs-5 fw-normal">
                    <a href="single-product.html" class="text-decoration-none">Product Item</a>
                  </h3>
                  <div
                    class="d-flex justify-content-center align-items-center gap-2">
                    <del>$24.00</del>
                    <span class="text-dark fw-semibold">$18.00</span>
                  </div>
                  <div class="button-area p-3">
                    <div class="justify-content-center d-flex mb-3">
                      <div class="input-group product-qty">
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-left-minus btn btn-light btn-number"
                            data-type="minus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#minus"></use>
                            </svg>
                          </button>
                        </span>
                        <input
                          type="text"
                          id="quantity"
                          name="quantity"
                          class="quantity form-control input-number text-center"
                          value="1"
                          min="1"
                          max="100" />
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-right-plus btn btn-light btn-number"
                            data-type="plus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#plus"></use>
                            </svg>
                          </button>
                        </span>
                      </div>
                    </div>
                    <div>
                      <a
                        href="#"
                        class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg width="18" height="18">
                          <use xlink:href="#cart"></use>
                        </svg>
                        Add to Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-item mb-4">
                <figure>
                  <a href="single-product.html" title="Product Title">
                    <img
                      src="../view/images/product-thumbnail-10.jpg"
                      alt="Product Thumbnail"
                      class="tab-image img-fluid rounded-3" />
                  </a>
                </figure>
                <div class="d-flex flex-column text-center">
                  <h3 class="fs-5 fw-normal">
                    <a href="single-product.html" class="text-decoration-none">Product Item</a>
                  </h3>
                  <div
                    class="d-flex justify-content-center align-items-center gap-2">
                    <del>$24.00</del>
                    <span class="text-dark fw-semibold">$18.00</span>
                  </div>
                  <div class="button-area p-3">
                    <div class="justify-content-center d-flex mb-3">
                      <div class="input-group product-qty">
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-left-minus btn btn-light btn-number"
                            data-type="minus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#minus"></use>
                            </svg>
                          </button>
                        </span>
                        <input
                          type="text"
                          id="quantity"
                          name="quantity"
                          class="quantity form-control input-number text-center"
                          value="1"
                          min="1"
                          max="100" />
                        <span class="input-group-btn">
                          <button
                            type="button"
                            class="quantity-right-plus btn btn-light btn-number"
                            data-type="plus"
                            data-field="">
                            <svg width="16" height="16">
                              <use xlink:href="#plus"></use>
                            </svg>
                          </button>
                        </span>
                      </div>
                    </div>
                    <div>
                      <a
                        href="#"
                        class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg width="18" height="18">
                          <use xlink:href="#cart"></use>
                        </svg>
                        Add to Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="pagination-wrapper position-absolute z-3 start-0 end-0 bottom-0 text-center">
        <div class="container">
          <div class="product-swiper-pagination light"></div>
        </div>
      </div>
    </div>
  </section>

  <?php include 'Art.php'; ?>
  <?php include 'farming.php'; ?>

  <section class="mt-5 bg-light">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-md-5">
          <h2 class="fw-bold fs-1 mt-5">
            Get <span class="text-primary">25% Discount</span> on your first
            purchase
          </h2>
          <p>Just Sign Up & Register it now to become member.</p>
          <form>
            <div class="mb-3">
              <label for="email" class="form-label d-none">Email</label>
              <input
                type="email"
                class="form-control form-control-lg"
                name="email"
                id="email"
                placeholder="Email"
                required />
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-dark btn-lg">
                Subscribe
              </button>
            </div>
          </form>
        </div>
        <div class="col-md-7">
          <img src="../view/images/banner-dog.png" alt="image" class="img-fluid" />
        </div>
      </div>
    </div>
  </section>

  <section class="section-padding">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-md-3">
          <div class="mb-3">
            <svg
              class="text-primary flex-shrink-0 me-3"
              width="3em"
              height="3em">
              <use xlink:href="#delivery"></use>
            </svg>
          </div>
          <div>
            <h5 class="fs-5 fw-normal">Free Delivery</h5>
            <p class="card-text">
              Lorem ipsum dolor sit amet, consectetur adipi elit.
            </p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="mb-3">
            <svg
              class="text-primary flex-shrink-0 me-3"
              width="3em"
              height="3em">
              <use xlink:href="#Shop"></use>
            </svg>
          </div>
          <div>
            <h5 class="fs-5 fw-normal">100% Secure Payment</h5>
            <p class="card-text">
              Lorem ipsum dolor sit amet, consectetur adipi elit.
            </p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="mb-3">
            <svg
              class="text-primary flex-shrink-0 me-3"
              width="3em"
              height="3em">
              <use xlink:href="#fresh"></use>
            </svg>
          </div>
          <div>
            <h5 class="fs-5 fw-normal">Quality Guarantee</h5>
            <p class="card-text">
              Lorem ipsum dolor sit amet, consectetur adipi elit.
            </p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="mb-3">
            <svg
              class="text-primary flex-shrink-0 me-3"
              width="3em"
              height="3em">
              <use xlink:href="#calendar"></use>
            </svg>
          </div>
          <div>
            <h5 class="fs-5 fw-normal">Daily Offers</h5>
            <p class="card-text">
              Lorem ipsum dolor sit amet, consectetur adipi elit.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer
    class="section-padding pb-5 bg-dark text-secondary-emphasis"
    data-bs-theme="dark">
    <div class="container-lg">
      <div class="row my-5 justify-content-center">
        <div class="col-md-3 col-sm-6">
          <div class="footer-menu">
            <img src="../view/images/logo.svg" width="240" height="70" alt="logo" />
            <div class="social-links mt-3">
              <ul class="d-flex list-unstyled gap-3">
                <li>
                  <a href="#" class="text-secondary-emphasis">
                    <svg width="32" height="32">
                      <use xlink:href="#facebook"></use>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#" class="text-secondary-emphasis">
                    <svg width="32" height="32">
                      <use xlink:href="#twitter"></use>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#" class="text-secondary-emphasis">
                    <svg width="32" height="32">
                      <use xlink:href="#youtube"></use>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#" class="text-secondary-emphasis">
                    <svg width="32" height="32">
                      <use xlink:href="#instagram"></use>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#" class="text-secondary-emphasis">
                    <svg width="32" height="32">
                      <use xlink:href="#amazon"></use>
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="footer-menu">
            <h5 class="fs-5 fw-normal text-white">Shop</h5>
            <ul class="menu-list list-unstyled">
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">About us</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Conditions</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Our Journals</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Careers</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Affiliate Programme</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Ultras Press</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="footer-menu">
            <h5 class="fs-5 fw-normal text-white">Quick Links</h5>
            <ul class="menu-list list-unstyled">
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Offers</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Discount Coupons</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Stores</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Track Order</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Shop</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Info</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="footer-menu">
            <h5 class="fs-5 fw-normal text-white">Customer Service</h5>
            <ul class="menu-list list-unstyled">
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">FAQ</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Contact</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Privacy Policy</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Returns & Refunds</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Cookie Guidelines</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link text-secondary-emphasis">Delivery Information</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 copyright">
          <p>© 2025 Furry. All rights reserved.</p>
        </div>
        <div class="col-md-6 credit-link text-start text-md-end">
          <p>
            HTML Template by
            <a
              href="https://templatesjungle.com/"
              target="_blank"
              class="text-white text-decoration-none">TemplatesJungle</a>
          </p>
        </div>
      </div>
    </div>
  </footer>
  <div class="pagination"></div>
  <!-- Modal for order input -->
  <div id="consultModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Liên hệ tư vấn</h2>
      <form id="consultForm" method="POST">
        <input type="hidden" id="modalProductId" name="product_id">
        <div>
          <label for="name">Họ và tên:</label>
          <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : ''; ?>" required>
        </div>
        <div>
          <label for="phone">Số điện thoại:</label>
          <input type="text" id="phone" name="phone" value="<?php echo isset($_SESSION['user']['phone']) ? htmlspecialchars($_SESSION['user']['phone']) : ''; ?>" required>
        </div>
        <div>
          <label for="message">Tin nhắn:</label>
          <textarea id="message" name="message"></textarea>
        </div>
        <button type="submit">Gửi</button>
      </form>
      <p id="formMessage"></p>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const modal = document.getElementById('consultModal');
      const closeBtn = document.querySelector('.close');
      const consultButtons = document.querySelectorAll('.consult-btn');
      const form = document.getElementById('consultForm');
      const formMessage = document.getElementById('formMessage');

      function openModal(productId) {
        document.getElementById('modalProductId').value = productId;
        modal.style.display = 'flex';
      }

      function closeModal() {
        modal.style.display = 'none';
        formMessage.textContent = '';
        form.reset();
      }

      closeBtn.addEventListener('click', closeModal);

      window.addEventListener('click', (event) => {
        if (event.target === modal) {
          closeModal();
        }
      });

      function attachConsultButtons() {
        document.querySelectorAll('.consult-btn').forEach(button => {
          button.addEventListener('click', () => {
            const productId = button.getAttribute('data-product-id');
            openModal(productId);
          });
        });
      }

      attachConsultButtons();

      form.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(form);

        fetch('?controller=order&action=create', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            Swal.fire({
              icon: data.success ? 'success' : 'error',
              title: 'Thông báo',
              text: data.success ? 'Đặt hàng thành công!' : (data.message || 'Đã có lỗi xảy ra.'),
              confirmButtonText: 'OK'
            });

            if (data.success) {
              closeModal();
            }
          })
          .catch(() => {
            Swal.fire({
              icon: 'error',
              title: 'Thông báo',
              text: 'Lỗi kết nối, vui lòng thử lại.',
              confirmButtonText: 'OK'
            });
          });
      });

      function searchProducts(page = 1) {
        const searchInput = document.getElementById('search-input').value.trim();
        const sort = document.getElementById('sort').value;
        const category_id = document.getElementById('category').value;

        fetch(`?controller=product&action=searchAjax&search=${encodeURIComponent(searchInput)}&page=${page}&sort=${sort}&category_id=${category_id}`)
          .then(res => res.json())
          .then(data => {
            const productContainer = document.querySelector('.product-container');

            productContainer.innerHTML = `
        <div class="product-grid row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-4">
          ${!data.products || data.products.length === 0 ? '<p>Không tìm thấy sản phẩm nào.</p>' : ''}
        </div>
      `;

            if (!data.products || data.products.length === 0) return;

            const productGrid = productContainer.querySelector('.product-grid');

            data.products.forEach(product => {
              const mainImage = product.images.find(img => img.is_main == 1) || product.images[0];
              const imageUrl = mainImage ? `../public/img/${mainImage.image_url}` : '../public/img/placeholder.jpg';
              const productHtml = `
          <div class="col">
            <div class="product-item mb-4">
              <figure>
                <a href="?controller=product&action=detail&id=${product.ID}" title="${product.name}">
                  <img src="${imageUrl}" class="tab-image img-fluid rounded-3" />
                </a>
              </figure>
              <div class="d-flex flex-column text-center">
                <h3 class="fs-5 fw-normal">
                  <a href="?controller=product&action=detail&id=${product.ID}" class="text-decoration-none">
                    ${product.name}
                  </a>
                </h3>
                <div class="d-flex justify-content-center align-items-center gap-2">
                  ${product.price_old ? `<del>${Number(product.price_old).toLocaleString('vi-VN')} VND</del>` : ''}
                  <span class="text-dark fw-semibold">${Number(product.price).toLocaleString('vi-VN')} VND</span>
                </div>
                <div class="button-area p-3">
                  <div class="justify-content-center d-flex mb-3">
                    <div class="input-group product-qty">
                      <span class="input-group-btn">
                        <button class="quantity-left-minus btn btn-light btn-number" data-type="minus">
                          <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                        </button>
                      </span>
                      <input type="text" class="quantity form-control input-number text-center" value="1" min="1" max="${product.quantity}" />
                      <span class="input-group-btn">
                        <button class="quantity-right-plus btn btn-light btn-number" data-type="plus">
                          <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                        </button>
                      </span>
                    </div>
                  </div>
                  <a class="btn btn-primary rounded-1 p-2 fs-7 consult-btn" data-product-id="${product.ID}">
                    <svg width="18" height="18"><use xlink:href="#cart"></use></svg> Liên hệ tư vấn
                  </a>
                </div>
              </div>
            </div>
          </div>`;
              productGrid.insertAdjacentHTML('beforeend', productHtml);
            });

            attachConsultButtons();
          })
          .catch(error => console.error('Fetch error:', error));
      }


      document.getElementById('search-input').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') searchProducts();
      });

      document.querySelector('.search-container button').addEventListener('click', () => searchProducts());
      document.getElementById('sort').addEventListener('change', () => searchProducts());

      searchProducts();
    });


    //art
    function changeCategoryArt() {
      const select = document.getElementById('categorySelect_art');
      const categoryId = select.value;
      Swal.fire({
        title: 'Đang tải...',
        text: 'Vui lòng chờ trong khi tải danh mục mới.',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
      let url = '?controller=product&action=index';
      if (categoryId) {
        url += '&category_id_art=' + encodeURIComponent(categoryId);
      }
      setTimeout(() => {
        window.location.href = url;
      }, 500);
    }

    //fm
    function changeCategoryFm() {
      const select = document.getElementById('categorySelect_fm');
      const categoryId = select.value;
      Swal.fire({
        title: 'Đang tải...',
        text: 'Vui lòng chờ trong khi tải danh mục mới.',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
      let url = '?controller=product&action=index';
      if (categoryId) {
        url += '&category_id_fm=' + encodeURIComponent(categoryId);
      }
      setTimeout(() => {
        window.location.href = url;
      }, 500);
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../view/js/jquery-1.11.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="../view/js/plugins.js"></script>
  <script src="../view/js/script.js"></script>
</body>

</html>