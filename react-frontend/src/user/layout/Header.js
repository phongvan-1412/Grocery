import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import '../css/header.css';

const Header = props => {  //function Header() {}
    return (
        <header>
            <input type="checkbox" name="" id="chk1" />
            <Link to="/"><img src={require('../img/header/logo.jpg')} alt="logo" className="logo" /></Link> 
            <ul>
                <li><Link to="../about">About</Link></li>
                <li><Link to="../blog">Blog</Link></li>
                <li><Link to="../contact">Contact</Link></li>
                <li><Link to="/product">Shopping</Link></li>
                <li><Link to="../cart">Cart</Link></li>
                <li><Link to="../shipping">Shipping</Link></li>
                <li><Link to="../needhelp">Need help?</Link></li>
                <li><Link to="../register">Sign Up </Link></li>
                <li><Link to="../login">Log In</Link></li>
                <li>
                    <Link to="#"><i className="fa-brands fa-facebook" /></Link>
                    <Link to="#"><i className="fa-brands fa-instagram-square" /></Link>
                    <Link to="#"><i className="fa-brands fa-twitter-square" /></Link>
                </li>
            </ul>
            <div className="menu">
                <label htmlFor="chk1">
                    <i className="fa-solid fa-bars" />
                </label>
            </div>
        </header> 
    )
}

// Header.defaultProps = {
    
// };

// Header.PropsTypes = {
    
// };

export default Header;
