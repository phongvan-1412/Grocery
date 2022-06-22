import React from "react";
import ReactDOM from 'react-dom';
import * as ReactDOMClient from 'react-dom/client';

import '../../../../css/user/layout/header.css';

const header = ReactDOMClient.createRoot(document.getElementById('header-component'));
header.render(
    <React.StrictMode>
        <header>
            <input type="checkbox" id="chk1"/>
            <a href="/"><img url={require("../../../../images/logo.jpg")} className="logo" /></a> 

            <ul>
                <li><a href="../about">About</a></li>
                <li><a href="../blog">Blog</a></li>
                <li><a href="../contact">Contact</a></li>
                <li><a href="/product">Shopping</a></li>
                <li><a href="../cart">Cart</a></li>
                <li><a href="../shipping">Shipping</a></li>
                <li><a href="../needhelp">Need help?</a></li>
                <li><a href="../register">Sign Up </a></li>
                <li><a href="../login">Log In</a></li>
                <li>
                    <a href="#"><i className="fa-brands fa-facebook"/></a>
                    <a href="#"><i className="fa-brands fa-instagram-square"/></a>
                    <a href="#"><i className="fa-brands fa-twitter-square"/></a>
                </li>
            </ul>

            <div className="menu">
                <label htmlFor="chk1">
                    <i className="fa-solid fa-bars" />
                </label>
            </div>
        </header> 
    </React.StrictMode>
  )

