import React from "react";
import ReactDOM from 'react-dom';

import '../../../../css/header.css';//import '../../../../../public/css/user/layout/header.css';

export default function Header(){
    return (
        <header>
            <input type="checkbox" name="" id="chk1"/>
            <a href="/"><img src="{{asset('img/logo.jpg')}}" class="logo" /></a> 
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
                    <a href="#"><i class="fa-brands fa-facebook"/></a>
                    <a href="#"><i class="fa-brands fa-instagram-square"/></a>
                    <a href="#"><i class="fa-brands fa-twitter-square"/></a>
                </li>
            </ul>

            <div class="menu">
                <label for="chk1">
                    <i class="fa-solid fa-bars" />
                </label>
            </div>
        </header> 
    );
}


if(document.getElementById('header-component')){
    ReactDOM.render(
       <Header />, document.getElementById('header-component') 
    )
}
