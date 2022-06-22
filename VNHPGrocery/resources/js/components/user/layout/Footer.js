import React from "react";
import ReactDOM from 'react-dom';
import * as ReactDOMClient from 'react-dom/client';

import '../../../../css/user/layout/footer.css';

const header = ReactDOMClient.createRoot(document.getElementById('footer-component'));
header.render(
    <React.StrictMode>
        <footer>
            <div className="footer-container1">
                <div className="footer-container1-col1">
                    <div className="contact">
                        <h4>CONTACT US</h4>
                        <span>
                            <i className="fa-solid fa-location-dot" />
                            7th floor-35/6 D5 Str-Binh Thanh Dist-HCM city
                        </span>
                        <span>
                            <i className="fa-solid fa-phone" />
                            (+84) 99 999 9999
                        </span>
                        <span>
                            <i className="fa-solid fa-envelope" />
                            team1thebest@gmail.com
                        </span>
                    </div>
                    <div className="openingtimes">
                        <h4>OPENING TIMES</h4>
                        <p>
                            <b>Weekdays</b> 07:30 - 22:30
                            <br />
                            <b>Weekends</b> 07:00 - 22:30
                        </p>
                    </div>
                </div>

                <div className="footer-container1-col2">
                    <h4>LATEST BLOG</h4>
                    <span>
                        <i className="fa-brands fa-facebook-square" />
                        <a href="#" className="link">@VNHP</a> 
                        <br /><br />
                        <p className="blog">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, est labore deleniti eligendi officiis facere.</p> 
                        <a href="#" className="link">https://buff.ly/2zaSfAQ</a>
                        <br /><br />
                        <p className="date">12 May 2022</p>
                    </span>
                    <span>
                        <i className="fa-brands fa-facebook-square" />
                        <a href="#" className="link">@VNHP</a>
                        <br /> <br />
                        <p className="blog">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, est labore deleniti eligendi officiis facere.</p> 
                        <a href="#" className="link">https://buff.ly/2zaSfAQ</a>
                        <br /> <br />
                        <p className="date">12 May 2022</p> 
                    </span>
                </div>

                <div className="footer-container1-col3">
                    <h4>GALLERY</h4>
                    <div className="gallery1">
                        <img url={require("../../../../images/user/layout/footer/image-1.jpg")} className="gallery1__img1" />
                        <img url={require("../../../../images/user/layout/footer/image-2.jpg")} className="gallery1__img2" />
                        <img url={require("../../../../images/user/layout/footer/image-3.jpg")} className="gallery1__img3" />
                        <img url={require("../../../../images/user/layout/footer/image-7.jpg")} className="gallery1__img4" />
                        <img url={require("../../../../images/user/layout/footer/image-5.jpg")} className="gallery1__img5" />
                        <img url={require("../../../../images/user/layout/footer/image-9.jpg")} className="gallery1__img6" />
                        <img url={require("../../../../images/user/layout/footer/image-4.jpg")} className="gallery1__img7" />
                        <img url={require("../../../../images/user/layout/footer/image-8.jpg")} className="gallery1__img8" />
                        <img url={require("../../../../images/user/layout/footer/image-6.jpg")} className="gallery1__img9" />
                    </div>
                </div>
            </div>

            <div className="footer-containter2">
                <div className="footer-icon">
                    <a href="#"><i className="fa-brands fa-facebook" /></a>
                    <a href="#"><i className="fa-brands fa-instagram-square" /></a>
                    <a href="#"><i className="fa-brands fa-twitter-square" /></a>
                </div>
                <div className="sentence">
                    @ 2017 VNHP's Grocery. <a href="#">Get The Theme</a>
                </div>
            </div>
        </footer>
        
    </React.StrictMode>
  )